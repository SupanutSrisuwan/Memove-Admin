@extends('layouts.login')

@section('content')
<div id="post-wrap">
    @if($order->type_post == '1')
    <div>
        <div class=" mt-4">
            <div class="text-center pl-3 pr-3 d-flex justify-content-between">
                <a href="/order?type={{$post->type_post}}">
                <button class="btn btn-link m-0 p-0"><i class="fas fa-arrow-left" style="font-size: 30px; color: black;"></i></button></a>
                <h3>
                    Detail Order
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
                    จำนวน {{ $order->amount }} ชิ้น
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
                    <span>{{ $post->price * $order->amount }} ฿</span>
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
                <div class="col-12 text-right">
                    @if($order->statement === 'ชำระเงินแล้ว')
                        <span style="color:#2DB589;">{{$order->statement}}</span>
                    @else
                        <span class="text-pink">{{$order->statement}}</span>
                    @endif
                </div>
            </div>
        </div>
        <div style="background: rgba(196, 196, 196, 0.6);" class=" p-3">
            <div class="row pl-3 pr-3">
                <div class="col-12 text-right">
                    <span>
                        @if($order->status === 'pending')
                            กำลังดำเนินการ
                        @elseif($order->status === 'in progress')
                            <span class="text-pink">รอการยืนยัน</span>
                        @elseif($order->status === 'cancel')
                            <span class="text-pink">ออร์เดอร์ถูกยกเลิก</span>
                        @elseif($order->status === 'pending:success')
                            <span style="color:#000;">กำลังยืนยันการรับสินค้า</span>
                        @else 
                            <span style="color:#2DB589;">สำเร็จแล้ว</span>
                        @endif
                    </span>
                </div>
            </div>
        </div>
        <img src="{{ url('') }}/img/detail.png" style="width:100%;" alt="order detail" >
        @if($order->status === 'pending' || $order->status === 'pending:success')
            <div class="col-12 mt-5 fixed-bottom mb-3">
                <button onclick="status()" class="btn btn-block p-3" style="bottom:5%!important;font-size:20px;background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                    ดูสถานะสินค้า
                </button>
            </div>
        @elseif($order->status === 'success')
            <div class="col-12 mt-5 fixed-bottom">
                <a href="/?order=1" class="mb-3">
                <button class="btn btn-block p-3" style="bottom:5%!important;font-size:20px;background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                    ไปหน้าหลัก
                </button>
                </a>
            </div>
        @endif
    </div>
    @else
        @if($order->status == 'pending' && $post->user == \Auth::user()->id)
        <div>
            <div class=" mt-4">
                <div class="text-center pl-3 pr-3 d-flex justify-content-between">
                    <a href="/order?type={{$post->type_post}}">
                    <button class="btn btn-link m-0 p-0"><i class="fas fa-arrow-left" style="font-size: 30px; color: black;"></i></button></a>
                    <h3>
                        Detail Order
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
                        จำนวน {{ $order->amount }} ชิ้น
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
                        <span>{{ $post->price * $order->amount + $post->fee }} ฿</span>
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
            <div style="background: #2DB589;color:#fff;" class=" p-3">
                <div class="row pl-3 pr-3">
                    <div class="col-12 text-right">
                        @if($order->statement === 'ชำระเงินแล้ว')
                            <span >{{$order->statement}}</span>
                        @else
                            <span>{{$order->statement}}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div style="background: #E93F3F;color:#fff;" class=" p-3">
                <div class="row pl-3 pr-3">
                    <div class="col-12 text-right" stke>
                        <span>รอการยืนยัน</span>
                    </div>
                </div>
            </div>
            <div class=" bb mt-5 pt-5">
                <div class="row pl-3 pr-3 mt-5 pt-5">
                    <div class="col-12 mt-5">
                            <button onclick="pay()" class="btn btn-block p-3" style="background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                                ยืนยันการรับออร์เดอร์
                            </button>
                    </div>
                    <div class="col-12 mt-2">
                        <a href="/order/{{$order->id}}/cancel">
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
                    <a href="/order?type={{$post->type_post}}">
                    <button class="btn btn-link m-0 p-0"><i class="fas fa-arrow-left" style="font-size: 30px; color: black;"></i></button></a>
                    <h3>
                        Detail Order
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
                        จำนวน {{ $order->amount }} ชิ้น
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
                        <span>{{ $post->price * $order->amount }} ฿</span>
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
                        <span >ช่องการชำระเงิน : {{$order->pay}}</span>
                    </div>
                    <div class="col-6 text-right">
                        @if($order->statement === 'ชำระเงินแล้ว')
                            <span style="color:#2DB589;">{{$order->statement}}</span>
                        @else
                            <span class="text-pink">{{$order->statement}}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div style="background: rgba(196, 196, 196, 0.6);" class=" p-3">
                <div class="row pl-3 pr-3">
                    <div class="col-6">
                    <!-- @if($order->statement !== 'ชำระเงินแล้ว')
                        <div class="col-4 text-left">
                            <form method="POST" action="/order/update" enctype="multipart/form-data" class="m-0 p-0">
                                {{ csrf_field() }}
                                <input name="type_post" type="hidden" id="type_post" value="{{$order->type_post}}">
                                <input name="user" type="hidden" id="user" value="{{$order->user_id}}">
                                <input name="post" type="hidden" id="post" value="{{$order->post_id}}">
                                <input name="order" type="hidden" id="order" value="{{$order->id}}">
                                <input class="btn btn-sm" style="background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;" type="submit" value="ดำเนินการสำเร็จ">
                            </form>
                        </div>
                    @endif -->
                    </div>
                    <div class="col-6 text-right">
                        <span>
                            @if($order->status === 'in progress')
                                กำลังดำเนินการ
                            @elseif($order->status === 'pending')
                                <span class="text-pink">รอการยืนยัน</span>
                            @elseif($order->status === 'cancel')
                                <span class="text-pink">ยกเลิกออร์เดอร์</span>
                            @elseif($order->status === 'pending:success')
                                <span style="color:#000;">กำลังยืนยันการรับสินค้า</span>
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
                    @if($order->status === 'success')
                    <div class="col-12 mt-5">
                        <a href="/?order=1">
                        <button class="btn btn-block p-3" style="font-size:20px;background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                            ไปหน้าหลัก
                        </button>
                        </a>
                    </div>
                    @elseif($order->status === 'in progress' || $order->status === 'pending:success')
                    <div class="col-12 mt-5">
                        <button onclick="statutPost()" class="btn btn-block p-3" style="font-size:20px;background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                            บอกสถานะสินค้า
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    @endif
    </div>
    <div id="pay-wrap">
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
                <form method="POST" action="/order/{{$order->id}}/confirm" id="payment-form" enctype="multipart/form-data">
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
                    @if($order->step === 'กำลังดำเนินการ')
                        <h2 style="color: #2DB589;">ผู้ซื้อกำลังดำเนินการ</h2>
                    @elseif($order->step === 'ถึงสถานที่ซื้อสินค้า')
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
                    @if($order->step === 'การส่งสินค้าสำเร็จ')
                    <div class="col-12 mt-5">
                        <button onclick="statusUpdateSuccess()" class="btn btn-block p-3" style="font-size:20px;background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                            ยืนยันการส่งสินค้า
                        </button>
                        <form method="POST" action="/order/update" id="success-form" enctype="multipart/form-data" class="m-0 p-0">
                            {{ csrf_field() }}
                            <input name="type_post" type="hidden" id="type_post" value="{{$order->type_post}}">
                            <input name="user" type="hidden" id="user" value="{{$order->user_id}}">
                            <input name="post" type="hidden" id="post" value="{{$order->post_id}}">
                            <input name="order" type="hidden" id="order" value="{{$order->id}}">
                            <!-- <input class="btn btn-block p-3" style="background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;font-size:20px;" type="submit" value="ยืนยันการส่งสินค้า"> -->
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
    <div id="status-post-wrap">
        <div class=" mt-4">
            <div class="text-center pl-3 pr-3 d-flex justify-content-between">
                <button onclick="back()" class="btn btn-link m-0 p-0"><i class="fas fa-arrow-left" style="font-size: 30px; color: black;"></i></button>
                <h3>
                    Detail Order
                </h3>
                <div></div>
            </div>
            @if($order->status == 'in progress')
                <div class="p-3">
                    <div class="row mt-5 pl-3 pr-3">
                        <div class="col-12 pl-5">
                            <h3 style="font-weight: 300;">สถานะผู้ฝากซื้อ</h3>
                        </div>
                    </div>
                </div>
                <div style="{{$order->statement === 'ชำระเงินแล้ว' ? 'background: #2DB589;color:#fff;' : 'background: #E93F3F;color:#fff;'}}" class="p-3">
                    <div class="row pl-3 pr-3">
                        <div class="col-12 text-left pl-5">
                            @if($order->statement === 'ชำระเงินแล้ว')
                                <span >{{$order->statement}}</span>
                            @else
                                <span>{{$order->statement}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="p-3">
                    <div class="row mt-5 pl-3 pr-3">
                        <div class="col-12 pl-5">
                            <h3 style="font-weight: 300;">แจ้งสถานะสินค้าให้ผู้ฝากซื้อทราบ</h3>
                        </div>
                    </div>
                </div>
                <div class="pl-5 pr-5">
                    <div class="row pl-3 pr-3">
                        <button onclick="statusUpdate('กำลังดำเนินการ',{{$order->id}})" class="btn btn-block p-3 {{$order->step === 'กำลังดำเนินการ' ? 'btn-green' : 'btn-gray'}}">กำลังดำเนินการ</button>                    
                        <button onclick="statusUpdate('ถึงสถานที่ซื้อสินค้า',{{$order->id}})" class="btn btn-block {{$order->step === 'ถึงสถานที่ซื้อสินค้า' ? 'btn-green' : 'btn-gray'}} mt-3 p-3">ถึงสถานที่ซื้อสินค้า</button>                    
                        <button onclick="statusUpdate('ถึงสถานที่ส่งสินค้า',{{$order->id}})" class="btn btn-block {{$order->step === 'ถึงสถานที่ส่งสินค้า' ? 'btn-green' : 'btn-gray'}} mt-3 p-3">ถึงสถานที่ส่งสินค้า</button>                
                    </div>
                </div>
                <div class="mt-5 pt-5 fixed-bottom" style="bottom:3%;">
                    <div class="row pl-3 pr-3 mt-5 pt-5">
                        @if($order->step === 'ถึงสถานที่ส่งสินค้า')
                        <div class="col-12 mt-5">
                            <button onclick="statusUpdate('การส่งสินค้าสำเร็จ',{{$order->id}})" class="btn btn-block p-3" style="font-size:20px;background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                                ยืนยันการส่งสินค้า
                            </button>
                        </div>
                        @endif
                        <div class="col-12 mt-4">
                            <button onclick="status()" class="btn btn-block p-3" style="font-size:20px;background: #E93F3F;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                                แจ้งปัญหา
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <img src="{{ url('') }}/img/order.png" class="p-5" style="width:100%;" alt="order detail" >
                <div class="pl-5 pr-5 d-flex justify-content-center text-center">
                    <div class="row pl-3 pr-3">
                        <div class="text-center">
                            <h2 style="color: #2DB589;">รอผู้สั่งกดรับสินค้า</h2>
                            <hr>
                            <h3 style="B7B7B7, 100%">*กรุณารอผู้สั่งซื้อสักครู่</h3>
                        </div>
                    </div>
                </div>
                <div class="mt-5 pt-5 fixed-bottom" style="bottom:3%;">
                    <div class="row pl-3 pr-3 mt-5 pt-5">
                        @if($order->step === 'การส่งสินค้าสำเร็จ')
                        <div class="col-12 mt-5">
                            <a href="/?order=1">
                            <button class="btn btn-block p-3" style="font-size:20px;background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                                ไปหน้าหลัก
                            </button>
                            </a>
                        </div>
                        @endif
                        <div class="col-12 mt-5">
                            <button onclick="status()" class="btn btn-block p-3" style="font-size:20px;background: #E93F3F;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                                แจ้งปัญหา
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

<script>
    function statutPost() {
        document.getElementById('post-wrap').style.display = 'none';
        document.getElementById('pay-wrap').style.display = 'none';
        document.getElementById('status-wrap').style.display = 'none';
        document.getElementById('status-post-wrap').style.display = 'block';
    }

    function statutPostBack() {
        document.getElementById('post-wrap').style.display = 'block';
        document.getElementById('pay-wrap').style.display = 'none';
        document.getElementById('status-wrap').style.display = 'none';
        document.getElementById('status-post-wrap').style.display = 'none';
    }

    function status() {
        document.getElementById('post-wrap').style.display = 'none';
        document.getElementById('pay-wrap').style.display = 'none';
        document.getElementById('status-wrap').style.display = 'block';
        document.getElementById('status-post-wrap').style.display = 'none';
    }

    function backpost() {
        document.getElementById('post-wrap').style.display = 'block';
        document.getElementById('pay-wrap').style.display = 'none';
        document.getElementById('status-wrap').style.display = 'none';
        document.getElementById('status-post-wrap').style.display = 'none';
    }

    function pay() {
        var tt = <?php echo $post->price*$post->amount+$post->fee ?>;

        document.getElementById('post-wrap').style.display = 'none';
        document.getElementById('pay-wrap').style.display = 'block';
        document.getElementById('status-wrap').style.display = 'none';
        document.getElementById('status-post-wrap').style.display = 'none';
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
        document.getElementById('status-post-wrap').style.display = 'none';
    }

    function payment() {
        document.getElementById('type').value = 'wallet';
        document.getElementById('status').value = 'ชำระเงินแล้ว';
        document.getElementById('payment-form').submit();
    }

    function cash() {
        document.getElementById('type').value = 'cash';
        document.getElementById('status').value = 'ยังไม่ชำระเงิน';
        document.getElementById('payment-form').submit();
    }

    function statusUpdate(status, id) {
        window.location = '/order/'+id+'/' + status
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