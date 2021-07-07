<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    //
    public function index(){
        $notis = DB::table('notifications')
        ->where('user_id', '=', \Auth::user()->id)
        ->orderBy('created_at', 'DESC')
        ->get();
        
        return view('notification.index',compact('notis'));
    }

    public function hide($id){
        
        $notis = DB::table('notifications')
                ->where('id', $id)
                ->update(['show' => 'hide']);

        return redirect("/notification")->with('success','noti delete');
    }
}
