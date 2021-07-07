@extends('layouts.login')

@section('content')
<div id="post-wrap">
    @if($post->type_post == '2')
        @if($post->status == 'in progress' && $order > 0)
            @if($or[0]->status == 'pending')
            <div style="position: absolute; top: 7%; left: 7%">
                <a class="position-relative" href="/order?type=3">
                    <i class="fas fa-arrow-left" style="font-size: 30px; color: black; text-shadow: -1px 1px 8px rgba(0,0,0,0.6);"></i>
                    <i class="fas fa-arrow-left" style="font-size: 30px; color: white; position: absolute;left:1px;"></i>
                </a>
            </div>
            <img style="width: 100%;" src="{{ url('') }}/uploads/photos/{{$post->image}}">
            <div class="mb-5 position-relative">
                <div class="card-detail">
                    <div class="">
                        <div class="row pl-5 pr-5 pt-5 pb-3">
                            <div class="col-3">
                                <img width="100" src="{{ url('') }}/uploads/photos/{{$post->image}}">
                            </div>
                            <div class="col-9">
                                <h3 class="float-left mt-2">
                                    {{$post->title}}
                                    <br>
                                    <span style="font-size:14px; color: #A0A0A0;">{{$post->description}}</span>
                                </h3>
                            </div>
                            <div class="col-6 mt-2">
                                <a href="/post/close/{{$post->id}}">
                                    <button class="btn btn-block btn-sm btn-memove p-2">
                                        ปิดโพส
                                    </button>
                                </a>
                            </div>
                            <div class="col-6 mt-2">
                                <a href="/post/edit/{{$post->id}}">
                                    <button class="btn btn-block btn-sm btn-warnning p-2" style="border-radius: 10px;">
                                        แก้ไข
                                    </button>
                                </a>
                            </div>
                            <div class="col-6 mt-4">
                                <div class="row">
                                    <div class="col-2">
                                        <img width="40" class="float-left" src="{{ url('') }}/img/money.png">
                                    </div>
                                    <div class="col-10">
                                        <span class="ml-3 float-left" style="line-height: 1">
                                            <label>ราคาสินค้า</label>
                                            <br>
                                            <label class="text-pink" style="font-weight: 300">
                                            {{ $post->price }} ฿
                                        </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-4">
                                <div class="row">
                                    <div class="col-2">
                                        <img width="40" class="float-left" src="{{ url('') }}/img/exchange.png">
                                    </div>
                                    <div class="col-10">
                                        <span class="ml-3 float-left" style="line-height: 1">
                                            <label>จำนวน</label>
                                            <br>
                                            <label class="text-pink" style="font-weight: 300">{{$post->amount}} ชิ้น</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-2">
                                <div class="row">
                                    <div class="col-2">
                                        <img width="40" class="float-left" src="{{ url('') }}/img/time.png">
                                    </div>
                                    <div class="col-10">
                                        <span class="ml-3 float-left" style="line-height: 1">
                                            <label>ส่งภายใน</label>
                                            <br>
                                            <label class="text-pink" style="font-weight: 300">
                                            {{ date('g:ia d/m/Y', strtotime($post->pickup)) }}
                                        </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-2">
                                <div class="row">
                                    <div class="col-2">
                                        <img width="40" class="float-left" src="{{ url('') }}/img/courier.png">
                                    </div>
                                    <div class="col-10">
                                        <span class="ml-3 float-left" style="line-height: 1">
                                            <label>สถานที่ส่ง</label>
                                            <br>
                                            <label class="text-pink" style="font-weight: 300">{{$post->place}}</label>
                                            @if(!empty($post->detail_place))
                                            <label class="text-pink" style="font-weight: 300"> ({{$post->detail_place}})</label>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <hr>
                                <h5 class="mt-4 mb-4">ผู้รับออร์เดอร์ </h5>
                                @if(!empty($users) && $order > 0)
                                    @foreach($users as $user)
                                        <div class="col-12 mb-3 p-3">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <a href="/profile/{{$user->id}}">
                                                            <img style="width: 100%" class="rounded-circle float-left" src="{{ url('') }}/uploads/photos/{{$user->img}}" >
                                                        </a>
                                                    </div>
                                                    <div class="col-9 text-left">
                                                        <a href="/profile/{{$user->id}}">
                                                            <span style="font-size: 21px;font-weight: 300;">ชื่อผู้สั่ง : {{$user->username}}</span>
                                                        </a>
                                                        <br>
                                                        คณะ : {{$user->major}}
                                                        <br>
                                                        ติดต่อ : {{$user->phone}}
                                                    </div>
                                                </div>
                                        </div>
                                    @endforeach
                                @endif
                                <hr>
                                <!-- <button onclick="pay()" class="btn btn-block p-3" style="background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                                    ดูรายละเอียด
                                </button> -->
                            </div>

                            <div class="col-12">
                                <div class="row pl-3 pr-3">
                                    <div class="col-6">
                                        ราคาสินค้า {{$post->price}} ฿
                                    </div>
                                    <div class="col-6 text-right text-pink" style="font-weight: 200;">
                                        จำนวน {{ $or[0]->amount }} ชิ้น
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="background: #EAEAEA;" class="p-3">
                        <div class="row pl-3 pr-3">
                            <div class="col-9">
                                <span style="font-weight: 200;"><i class="fas fa-hand-holding-usd"></i> ราคาค่าฝากซื้อ</span>
                            </div>
                            <div class="col-3 text-right">
                                <span>{{ $post->fee }} ฿</span>
                            </div>
                        </div>
                    </div>
                    <div style="background: rgba(196, 196, 196, 0.6);" class="p-3">
                        <div class="row pl-3 pr-3">
                            <div class="col-9">
                                <span style="font-weight: 200;"><i class="fas fa-coins"></i> ราคารวมหิ้ว</span>
                            </div>
                            <div class="col-3 text-right">
                                <span>{{ $post->price * $or[0]->amount + $post->fee }} ฿</span>
                            </div>
                        </div>
                    </div>

                    <div class="row pl-3 pr-3">
                            <div class="col-12 mt-5">
                                <button onclick="pay()" class="btn btn-block p-3" style="background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                                    ยืนยันการรับออร์เดอร์
                                </button>
                            </div>
                            <div class="col-12 mt-4">
                                <a href="/order/{{$or[0]->id}}/cancel">
                                    <button class="btn btn-block p-3" style="background: #E93F3F;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                                        ยกเลิก
                                    </button>
                                </a>
                            </div>
                        </div>
                </div>
            </div>
            @else
                <div>
                <div class=" mt-4">
                    <div class="text-center pl-3 pr-3 d-flex justify-content-between">
                        <a href="/order?type=3">
                        <button class="btn btn-link m-0 p-0"><i class="fas fa-arrow-left" style="font-size: 30px; color: black;"></i></button></a>
                        <h3>
                            Detail Post
                        </h3>
                        <div></div>
                    </div>
                    <div class="row mt-5 pl-3 pr-3">
                        <div class="col-10">
                            {{$post->title}}
                        </div>
                        <div class="col-2 text-right" style="font-weight: 200;">
                            {{$post->price}} ฿
                        </div>
                        <div class="col-12 text-right text-pink" style="font-weight: 200;">
                            จำนวน {{ $or[0]->amount }} ชิ้น
                        </div>
                    </div>
                </div>
                <div style="background: #EAEAEA;" class=" mt-4 p-3">
                    <div class="row pl-3 pr-3">
                        <div class="col-9">
                            <span style="font-weight: 200;"><i class="fas fa-hand-holding-usd"></i> ราคาค่าฝากซื้อ</span>
                        </div>
                        <div class="col-3 text-right">
                            <span>{{ $post->fee }} ฿</span>
                        </div>
                    </div>
                </div>
                <div style="background: rgba(196, 196, 196, 0.6);" class=" p-3">
                    <div class="row pl-3 pr-3">
                        <div class="col-9">
                            <span style="font-weight: 200;"><i class="fas fa-coins"></i> ราคารวมหิ้ว</span>
                        </div>
                        <div class="col-3 text-right">
                            <span>{{ $post->price * $or[0]->amount }} ฿</span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="row pl-3 pr-3">
                        <div class="col-12 text-right">
                            <small style="font-weight: 200;">*หมายเหตุ รวมค่าบริการเรียบร้อยแล้ว</small>
                        </div>
                        <div class="col-12 mt-5 text-right">
                            <span style="font-weight: 300;">สถานะสินค้า</span>
                        </div>
                    </div>
                </div>
                <div style="background: #EAEAEA;" class=" p-3">
                    <div class="row pl-3 pr-3">
                        <div class="col-6">
                            <span >ช่องการชำระเงิน : {{$or[0]->pay}}</span>
                        </div>
                        <div class="col-6 text-right">
                            @if($or[0]->statement === 'ชำระเงินแล้ว')
                                <span style="color:#2DB589;">{{$or[0]->statement}}</span>
                            @else
                                <span class="text-pink">{{$or[0]->statement}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div style="background: rgba(196, 196, 196, 0.6);" class=" p-3">
                    <div class="row pl-3 pr-3">
                        <div class="col-12 text-right">
                            <span>
                                @if($or[0]->status === 'in progress')
                                    กำลังดำเนินการ
                                @elseif($or[0]->status === 'pending')
                                    <span class="text-pink">รอการยืนยัน</span>
                                @else
                                    <span style="color:#2DB589;">สำเร็จแล้ว</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <img src="{{ url('') }}/img/detail.png" style="width:100%;" alt="order detail" >
                <div class="mt-5 pt-5 fixed-bottom" style="bottom:3%;">
                    <div class="row pl-3 pr-3 mt-5 pt-5">
                        <div class="col-12 mt-5">
                            <button onclick="status()" class="btn btn-block p-3" style="font-size:20px;background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                                ดูสถานะสินค้า
                            </button>
                        </div>
                    </div> 
                </div>
            </div>
            @endif
        @else
            <div style="position: absolute; top: 7%; left: 7%">
                <a class="position-relative" href="/order?type=3">
                    <i class="fas fa-arrow-left" style="font-size: 30px; color: black; text-shadow: -1px 1px 8px rgba(0,0,0,0.6);"></i>
                    <i class="fas fa-arrow-left" style="font-size: 30px; color: white; position: absolute;left:1px;"></i>
                </a>
            </div>
            <img style="width: 100%;" src="{{ url('') }}/uploads/photos/{{$post->image}}">
            <div class="mb-5 position-relative">
                <div class="card-detail">
                    <div class="">
                        <div class="row p-5">
                            <div class="col-3">
                                <img width="100" src="{{ url('') }}/uploads/photos/{{$post->image}}">
                            </div>
                            <div class="col-9">
                                <h3 class="float-left mt-2">
                                    {{$post->title}}
                                    <br>
                                    <span style="font-size:14px; color: #A0A0A0;">{{$post->description}}</span>
                                </h3>
                            </div>
                            <div class="col-6 mt-2">
                                <a href="/post/close/{{$post->id}}">
                                    <button class="btn btn-block btn-sm btn-memove p-2">
                                        ปิดโพส
                                    </button>
                                </a>
                            </div>
                            <div class="col-6 mt-2">
                                <button class="btn btn-block btn-sm btn-warnning p-2">แก้ไข</button>
                            </div>
                            <div class="col-6 mt-4">
                                <div class="row">
                                    <div class="col-2">
                                        <img width="40" class="float-left" src="{{ url('') }}/img/money.png">
                                    </div>
                                    <div class="col-10">
                                        <span class="ml-3 float-left" style="line-height: 1">
                                            <label>ราคาสินค้า</label>
                                            <br>
                                            <label class="text-pink" style="font-weight: 300">
                                            {{ $post->price }} ฿
                                        </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-4">
                                <div class="row">
                                    <div class="col-2">
                                        <img width="40" class="float-left" src="{{ url('') }}/img/exchange.png">
                                    </div>
                                    <div class="col-10">
                                        <span class="ml-3 float-left" style="line-height: 1">
                                            <label>จำนวน</label>
                                            <br>
                                            <label class="text-pink" style="font-weight: 300">{{$post->amount}} ชิ้น</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-2">
                                <div class="row">
                                    <div class="col-2">
                                        <img width="40" class="float-left" src="{{ url('') }}/img/time.png">
                                    </div>
                                    <div class="col-10">
                                        <span class="ml-3 float-left" style="line-height: 1">
                                            <label>ส่งภายใน</label>
                                            <br>
                                            <label class="text-pink" style="font-weight: 300">
                                            {{ date('g:ia d/m/Y', strtotime($post->pickup)) }}
                                        </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-2">
                                <div class="row">
                                    <div class="col-2">
                                        <img width="40" class="float-left" src="{{ url('') }}/img/courier.png">
                                    </div>
                                    <div class="col-10">
                                        <span class="ml-3 float-left" style="line-height: 1">
                                            <label>สถานที่ส่ง</label>
                                            <br>
                                            <label class="text-pink" style="font-weight: 300">{{$post->place}}</label>
                                            @if(!empty($post->detail_place))
                                            <label class="text-pink" style="font-weight: 300"> ({{$post->detail_place}})</label>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                ยังไม่มีคนรับออร์เดอร์
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
    @else
        <div style="position: absolute; top: 7%; left: 7%">
            <a class="position-relative" href="/order?type=3">
                <i class="fas fa-arrow-left" style="font-size: 30px; color: black; text-shadow: -1px 1px 8px rgba(0,0,0,0.6);"></i>
                <i class="fas fa-arrow-left" style="font-size: 30px; color: white; position: absolute;left:1px;"></i>
            </a>
        </div>
        <img style="width: 100%;" src="{{ url('') }}/uploads/photos/{{$post->image}}">
        <div class="mb-5 position-relative">
            <div class="card-detail">
                <div class="">
                    <div class="row p-5">
                        <div class="col-3">
                            <img width="100" src="{{ url('') }}/uploads/photos/{{$post->image}}">
                        </div>
                        <div class="col-9">
                            <h3 class="float-left mt-2">
                                {{$post->title}}
                                <br>
                                <span style="font-size:14px; color: #A0A0A0;">{{$post->description}}</span>
                            </h3>
                        </div>
                        <div class="col-6 mt-2">
                            <a href="/post/close/{{$post->id}}">
                                <button class="btn btn-block btn-sm btn-memove p-2">
                                    ปิดโพส
                                </button>
                            </a>
                        </div>
                        <div class="col-6 mt-2">
                            <a href="/post/edit/{{$post->id}}">
                                <button class="btn btn-block btn-sm btn-warnning p-2" style="border-radius: 10px;">
                                    แก้ไข
                                </button>
                            </a>
                        </div>
                        <div class="col-6 mt-5">
                            <div class="row">
                                <div class="col-2">
                                    <img width="40" class="float-left" src="{{ url('') }}/img/money.png">
                                </div>
                                <div class="col-10">
                                    <span class="ml-3 float-left" style="line-height: 1">
                                        <label>ราคาสินค้า</label>
                                        <br>
                                        <label class="text-pink" style="font-weight: 300">
                                        {{ $post->price }} ฿
                                    </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mt-5">
                            <div class="row">
                                <div class="col-2">
                                    <img width="40" class="float-left" src="{{ url('') }}/img/exchange.png">
                                </div>
                                <div class="col-10">
                                    <span class="ml-3 float-left" style="line-height: 1">
                                        <label>เสนอราคาหิ้ว</label>
                                        <br>
                                        <label class="text-pink" style="font-weight: 300">{{$post->fee}} ฿</label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mt-5">
                            <div class="row">
                                <div class="col-2">
                                    <img width="40" class="float-left" src="{{ url('') }}/img/time.png">
                                </div>
                                <div class="col-10">
                                    <span class="ml-3 float-left" style="line-height: 1">
                                        <label>ส่งภายใน</label>
                                        <br>
                                        <label class="text-pink" style="font-weight: 300">
                                        {{ date('g:ia d/m/Y', strtotime($post->pickup)) }}
                                    </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mt-5">
                            <div class="row">
                                <div class="col-2">
                                    <img width="40" class="float-left" src="{{ url('') }}/img/courier.png">
                                </div>
                                <div class="col-10">
                                    <span class="ml-3 float-left" style="line-height: 1">
                                        <label>สถานที่ส่ง</label>
                                        <br>
                                        <label class="text-pink" style="font-weight: 300">{{$post->place}}</label>
                                        @if(!empty($post->detail_place))
                                        <label class="text-pink" style="font-weight: 300"> ({{$post->detail_place}})</label>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 mt-4">
                            <hr>
                            <h5 class="mt-4 mb-4">จำนวนผู้ฝากซื้อ : {{$order}}</h5>
                            @if(!empty($users) && $order > 0)
                                @foreach($users as $user)
                                    <div class="col-12 mb-3 p-3" style="box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.2);border-radius: 20px;">
                                            <div class="row">
                                                <div class="col-3">
                                                    <a href="/profile/{{$user->id}}">
                                                        <img style="width: 100%" class="rounded-circle float-left" src="{{ url('') }}/uploads/photos/{{$user->img}}" >
                                                    </a>
                                                </div>
                                                <div class="col-6 text-left">
                                                <a href="/profile/{{$user->id}}">
                                                    <span style="font-size: 21px;font-weight: 300;">ชื่อผู้สั่ง : {{$user->username}}</span>
                                                    </a>
                                                    <br>
                                                    ติดต่อ : {{$user->phone}}
                                                    <br>
                                                    คณะ : {{$user->major}}
                                                    <br>
                                                    จำนวน : {{$user->amount}}
                                                    <br>
                                                    @if($user->status === 'pending')
                                                        สถานะ : กำลังดำเนินการ
                                                    @elseif($user->status === 'in progress')
                                                        สถานะ : รอดำเนินการ
                                                    @else
                                                        สถานะ : ส่งสินค้าสำเร็จ
                                                    @endif
                                                </div>
                                                <div class="col-3">
                                                    <a href="/order/post/detail/{{$user->order_id}}">
                                                        <button class="btn" style="background: #2DB589; color:#fff;">ดูสถานะ</button>
                                                    </a>
                                                </div>
                                            </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<div id="pay-wrap">
    @if($order > 0)
        <div class=" mt-4">
            <div class="text-center pl-3 pr-3 d-flex justify-content-between">
                <button onclick="back()" class="btn btn-link m-0 p-0"><i class="fas fa-arrow-left" style="font-size: 30px; color: black;"></i></button>
                <h3>
                    Payment
                </h3>
                <div></div>
            </div>
            <div class="row p-3">
                <div class="col-12"><label style="font-weight: 200;">จำนวนเงินที่จะจ่าย</label></div>
                <div class="col-12">
                    <img width="30" class="mb-4" src="{{ url('') }}/img/coin.png">
                    <span class="ml-3" id="num-to-pay" name="num-to-pay" style="font-size:50px;">{{ $post->price }}</span>
                </div>
                <form method="POST" action="/order/{{$or[0]->id}}/confirm" id="payment-form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <input class="form-control" name="type" type="hidden" id="type">
                        <input class="form-control" name="status" type="hidden" id="status">
                        <input class="form-control" name="money" type="hidden" id="money">
                </form>
                <div class="col-12 mt-3"><label style="font-weight: 200;">ช่องทางการชำระเงิน</label></div>
                <div class="col-12">
                    <button onclick="cash()" class="btn btn-block p-3" style="background: #FE9923;border-radius: 10px;color:#fff;">จ่ายด้วยเงินสด</button>
                </div>
                <div class="col-12 mt-3">
                    <div style="border: 1px solid #C4C4C4;border-radius: 10px;" class="p-2">
                        <span style="font-weight: 200;">ยอดเงินคงเหลือในวอลเล็ท</span>
                        <span style="font-size: 18px;color:#6179E5;float:right">{{ \Auth::user()->coin }} <img width="15" src="{{ url('') }}/img/coin.png"></span>
                        <br><br>
                        <button class="btn btn-memove btn-block p-3" id="payment" style="border-radius: 10px;" onclick="payment()">จ่ายผ่านวอลเล็ท</button>
                        <a href="/profile">
                            <button class="btn btn-memove btn-block p-3" id="fill" style="border-radius: 10px;">
                                ยอดเงินคงเหลือไม่พอ
                                <br>
                                เติมเงิน
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</div>
    @endif
    @if($order > 0)
    <div id="status-wrap">
    <div class=" mt-4">
            <div class="text-center pl-3 pr-3 d-flex justify-content-between">
                <button onclick="backpost()" class="btn btn-link m-0 p-0"><i class="fas fa-arrow-left" style="font-size: 30px; color: black;"></i></button>
                <h3>
                    Status Order
                </h3>
                <div></div>
            </div>
            <img src="{{ url('') }}/img/order.png" class="p-5" style="width:100%;" alt="order detail" >
            <div class="pl-5 pr-5 d-flex justify-content-center text-center">
                <div class="row pl-3 pr-3">
                    @if($or[0]->step === 'กำลังดำเนินการ')
                        <h2 style="color: #2DB589;">ผู้ซื้อกำลังดำเนินการ</h2>
                    @elseif($or[0]->step === 'ถึงสถานที่ซื้อสินค้า')
                        <h2 style="color: #2DB589;">ผู้ซื้อถึงสถานที่ซื้อสินค้า</h2>
                    @else
                    <div class="text-center">
                        <h2 style="color: #2DB589;">ผู้ซื้อถึงสถานที่ส่งสินค้าแล้ว</h2>
                        <hr>
                        <h3 style="B7B7B7, 100%">*กรุณารอสินค้าจากผู้รับฝากสักครู่</h3>
                    </div>
                    @endif
                </div>
            </div>
            <div class="mt-5 pt-5 fixed-bottom" style="bottom:3%;">
                <div class="row pl-3 pr-3 mt-5 pt-5">
                    @if($or[0]->step === 'การส่งสินค้าสำเร็จ')
                    <div class="col-12 mt-5">
                        <button onclick="statusUpdateSuccess()" class="btn btn-block p-3" style="font-size:20px;background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                            ยืนยันการส่งสินค้า
                        </button>
                        <form method="POST" action="/order/update/post" id="success-form" enctype="multipart/form-data" class="m-0 p-0">
                            {{ csrf_field() }}
                            <input name="type_post" type="hidden" id="type_post" value="{{$or[0]->type_post}}">
                            <input name="user" type="hidden" id="user" value="{{$or[0]->user_id}}">
                            <input name="post" type="hidden" id="post" value="{{$or[0]->post_id}}">
                            <input name="order" type="hidden" id="order" value="{{$or[0]->id}}">
                        </form>
                    </div>
                    @endif
                    <div class="col-12 mt-5">
                        <button onclick="status()" class="btn btn-block p-3" style="font-size:20px;background: #E93F3F;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                            แจ้งปัญหา
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

<script>
    function status() {
        document.getElementById('post-wrap').style.display = 'none';
        document.getElementById('pay-wrap').style.display = 'none';
        document.getElementById('status-wrap').style.display = 'block';
    }

    function backpost() {
        document.getElementById('post-wrap').style.display = 'block';
        document.getElementById('pay-wrap').style.display = 'none';
        document.getElementById('status-wrap').style.display = 'none';
    }

    function pay() {

        var tt = <?php echo $price ?>;

        document.getElementById('post-wrap').style.display = 'none';
        document.getElementById('pay-wrap').style.display = 'block';
        document.getElementById('status-wrap').style.display = 'none';
        if(<? echo \Auth::user()->coin ?> < tt){
            document.getElementById('payment').style.display = 'none';
            document.getElementById('fill').style.display = 'block';
        } else {
            document.getElementById('payment').style.display = 'block';
            document.getElementById('fill').style.display = 'none';
        }
        document.getElementById('num-to-pay').innerText = tt;
        document.getElementById('money').value = tt;
    }

    function back() {
        document.getElementById('post-wrap').style.display = 'block';
        document.getElementById('pay-wrap').style.display = 'none';
        document.getElementById('status-wrap').style.display = 'none';
    }

    function payment() {
        document.getElementById('type').value = 'wallet';
        document.getElementById('status').value = 'ชำระเงินแล้ว';
        document.getElementById('money').value = <?php echo $price ?>;
        document.getElementById('payment-form').submit();
    }

    function cash() {
        document.getElementById('type').value = 'cash';
        document.getElementById('status').value = 'ยังไม่ชำระเงิน';
        document.getElementById('money').value = <?php echo $price ?>;
        document.getElementById('payment-form').submit();
    }

    function statusUpdateSuccess() {
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-green ml-2',
            cancelButton: 'btn btn-dander'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'คุณต้องการยืนยันการรับสินค้า',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'ยืนยันการรับของ',
        cancelButtonText: 'ไม่พบผู้สั่งสินค้า',
        reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('success-form').submit();
        }
        })
    }
</script>
