@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="text-center pl-3 pr-3 d-flex justify-content-between">
            <h3>
                My Activity
            </h3>
            <a href="/history/order?type=1" class="float-right mt-1">
                History
            </a>
        </div>
        <div class="row">
            <div class="col-12 pl-3 pr-3 mt-4">
                <div class="row mr-2 ml-2">
                    <div class="col-4 p-2 text-center {{ request()->get('type') == 1 ? 'bg-c' : 'menu-search' }}" style="border-radius: 10px 0px 0px 10px;">
                        <a class="btn btn-block" href="/order?type=1">ฝากซื้อ</a>
                    </div>
                    <div class="col-4 p-2 text-center {{ request()->get('type') == 2 ? 'bg-c' : 'menu-search' }}">
                        <a class="btn btn-block" href="/order?type=2">รับฝากซื้อ</a>
                    </div>
                    <div class="col-4 p-2 text-center {{ request()->get('type') == 3 ? 'bg-c' : 'menu-search' }}" style="border-radius: 0px 10px 10px 0px;">
                        <a class="btn btn-block" href="/order?type=3">โพสของฉัน</a>
                    </div>
                </div>
            </div>
        </div>
        @if(request()->get('type') == 1)
            <div class="row p-4">
                @if(!empty($posts))
                    @foreach($posts as $post)
                        <div class="col-12 p-3 mb-3" style="box-shadow: 0px 1px 20px rgba(0, 0, 0, 0.15);border-radius: 10px;">
                            <?php $or = DB::table('orders')->where('post_id', '=', $post->id)->where('user_id', '=', \Auth::user()->id)->get(); ?>
                            <a href="/order/detail/{{ $or[0]->id }}">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="uploads/photos/{{$post->image}}" style="width:100%;border-radius: 10px;">
                                    </div>
                                    <div class="col-9 text-left">
                                        {{$post->title}}
                                        <br>
                                        จำนวน : {{$post->order_count}}
                                        <br>
                                        @if($post->order_status === 'pending')
                                            <span class="text-orange">กำลังดำเนินการ</span>
                                        @elseif($post->order_status === 'in progress')
                                            <span class="text-pink">รอการยืนยัน</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>

        @elseif(request()->get('type') == 3)
            <div class="row p-4">
                <span>ประเภท : ฝากซื้อ</span>
                @if(!empty($orders))
                    @foreach($orders as $order)
                        @if($order->type_post == '2')
                            <div class="col-12 p-3 mb-3 mt-2" style="box-shadow: 0px 1px 20px rgba(0, 0, 0, 0.15);border-radius: 10px;">
                                <a href="/order/post/{{$order->id}}">
                                    <div class="row">
                                        <div class="col-3 m-0">
                                            <img src="uploads/photos/{{$order->image}}" style="width:100%;border-radius: 10px;">
                                        </div>
                                        <div class="col-9 text-left">
                                            {{$order->title}} 
                                            <br>
                                            <?php 
                                                $count = DB::table('orders')->where('post_id', '=', $order->id)->count();
                                                if($count > 0){
                                                $or = DB::table('orders')->where('post_id', '=', $order->id)->get();
                                                $user = DB::table('users')->where('id', '=', $or[0]->user_id)->get();
                                            ?>
                                                <span class="text-pink">{{$user[0]->username}} กำลังดำเนินการ</span>
                                            <?php } else { ?>
                                                <span class="text-pink">ยังไม่มีผู้รับฝาก</span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="mt-3" style="color: #C4C4C4;">ไม่มีข้อมูล</p>
                @endif
            </div>

            <div class="row p-4">
                <span>ประเภท : รับฝากซื้อ</span>
                @if(!empty($orders))
                    @foreach($orders as $order)
                        @if($order->type_post == '1')
                            <div class="col-12 p-3 mb-3 mt-2" style="box-shadow: 0px 1px 20px rgba(0, 0, 0, 0.15);border-radius: 10px;">
                                <a href="/order/post/{{$order->id}}">
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="uploads/photos/{{$order->image}}" style="width:100%;border-radius: 10px;">
                                        </div>
                                        <div class="col-9 text-left">
                                            {{$order->title}}
                                            <br>
                                            <span class="text-pink">กำลังดำเนินการ</span>
                                            <br>
                                            {{ DB::table('orders')->where('post_id', '=', $order->id)->where('status', '!=', 'cancel')->where('status', '!=', 'success')->count() }} รายการฝากซื้อ
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="mt-3" style="color: #C4C4C4;">ไม่มีข้อมูล</p>
                @endif
            </div>
        @else
            <div class="row p-4">
                @if(!empty($take))
                    @foreach($take as $post)
                        <div class="col-12 p-3 mb-3" style="box-shadow: 0px 1px 20px rgba(0, 0, 0, 0.15);border-radius: 10px;">
                            <?php $or = DB::table('orders')->where('post_id', '=', $post->id)->where('user_id', '=', \Auth::user()->id)->get(); ?>
                            <a href="/order/detail/{{ $or[0]->id }}">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="uploads/photos/{{$post->image}}" style="width:100%;border-radius: 10px;">
                                    </div>
                                    <div class="col-9 text-left">
                                        {{$post->title}}
                                        <br>
                                        @if($post->order_status === 'pending')
                                            <span class="text-pink">รอการยืืืนยัน</span>
                                        @elseif($post->order_status === 'in progress')
                                            <span class="text-pink">กำลังดำเนินการ</span>
                                        @else
                                            <span class="text-pink">สำเร็จ</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    </div>
@endsection