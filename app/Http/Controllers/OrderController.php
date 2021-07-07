<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Posts;
use App\Models\User;
use App\Models\Bank;
use App\Models\Notification;

class OrderController extends Controller
{
    //
    public function store(Request $request){
        $this->validate($request,[
            'user'=>'required',
            'post'=>'required',
        ]);

        $order = new Order;
        $order->type_post = $request->input('type_post');
        $order->user_id = $request->input('user');
        $order->post_id = $request->input('post');
        if($request->input('type_post') == '2'){
            $order->status = 'pending';
        } else {
            $order->status = 'in progress';
        }
        $order->amount = $request->input('number');
        $order->pay = $request->input('type');
        $order->price = $request->input('price');
        $order->statement = $request->input('status');
        $order->save();

        if($request->input('type') == 'wallet'){
            $cc = \Auth::user()->coin - $request->input('price');
            
            DB::table('users')
                ->where('id', \Auth::user()->id)
                ->update(['coin' => $cc]);
        }

        if($request->input('type_post') == '2'){
            DB::table('posts')
                ->where('id', $request->input('post'))
                ->update(['status' => 'in progress','fee' => $request->input('fee')]);
        }

        if($request->input('type') === 'wallet'){
            $money = DB::table('banks')->orderBy('id', 'desc')->first();

            $bank = new Bank;
            $bank->statement = 'ฝากเงิน';
            $bank->order_id = $order->id;
            $bank->user_id = $request->input('user');
            $bank->money = $request->input('price');
            $bank->total = $money->money+$request->input('price');
            $bank->save();
        }

        return redirect("/order/detail/{$order->id}")->with('alert','Order created');

    }

    public function orderList(){

        $posts = DB::table('orders')
                    ->join('posts', 'orders.post_id', '=', 'posts.id')
                    ->where('orders.user_id', '=', \Auth::user()->id)
                    ->where('orders.status', '!=', 'success')
                    ->where('orders.status', '!=', 'cancel')
                    ->where('orders.type_post', '=', '1')
                    ->select('*', 'orders.status as order_status', 'posts.status as posts_status', 'orders.amount as order_count')
                    ->get();

        $orders = DB::table('posts')
                    ->where('posts.user', '=', \Auth::user()->id)
                    ->where('posts.status', '!=', 'close')
                    ->get();

        $take = DB::table('orders')
                    ->join('posts', 'orders.post_id', '=', 'posts.id')
                    ->where('orders.user_id', '=', \Auth::user()->id)
                    ->where('orders.type_post', '=', '2')
                    ->where('orders.status', '!=', 'success')
                    ->where('orders.status', '!=', 'cancel')
                    ->select('*', 'orders.status as order_status', 'posts.status as posts_status')
                    ->get();

        return view('order.index',compact('posts', 'orders', 'take'));
    }

    public function historyOrder(){

        $posts = DB::table('orders')
                    ->join('posts', 'orders.post_id', '=', 'posts.id')
                    ->where('orders.user_id', '=', \Auth::user()->id)
                    ->where('orders.status', '!=', 'pending')
                    ->where('orders.status', '!=', 'in progress')
                    ->select('*', 'orders.status as order_status', 'posts.status as posts_status')
                    ->get();

        $orders = DB::table('posts')
                    ->where('posts.user', '=', \Auth::user()->id)
                    ->where('posts.status', '=', 'close')
                    ->get();

        return view('order.history',compact('posts', 'orders'));
    }

    public function show($id)
    {
        //
        $post = Posts::find($id);
        $order = DB::table('orders')->where('post_id', '=', $id)->where('status', '!=', 'cancel')->where('status', '!=', 'success')->count();
        $users = DB::table('orders')
                    ->join('users', 'orders.user_id', '=', 'users.id')
                    ->where('orders.post_id', '=', $id)
                    ->where('orders.status', '!=', 'cancel')
                    ->where('orders.status', '!=', 'success')
                    ->select('*', 'orders.id as order_id', 'users.id as user_id')
                    ->get();
        $or = DB::table('orders')->where('post_id', '=', $id)->where('status', '!=', 'cancel')->get();
        if($order > 0){
            $price = $post->price*$or[0]->amount+$post->fee;
        } else {
            $price = 0;
        }
        
        return view('order.viewOrder',compact('post', 'users', 'order', 'or', 'price'));
    }

    public function showDetail($id)
    {
        //
        $order = Order::find($id);
        $post = Posts::find($order->post_id);

        return view('order.viewDetailOrder',compact('post', 'order'));
    }

    public function order($id)
    {
        //
        $order = Order::find($id);
        $post = Posts::find($order->post_id);

        return view('order.detailOrder',compact('post', 'order'));
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'user'=>'required',
            'post'=>'required',
        ]);

        $order = Order::find($request->input('order'));
        $order->type_post = $request->input('type_post');
        $order->user_id = $request->input('user');
        $order->post_id = $request->input('post');
        $order->statement = 'ชำระเงินแล้ว';
        $order->status = 'success';
        $order->save();

        if($order->pay === 'wallet'){
            $post = Posts::find($request->input('post'));

            $user = User::find($post->user);
            $user->coin = $user->coin+$order->price;
            $user->save();

            $money = DB::table('banks')->orderBy('id', 'desc')->first();

            $bank = new Bank;
            $bank->statement = 'โอนเงิน';
            $bank->order_id = $request->input('order');
            $bank->user_id = $request->input('user');
            $bank->money = $order->price;
            $bank->total = $money->money-$order->price;
            $bank->save();
        }

        if($request->input('type_post') === '2'){
            $post = Posts::find($request->input('post'));
            $post->status = 'close';
            $post->save();
        }
        $post = Posts::find($request->input('post'));
        $user = User::find($post->user);

        $noti = new Notification;
        $noti->title = 'ดำเนินการสำเร็จ ออร์เดอร์ #'.$request->input('order');
        $noti->message = 'ออร์เดอร์ดำเนินการส่งสินค้าสำเร็จ';
        $noti->by = $request->input('user');
        $noti->user_id = $user->id;
        $noti->show = 'show';
        $noti->save();

        return back();
    }

    public function updatePost(Request $request)
    {
        $this->validate($request,[
            'user'=>'required',
            'post'=>'required',
        ]);

        $order = Order::find($request->input('order'));
        $order->type_post = $request->input('type_post');
        $order->user_id = $request->input('user');
        $order->post_id = $request->input('post');
        $order->statement = 'ชำระเงินแล้ว';
        $order->status = 'success';
        $order->save();

        if($order->pay === 'wallet'){
            $post = Posts::find($request->input('post'));

            $user = User::find($order->user_id);
            $user->coin = $user->coin+$order->price;
            $user->save();

            $money = DB::table('banks')->orderBy('id', 'desc')->first();

            $bank = new Bank;
            $bank->statement = 'โอนเงิน';
            $bank->order_id = $request->input('order');
            $bank->user_id = $order->user_id;
            $bank->money = $order->price;
            $bank->total = $money->money-$order->price;
            $bank->save();
        }

        if($request->input('type_post') === '2'){
            $post = Posts::find($request->input('post'));
            $post->status = 'close';
            $post->save();
        }
        $post = Posts::find($request->input('post'));
        $user = User::find($post->user);

        $noti = new Notification;
        $noti->title = 'ดำเนินการสำเร็จ ออร์เดอร์ #'.$request->input('order');
        $noti->message = 'ออร์เดอร์ดำเนินการส่งสินค้าสำเร็จ';
        $noti->by = $request->input('user');
        $noti->user_id = $user->id;
        $noti->show = 'show';
        $noti->save();

        return back();
    }
    
    public function statusUpdate($id, $status)
    {
        if($status == 'การส่งสินค้าสำเร็จ'){
            DB::table('orders')
                ->where('id', $id)
                ->update(['status' => 'pending:success']);
        }

        DB::table('orders')
                ->where('id', $id)
                ->update(['step' => $status]);

        $order = Order::find($id);
        $post = Posts::find($order->post_id);
        $up = User::find($post->user);

        $noti = new Notification;
        $noti->title = 'ออร์เดอร์ #'.$id.' '.$status;
        $noti->message = 'ออร์เดอร์ #'.$id.' '.$post->title.' ผู้ซืื้อ'.$status;
        $noti->by = $up->id;
        $noti->user_id = $order->user_id;
        $noti->show = 'show';
        $noti->save();

        return back();
    }

    public function confirm($id)
    {
        DB::table('orders')
                ->where('id', $id)
                ->update(['status' => 'pending', 'step' => 'กำลังดำเนินการ']);

        $order = Order::find($id);
        $post = Posts::find($order->post_id);
        $up = User::find($post->user);

        $noti = new Notification;
        $noti->title = 'ออร์เดอร์ #'.$id.' ยืนยันการดำเนินการ';
        $noti->message = 'ออร์เดอร์ #'.$id.' '.$post->title.' กำลังดำเนินการโดย '.$up->name.'(เจ้าของโพส)';
        $noti->by = $up->id;
        $noti->user_id = $order->user_id;
        $noti->show = 'show';
        $noti->save();

        return back();
    }

    public function orderConfirm(Request $request, $id)
    {
        //
        DB::table('orders')
                ->where('id', $id)
                ->update(['status' => 'in progress','step' => 'กำลังดำเนินการ', 'pay' => $request->input('type'), 'statement' => $request->input('status')]);

        $order = Order::find($id);
        $post = DB::table('posts')
                ->where('id', $order->post_id)
                ->update(['status' => 'in progress']);

        $postuser = Posts::find($order->post_id);
        $up = User::find($postuser->user);

        $noti = new Notification;
        $noti->title = 'ยืนยันออร์เดอร์';
        $noti->message = 'ออร์เดอร์ #'.$id.' '.$postuser->title.' ยืนยันรับค่าฝากซื้อและพร้อมให้ดำเนินการ';
        $noti->by = $order->user_id;
        $noti->user_id = $up->id;
        $noti->show = 'show';
        $noti->save();

        if($request->input('type') == 'wallet'){
            $cc = \Auth::user()->coin - $request->input('money');
            
            DB::table('users')
                ->where('id', \Auth::user()->id)
                ->update(['coin' => $cc]);
        }

        if($request->input('type') === 'wallet'){
            $money = DB::table('banks')->orderBy('id', 'desc')->first();

            $bank = new Bank;
            $bank->statement = 'ฝากเงิน';
            $bank->order_id = $id;
            $bank->user_id = \Auth::user()->id;
            $bank->money = $request->input('money');
            $bank->total = $money->money+$request->input('money');
            $bank->save();
        }

        return back();
    }

    public function cancelOrder($id)
    {
        //
        
        $order = Order::find($id);
        
        if($order->statement === 'ชำระเงินแล้ว'){
            if($order->pay === 'wallet'){
                $user = User::find($order->user_id);
                $user->coin = $user->coin+$order->price;
                $user->save();
                
                $money = DB::table('banks')->orderBy('id', 'desc')->first();
                
                $bank = new Bank;
                $bank->statement = 'โอนเงินคืืน';
                $bank->order_id = $id;
                $bank->user_id = $order->user_id;
                $bank->money = $order->price;
                $bank->total = $money->money-$order->price;
                $bank->save();
                
            }
        }

        DB::table('orders')
                ->where('id', $id)
                ->update(['status' => 'cancel', 'statement' => 'โอนเงินคืน']);

        $post = Posts::find($order->post_id);
        $up = User::find($post->user);

        $noti = new Notification;
        $noti->title = 'ยกเลิกออร์เดอร์';
        $noti->message = 'ออร์เดอร์ #'.$id.' '.$post->title.' ถูกยกเลิกการรับฝากโดย '.$up->name.'(เจ้าของโพส)';
        $noti->by = $up->id;
        $noti->user_id = $order->user_id;
        $noti->show = 'show';
        $noti->save();

        return redirect("/order/post/{$order->post_id}")->with('success','Order cancel');
    }

    public function cancel($id)
    {
        //
        $order = Order::find($id);
        if($order->statement === 'ชำระเงินแล้ว'){
            if($order->pay === 'wallet'){
                $user = User::find($order->user_id);
                $user->coin = $user->coin+$order->price;
                $user->save();
                
                $money = DB::table('banks')->orderBy('id', 'desc')->first();
                
                $bank = new Bank;
                $bank->statement = 'โอนเงินคืืน';
                $bank->order_id = $id;
                $bank->user_id = $order->user_id;
                $bank->money = $order->price;
                $bank->total = $money->money-$order->price;
                $bank->save();
                
            }
        }

        DB::table('orders')
                ->where('id', $id)
                ->update(['status' => 'cancel']);

        $order = DB::table('orders')->where('id', $id)->get();
        DB::table('posts')
                ->where('id', $order[0]->post_id)
                ->update(['status' => 'open']);

        $post = Posts::find($order[0]->post_id);
        $up = User::find($post->user);

        $noti = new Notification;
        $noti->title = 'ยกเลิกออร์เดอร์';
        $noti->message = 'ออร์เดอร์ #'.$id.' '.$post->title.' ถูกยกเลิกการรับฝากโดย '.$up->name.'(เจ้าของโพส)';
        $noti->by = $order[0]->user_id;
        $noti->user_id = $up->id;
        $noti->show = 'show';
        $noti->save();

        return redirect('/')->with('success','Post cancel');
    }
}
