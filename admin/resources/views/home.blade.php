@extends('layouts.app')

@section('content')
<nav class="p-4" style="background: linear-gradient(90.12deg, #FF2547 0%, #FD8B9C 99.47%);color:#fff;font-size: 26.8711px;">
    <div class="container">
        <span>Dashboard</span>
    </div>
</nav>

<div class="mt-4">
    <div class="row text-center">
        <div class="col-2"></div>
        <div class="col-10 p-4 pl-5">
            <div class="row p-3">
                <div class="col-3">
                    <div class="p-4" style="background: #FFFFFF;box-shadow: 0px 11.7976px 14.747px rgba(0, 0, 0, 0.05), 0px 0px 3.53929px rgba(0, 0, 0, 0.15), 0px 2.35952px 2.35952px rgba(0, 0, 0, 0.25);border-radius: 1.76964px;">
                        <span style="font-weight: 300;">จำนวนโพสท์รับฝากซื้อ</span>
                        <br><br>
                        <h4>{{$post1}} รายการ</h4>
                    </div>
                </div>
                <div class="col-3">
                    <div class="p-4" style="background: #FFFFFF;box-shadow: 0px 11.7976px 14.747px rgba(0, 0, 0, 0.05), 0px 0px 3.53929px rgba(0, 0, 0, 0.15), 0px 2.35952px 2.35952px rgba(0, 0, 0, 0.25);border-radius: 1.76964px;">
                        <span style="font-weight: 300;">จำนวนโพสท์ฝากซื้อ</span>
                        <br><br>
                        <h4>{{$post2}} รายการ</h4>
                    </div>
                </div>
                <div class="col-5">
                    <div class="p-4" style="background: #FFFFFF;box-shadow: 0px 11.7976px 14.747px rgba(0, 0, 0, 0.05), 0px 0px 3.53929px rgba(0, 0, 0, 0.15), 0px 2.35952px 2.35952px rgba(0, 0, 0, 0.25);border-radius: 1.76964px;">
                        <span style="">รายได้ของ Memove application</span>
                        <br><br>
                        <h5 style="font-weight: 600;"> 2,043 บาท ++ </h5>
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-6 mt-4">
                    <div class="row">
                        <div class="col-6">
                            <div class="p-4" style="background: #FFFFFF;box-shadow: 0px 11.7976px 14.747px rgba(0, 0, 0, 0.05), 0px 0px 3.53929px rgba(0, 0, 0, 0.15), 0px 2.35952px 2.35952px rgba(0, 0, 0, 0.25);border-radius: 1.76964px;">
                                <span style="font-weight: 300;">จำนวนการแจ้งปัญหา</span>
                                <br><br>
                                <h4>{{$report}}</h4>
                                <h4>รายการ</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-4" style="background: #FFFFFF;box-shadow: 0px 11.7976px 14.747px rgba(0, 0, 0, 0.05), 0px 0px 3.53929px rgba(0, 0, 0, 0.15), 0px 2.35952px 2.35952px rgba(0, 0, 0, 0.25);border-radius: 1.76964px;">
                                <span style="font-weight: 300;">จำนวน User ทั้งหมดในระบบ</span>
                                <br><br>
                                <h4>{{$users}}</h4>
                                <h4>รายการ</h4>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="p-4" style="background: #FFFFFF;box-shadow: 0px 11.7976px 14.747px rgba(0, 0, 0, 0.05), 0px 0px 3.53929px rgba(0, 0, 0, 0.15), 0px 2.35952px 2.35952px rgba(0, 0, 0, 0.25);border-radius: 1.76964px;">
                                
                                <h4><span style="font-weight: 300;" class="mr-5">จำนวนการเติมเงินเข้า</span> {{$b2}} รายการ</h4>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="p-4" style="background: #FFFFFF;box-shadow: 0px 11.7976px 14.747px rgba(0, 0, 0, 0.05), 0px 0px 3.53929px rgba(0, 0, 0, 0.15), 0px 2.35952px 2.35952px rgba(0, 0, 0, 0.25);border-radius: 1.76964px;">
                                
                                <h4><span style="font-weight: 300;" class="mr-5">จำนวนการถอนเงินออก</span> {{$b1}} รายการ</h4>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-5 mt-4">
                    <div class="p-4" style="background: #FFFFFF;box-shadow: 0px 11.7976px 14.747px rgba(0, 0, 0, 0.05), 0px 0px 3.53929px rgba(0, 0, 0, 0.15), 0px 2.35952px 2.35952px rgba(0, 0, 0, 0.25);border-radius: 1.76964px;">
                        <img style="width: 100%" class="" src="{{ url('') }}/img/1x1.png">
                    </div>
                </div>
                <div class="col-1 mt-4"></div>
            </div>
        </div>
    </div>
</div>

@endsection