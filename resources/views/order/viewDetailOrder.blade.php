@extends('layouts.login')

@section('content')
    <div id="post-wrap">
        <div>
            <div class=" mt-4">
                <div class="text-center pl-3 pr-3 d-flex justify-content-between">
                    <a href="/order/post/{{$post->id}}">
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
            <div style="{{$order->status === 'in progress' ? 'background: #2DB589;color:#fff;' : 'background: #EAEAEA;color:#2DB589;'}}" class=" p-3">
                <div class="row pl-3 pr-3">
                    <div class="col-6">
                        <span >ช่องการชำระเงิน : {{$order->pay}}</span>
                    </div>
                    <div class="col-6 text-right">
                        @if($order->statement === 'ชำระเงินแล้ว')
                            <span >{{$order->statement}}</span>
                        @else
                            <span>{{$order->statement}}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div style="{{$order->status === 'in progress' ? 'background: #E93F3F;color:#fff;' : 'background: rgba(196, 196, 196, 0.6);color:#E93F3F;'}}" class=" p-3">
                <div class="row pl-3 pr-3">
                    <div class="col-12 text-right">
                    @if($order->status === 'pending')
                        <span>กำลังดำเนินการ</span>
                    @elseif($order->status === 'in progress')
                        <span>*ยังไม่ได้รับการยืนยัน</span>
                    @elseif($order->status === 'pending:success')
                        <span style="color:#2DB589;">การส่งสินค้าสำเร็จ</span>
                    @endif
                    </div>
                </div>
            </div>
            <img src="{{ url('') }}/img/order.png" style="width:100%;" alt="order detail" >
            <div class="mt-5 pt-5 fixed-bottom" style="bottom:3%;">
                <div class="row pl-3 pr-3 mt-5 pt-5">
                    @if($order->status === 'in progress')
                    <div class="col-12 mt-5">
                            <a href="/order/confirm/{{$order->id}}">
                                <button class="btn btn-block p-3" style="font-size:20px;background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                                    ยืนยันการรับออร์เดอร์
                                </button>
                            </a>
                    </div>
                    <div class="col-12 mt-4">
                            <button onclick="cancel({{$order->id}})" class="btn btn-block p-3" style="background: #E93F3F;color:#fff;font-size:20px;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                                ยกเลิก
                            </button>
                    </div>
                    @elseif($order->status === 'success')
                    <div class="col-12 mt-5">
                        <a href="/?order=1">
                        <button class="btn btn-block p-3" style="font-size:20px;background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                            ไปหน้าหลัก
                        </button>
                        </a>
                    </div>
                    @else
                    <div class="col-12 mt-5">
                        <button onclick="status()" class="btn btn-block p-3" style="font-size:20px;background: #2DB589;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;">
                            ดูสถานะสินค้า
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="pay-wrap">
        <div class=" mt-4">
            <div class="text-center pl-3 pr-3 d-flex justify-content-between">
                <button onclick="back()" class="btn btn-link m-0 p-0"><i class="fas fa-arrow-left" style="font-size: 30px; color: black;"></i></button>
                <h3>
                    Detail Order
                </h3>
                <div></div>
            </div>
            @if($order->status == 'pending')
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
    function status() {
        document.getElementById('post-wrap').style.display = 'none';
        document.getElementById('pay-wrap').style.display = 'block';
    }

    function back() {
        document.getElementById('post-wrap').style.display = 'block';
        document.getElementById('pay-wrap').style.display = 'none';
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

    function cancel(id) {
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-memove ml-2',
            cancelButton: 'btn btn-or'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'คุณต้องการจะยกเลิกออร์เดอร์',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        reverseButtons: true
        }).then((result) => {
            
            if (result.isConfirmed) {
            window.location = '/order/cancel/'+ id
        }
        })
    }

    function statusUpdate(status, id) {
        window.location = '/order/'+id+'/' + status
    }

    function statusUpdateSuccess(status, id) {
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-green ml-2',
            cancelButton: 'btn btn-dander'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'คุณต้องการยืนยันการส่งสินค้า',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'ยืนยันการรับของ',
        cancelButtonText: 'ไม่พบผู้สั่งสินค้า',
        reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
            statusUpdate(status, id)
        }
        })
    }
</script>