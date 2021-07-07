<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PostController extends Controller
{
    //
    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('post.index',compact('categories'));
    }

    public function store(Request $request){
//        get file extension
        $filenameWithExt = $request->file('photo')->getClientOriginalName();
//        get file name
        $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
//        get extension
        $extension = $request->file('photo')->getClientOriginalExtension();
//        create new file name
//        20190310171250_1.jpg
        $today = date('YmdHis');

        //name
        $filenameToStore = $today.'_'.$filename.'.'.$extension;

//        upload image
        $request->file('photo')->move('uploads/photos/',$filenameToStore);

        $post = new Posts;
        $post->type_post = $request->input('type_post');
        $post->category = $request->input('category');
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->image = $filenameToStore;
        $post->place = $request->input('place');
        $post->detail_place = $request->input('des-place');
        $post->price = $request->input('price');
        $date_time = date_create($request->input('date-time'));
        date_format($date_time, 'Y-m-d H:i:s');
        $post->user = $request->input('user');
        $post->status = 'open';
        $post->fee = $request->input('fee');
        $post->amount = $request->input('amount');
        $post->buy_at = $request->input('buy_at');
        // $album->size = 1000;
        $post->save();

        return redirect("/detail/{$post->id}")->with('success','Post created');

    }

    public function update(Request $request){
        if($request->file('photo') != null){
                $filenameWithExt = $request->file('photo')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
                $extension = $request->file('photo')->getClientOriginalExtension();
                $today = date('YmdHis');

                $filenameToStore = $today.'_'.$filename.'.'.$extension;
                $request->file('photo')->move('uploads/photos/',$filenameToStore);
        }

        $post = Posts::find($request->input('id'));
        $post->title = $request->input('title');
        $post->category = $request->input('category');
        $post->description = $request->input('description');
        if($request->file('photo') != null){$post->image = $filenameToStore;}
        $post->place = $request->input('place');
        $post->price = $request->input('price');
        if($request->file('date-time') != null){
                $date_time = date_create($request->input('date-time'));
                date_format($date_time, 'Y-m-d H:i:s');
                $post->pickup = $date_time;
        }
        $post->detail_place = $request->input('des-place');
        $post->user = $request->input('user');
        $post->status = 'open';
        $post->fee = $request->input('fee');
        $post->amount = $request->input('amount');
        $post->buy_at = $request->input('buy_at');
        $post->save();

        return redirect("/detail/{$post->id}")->with('success','Post update');
        
    }    
       
    public function edit($id){
        $post = Posts::find($id);
        $categories = DB::table('categories')->get();
        return view('post.edit',compact('post','categories'));
    }
    
    public function search($name){
        $posts = Posts::where('title', 'LIKE' , '%'.$name.'%')->where('status', 'open')->orderBy('title', 'DESC')->get();
        $count = Posts::where('title', 'LIKE' , '%'.$name.'%')->where('status', 'open')->orderBy('title', 'DESC')->count();
        return view('post.search',compact('posts', 'name', 'count'));
    }

    public function postList(){
        $url = URL::full();
        if($url == 'http://127.0.0.1:8000'){
                $posts = Posts::orderBy('title', 'DESC')->where('status', 'open')->get();
        } else {
                $url = explode("=", $url);
                $posts = Posts::where('type_post', '=' , $url[1])->where('status', 'open')->orderBy('title', 'DESC')->get();
        }
        
        return view('post.list',compact('posts'));
    }

    public function show($id)
    {
        //
        $post = Posts::find($id);
        $user = User::find($post->user);
        $count = DB::table('orders')
                ->where('user_id', '=',  \Auth::user()->id)
                ->where('post_id', '=',  $id)
                ->count();
        $order = DB::table('orders')
                ->where('user_id', '=',  \Auth::user()->id)
                ->where('post_id', '=',  $id)
                ->get();
                
        $category = DB::table('categories')
                ->where('name', '=', $post->category)
                ->get();
//      $count = EventJoin::where('event_id',$id)->count();

        return view('post.view',compact('post', 'user', 'order', 'count' ,'category'));
    }

    public function take($id)
    {
        //
        $post = Posts::find($id);
        $user = User::find($post->user);
        $count = DB::table('orders')
                ->where('user_id', '=',  \Auth::user()->id)
                ->where('post_id', '=',  $id)
                ->where('status', '!=', 'cancel')
                ->count();
        $order = DB::table('orders')
                ->where('user_id', '=',  \Auth::user()->id)
                ->where('post_id', '=',  $id)
                ->get();
        $category = DB::table('categories')
                ->where('name', '=', $post->category)
                ->get();

        return view('post.detail',compact('post', 'user', 'order', 'count', 'category'));
    }

    public function closePost($id)
    {
        //
        DB::table('posts')
                ->where('id', $id)
                ->update(['status' => 'close']);

        return redirect('/')->with('success','Post Close');
    }

    

}
