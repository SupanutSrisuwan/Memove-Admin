<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $post1 = DB::table('posts')->where('type_post', '1')->count();
        $post2 = DB::table('posts')->where('type_post', '2')->count();
        $report = DB::table('reports')->count();
        $users = DB::table('users')->count();
        $b1 = DB::table('banks')->where('statement', 'ถอนเงิน')->count();
        $b2 = DB::table('banks')->where('statement', 'เติมเงิน')->count();
        return view('home',compact('post1', 'post2', 'report', 'users', 'b1', 'b2'));
    }
    
    public function topup()
    {
        $b1 = DB::table('banks')->where('statement', 'เติมเงิน')->get();

        return view('topup',compact('b1'));
    }

    public function topupConfirm($id)
    {
        $b1 = Bank::find($id);
        $b1->status = 'ยืนยันการเติมเงิน';
        $b1->save();

        $user = User::find($b1->user_id);
        $user->coin = $user->coin+$b1->money;
        $user->save();

        $noti = new Notification;
        $noti->title = 'เติมเงินสำเร็จ';
        $noti->message = 'ระบบได้ทำการยืนยันการเติมเงินของคุณเรียบร้อย';
        $noti->by = 'Admin';
        $noti->user_id = $b1->user_id;
        $noti->show = 'show';
        $noti->save();

        return back();
    }

    public function topupCancel($id)
    {
        $b1 = Bank::find($id);
        $b1->status = 'ยกเลิกการเติมเงิน';
        $b1->save();

        $money = DB::table('banks')->orderBy('id', 'desc')->first();

        DB::table('banks')
                ->where('id', $money->id)
                ->update(['total' => $money->total-$b1->money]);

        $noti = new Notification;
        $noti->title = 'เติมเงินไม่สำเร็จ';
        $noti->message = 'เกิดข้อผิดพลาดหรืออาจเกิดปัญหาบางอย่างทำให้คุณไม่สามารถเติมเงินเข้าระบบได้ <br> ขออภัย';
        $noti->by = 'Admin';
        $noti->user_id = $b1->user_id;
        $noti->show = 'show';
        $noti->save();

        return back();
    }

    public function withdraw()
    {
        $b1 = DB::table('banks')->where('statement', 'ถอนเงิน')->get();

        return view('withdraw',compact('b1'));
    }

    public function withdrawConfirm($id)
    {
        $b1 = Bank::find($id);
        $b1->status = 'ยืนยันการถอนเงิน';
        $b1->save();

        $user = User::find($b1->user_id);
        $user->coin = $user->coin-$b1->money;
        $user->save();

        $money = DB::table('banks')->orderBy('id', 'desc')->first();

        DB::table('banks')
                ->where('id', $money->id)
                ->update(['total' => $money->total-$b1->money]);

        $noti = new Notification;
        $noti->title = 'ถอนเงินสำเร็จ';
        $noti->message = 'ระบบได้ทำการยืนยันการถอนเงินของคุณเรียบร้อย';
        $noti->by = 'Admin';
        $noti->user_id = $b1->user_id;
        $noti->show = 'show';
        $noti->save();

        return back();
    }

    public function withdrawCancel($id)
    {
        $b1 = Bank::find($id);
        $b1->status = 'ยกเลิกการถอนเงิน';
        $b1->save();

        $noti = new Notification;
        $noti->title = 'ถอนเงินไม่สำเร็จ';
        $noti->message = 'เกิดข้อผิดพลาดหรืออาจเกิดปัญหาบางอย่างทำให้คุณไม่สามารถถอนเงินเข้าระบบได้ <br> ขออภัย';
        $noti->by = 'Admin';
        $noti->user_id = $b1->user_id;
        $noti->show = 'show';
        $noti->save();

        return back();
    }
    
    public function users()
    {
        $users = DB::table('users')->where('roles', '=', 'user')->get();

        return view('user',compact('users'));
    }

    public function report()
    {
        $reports = DB::table('reports')->get();
        return view('report',compact('reports'));
    }
}
