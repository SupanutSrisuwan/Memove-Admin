@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="pl-3 pr-3">
            <h3>
                <a class="" href="/order?type=1">
                    <i class="fas fa-angle-left"></i>
                    History
                </a>
            </h3>
        </div>
        <div class="row">
            <div class="col-12 pl-3 pr-3 mt-4">
                <div class="row mr-2 ml-2">
                    <div class="col-6 text-center {{ request()->get('type') == 1 ? 'bg-c' : 'menu-search' }}" style="border-radius: 10px 0px 0px 10px;">
                        <a class="btn btn-block" href="/history/order?type=1">ฝากซื้อ</a>
                    </div>
                    <div class="col-6 text-center {{ request()->get('type') == 2 ? 'bg-c' : 'menu-search' }}" style="border-radius: 0px 10px 10px 0px;">
                        <a class="btn btn-block" href="/history/order?type=2">โพสของฉัน</a>
                    </div>
                </div>
            </div>
        </div>
        @if(request()->get('type') == 1)
            <div class="row p-4">
                @if(!empty($posts))
                    @foreach($posts as $post)
                        <div class="col-12 p-3 mb-3" style="box-shadow: 0px 1px 20px rgba(0, 0, 0, 0.15);border-radius: 10px;">
                            <a href="/detail/{{$post->id}}">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="{{ url('/') }}/uploads/photos/{{$post->image}}" style="width:100%;">
                                    </div>
                                    <div class="col-9 text-left">
                                        {{$post->title}}
                                        <br>
                                        @if($post->status === 'success')
                                        <span class="text-pink">เสร็จ</span>
                                        @else
                                        <span class="text-pink">ยกเลิก</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>

        @elseif(request()->get('type') == 2)
            <div class="row p-4">
                @if(!empty($orders))
                    @foreach($orders as $order)
                        <div class="col-12 p-3 mb-3" style="box-shadow: 0px 1px 20px rgba(0, 0, 0, 0.15);border-radius: 10px;">
                            <a href="/order/detail/{{$order->id}}">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="{{ url('/') }}/uploads/photos/{{$order->image}}" style="width:100%;">
                                    </div>
                                    <div class="col-9 text-left">
                                        {{$order->title}}
                                        <br>
                                        <span class="text-pink">เสร็จ</span>
                                        <br>
                                        {{ DB::table('orders')->where('post_id', '=', $order->id)->count() }} รายการ
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
