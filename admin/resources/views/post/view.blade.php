@extends('layouts.login')

@section('content')
    <div id="detail-post-wrap">
        <div style="position: absolute; top: 7%; left: 7%">
            <a class="position-relative" href="/?order=1">
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
                        <img width="60" src="{{ url('') }}/img/{{$category[0]->image}}">
                        </div>
                        <div class="col-9">
                            <h3 class="float-left mt-2">{{$post->title}}</h3>
                        </div>
                        <div class="col-12 mt-5">
                            <h5>รายละเอียด : ประเภท {{ $post->type_post == '1' ? 'ฝากซื้อ' : 'รับฝากซื้อ'}}</h5>
                            <p style="color: #A0A0A0;">{{$post->description}}</p>
                        </div>
                        <div class="col-12 mt-4">
                            <img width="50" class="float-left" src="{{ url('') }}/img/time.png">
                            <span class="ml-3 float-left" style="line-height: 1.2">
                                <label>ส่งภายใน</label>
                                <br>
                                <label class="text-pink" style="font-weight: 300">{{ date("g:ia d/m/Y", strtotime($post->pickup)) }}</label>
                            </span>
                        </div>
                        <div class="col-12 mt-4">
                            <img width="50" class="float-left" src="{{ url('') }}/img/courier.png">
                            <span class="ml-3 float-left" style="line-height: 1.2">
                                <label>ส่งที่</label>
                                <br>
                                <label class="text-pink" style="font-weight: 300">{{ $post->place }}</label>
                            </span>
                            <span class="ml-3 float-left" style="line-height: 1.2">
                                <label>รายละเอียดเพิ่มเติม</label>
                                <br>
                                <label class="text-pink" style="font-weight: 300">{{ $post->detail_place }}</label>
                            </span>
                        </div>
                        <div class="col-12 mt-4 mb-4">
                            <img width="50" class="float-left" src="{{ url('') }}/img/exchange.png">
                            <span class="ml-3 float-left" style="line-height: 1.2">
                                <label>เสนอราคาหิ้ว</label>
                                <br>
                                <label class="text-pink" style="font-weight: 300">{{$post->fee}} ฿</label>
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row pt-2 pl-5 pr-5 pb-2">
                        <div class="col-2">
                        @if($post->user === \Auth::user()->id)
                            <a href="/profile">
                        @else
                            <a href="/profile/{{$post->user}}">
                        @endif
                            @if($user->img == null)
                                <img width="80" class="rounded-circle float-left" src="https://th.jobsdb.com/en-th/cms/employer/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png">
                            @else
                                <img width="80" class="rounded-circle float-left" src="{{ url('') }}/uploads/photos/{{$user->img}}">
                            @endif
                            </a>
                        </div>
                        <div class="col-6 ">
                        @if($post->user === \Auth::user()->id)
                            <a href="/profile">
                        @else
                            <a href="/profile/{{$post->user}}">
                        @endif
                                <span class="ml-4">{{$user->username}}</span>
                                <br>
                                <label class="ml-4 text-pink" style="font-weight: 300">
                                    <i class="far fa-thumbs-up"></i> {{$user->fav}}
                                    &nbsp;&nbsp;<i class="far fa-thumbs-down"></i> {{$user->dislike}}
                                </label>
                            </a>
                        </div>
                        <div class="col-4 text-right">
                        @if($post->user === \Auth::user()->id)
                            <a href="/post/edit/{{$post->id}}" class="mt-3" style="color:white;">
                                <button class="btn btn-memove">แก้ไขโพส</button>
                            </a>
                        @elseif($count != 0)
                            @if($order[0]->status != 'cancel')
                            <small class="mt-3">
                                <a href="/order/detail/{{$order[0]->id}}" style="color:white;">
                                    <button class="btn btn-memove">ดูรายละเอียด</button>
                                </a>
                            </small>
                            @else
                                ออร์เดอร์ถูกยกเลิก
                                <a href="/order/detail/{{$order[0]->id}}" style="color:white;">
                                    <button class="btn btn-memove">ดูรายละเอียด</button>
                                </a>
                            @endif
                        @else
                            <button onclick="order()" class="btn btn-memove mt-3">สั่งเลย</button>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="order-post-wrap">
        <div class="container mt-4">
            <div class="text-center pl-3 pr-3 d-flex justify-content-between">
                <a href="/detail/{{$post->id}}">
                <button class="btn btn-link m-0 p-0"><i class="fas fa-arrow-left" style="font-size: 30px; color: black;"></i></button></a>
                <h3>
                    Order
                </h3>
                <div></div>
            </div>
            <div class="row p-3">
                <div class="col-12">
                    <div class="form-group">
                        <label for="text" class="control-label"><i class="fas fa-file-signature"></i> ระบุจำนวนที่จะฝากซื้อ</label>
                        <div class="block-order p-3 pl-4 pr-4 d-flex justify-content-between">
                            <span>ราคาสินค้า: {{$post->price}} ฿</span>
                            <div></div>
                            <div>
                                <button onclick="decrease()" class="btn btn-sm btn-link">-</button>
                                    <input class="text-center" disabled type="text" name="amount" id="amount" style="width:30px; border:none" value="1">
                                <button onclick="increase()" class="btn btn-sm btn-link">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text" class="control-label"><i class="fas fa-hand-holding-usd"></i> ราคาค่าหิ้ว</label>
                        <div class="block-order p-3 pl-4 pr-4 d-flex justify-content-end">
                            <input class="text-right" disabled type="text" style="border:none" value="{{$post->fee}}"> &nbsp;&nbsp; <img width="25" src="{{ url('') }}/img/coin.png">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text" class="control-label"><i class="fas fa-coins"></i> ราคารวม</label>
                        <div class="block-order p-3 pl-4 pr-4 d-flex justify-content-end">
                            <input class="text-right" disabled type="text" name="total" id="total" style="border:none" value="{{$post->price+$post->fee}}"> &nbsp;&nbsp; <img width="25" src="{{ url('') }}/img/coin.png">
                        </div>
                    </div>
                    <button onclick="pay()" class="btn btn-memove btn-block mt-5 p-3">ชำระเงิน</button>
                    <img src="{{ url('') }}/img/order.png" style="width:100%;" class="mt-5" alt="order" >
                </div>
            </div>
        </div>
    </div>
    <div id="pay-wrap">
        <div class="container mt-4">
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
                <form method="POST" action="/order/store" id="payment-form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <input class="form-control" name="type_post" type="hidden" id="type_post" value="{{$post->type_post}}">
                        <input class="form-control" name="user" type="hidden" id="user" value="{{ \Auth::user()->id  }}">
                        <input class="form-control" name="post" type="hidden" id="post" value="{{$post->id}}">
                        <input class="form-control" name="price" type="hidden" id="price" value="{{$post->price}}">
                        <input class="form-control" name="number" type="hidden" id="number" >
                        <input class="form-control" name="type" type="hidden" id="type">
                        <input class="form-control" name="status" type="hidden" id="status">
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
@endsection

<script>
    function order() {
        document.getElementById('detail-post-wrap').style.display = 'none';
        document.getElementById('order-post-wrap').style.display = 'block';
    }

    function pay() {
        var amount = document.getElementById('amount').value;
        var tt = <?php echo $post->price ?>*amount+<?php echo $post->fee ?>;

        document.getElementById('order-post-wrap').style.display = 'none';
        document.getElementById('pay-wrap').style.display = 'block';
        if(<? echo \Auth::user()->coin ?> < document.getElementById('total').value){
            document.getElementById('payment').style.display = 'none';
            document.getElementById('fill').style.display = 'block';
        } else {
            document.getElementById('payment').style.display = 'block';
            document.getElementById('fill').style.display = 'none';
        }
        document.getElementById('num-to-pay').innerText = tt;
        document.getElementById('price').value = tt;
        document.getElementById('number').value = amount;
    }

    function back() {
        document.getElementById('order-post-wrap').style.display = 'block';
        document.getElementById('pay-wrap').style.display = 'none';
    }

    function decrease() {
        if(document.getElementById('amount').value > 1) {
            var amount = document.getElementById('amount').value;
            amount--;
            var total = (<?php echo $post->price ?>*amount)+<?php echo $post->fee ?>;
            document.getElementById('amount').value = amount;
            document.getElementById('number').value = document.getElementById('amount').value;
            document.getElementById('num-to-pay').innerText = total;
            document.getElementById('total').value = total;
        }
    }

    function increase() {
        var amount = document.getElementById('amount').value;
        amount++;
        var total = <?php echo $post->price ?>*amount+<?php echo $post->fee ?>;
        document.getElementById('amount').value = amount;
        document.getElementById('number').value = document.getElementById('amount').value;
        document.getElementById('num-to-pay').innerText = total;
        document.getElementById('total').value = total;
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
</script>