@extends('layouts.login')

@section('content')
    <div id="detail-post-wrap">
        <div style="position: absolute; top: 7%; left: 7%">
            <a class="position-relative" href="/?order=2">
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
                            <img width="50" class="float-left" src="{{ url('') }}/img/meeting-point.png">
                            <span class="ml-3 float-left" style="line-height: 1.2">
                                <label>สถานที่ซื้อของ</label>
                                <br>
                                <label class="text-pink" style="font-weight: 300">{{ $post->buy_at }}</label>
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
                        <div class="col-12 mt-4">
                            <img width="50" class="float-left" src="{{ url('') }}/img/hand.png">
                            <span class="ml-3 float-left" style="line-height: 1.2">
                                <label>ราคาของ</label> : <label class="text-pink ml-2" style="font-weight: 300">{{$post->price}} ฿</label>
                                <br>
                                จำนวน : <label class="text-pink ml-4" style="font-weight: 300">{{$post->amount}} ชิ้น</label>
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row pl-5 pr-5 pb-2">
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
                                Date {{ date("d/m/Y", strtotime($post->created_at)) }}
                            </label>
                        </a>
                        </div>
                        <div class="col-4 text-right">
                        @if($post->user === \Auth::user()->id)
                            <a href="" class="mt-3" style="color:white;">
                                <button class="btn btn-memove">แก้ไขโพส</button>
                            </a>
                        @elseif($count != 0)
                            <small class="mt-3">
                                <a href="/order/detail/{{$order[0]->id}}" style="color:white;">
                                    <button class="btn btn-memove">ดูรายละเอียด</button>
                                </a>
                            </small>
                        @else
                            <button onclick="order()" class="btn btn-memove mt-3">รับฝาก</button>
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
                <a href="/post/detail/{{$post->id}}">
                <button class="btn btn-link m-0 p-0"><i class="fas fa-arrow-left" style="font-size: 30px; color: black;"></i></button></a>
                <h3>
                    Order
                </h3>
                <div></div>
            </div>
            <div class="row p-3">
                <div class="col-12">
                    <div class="form-group">
                        <label for="text" class="control-label"><i class="fas fa-location-arrow"></i> สถานที่ซื้อ</label>
                        <div class="block-order p-3 pl-4 pr-4">
                            <span>{{$post->buy_at}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text" class="control-label"><i class="fas fa-money-bill-wave"></i> ราคาสินค้า</label>
                        <div class="block-order p-3 pl-4 pr-4 d-flex justify-content-between">
                            <span>ราคา : {{$post->price}} ฿</span>
                            <div></div>
                            <span>{{$post->amount}} ชิ้้น</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text" class="control-label"><i class="fas fa-hand-holding-usd"></i> ราคารวม</label>
                        <div class="block-order p-3 pl-4 pr-4 d-flex justify-content-end">
                            <span>{{$post->price*$post->amount}} บาท</span> &nbsp;&nbsp; <img width="25" src="{{ url('') }}/img/coin.png">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text" class="control-label"><i class="fas fa-file-signature"></i> ระบุราคาค่าหิ้ว</label>
                        <form method="POST" action="/order/store" id="payment-form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <input type="number" id="fee" name="fee" class="form-control block-order p-3 pr-4">
                            <input class="form-control" name="type_post" type="hidden" id="type_post" value="{{$post->type_post}}">
                            <input class="form-control" name="user" type="hidden" id="user" value="{{ \Auth::user()->id  }}">
                            <input class="form-control" name="post" type="hidden" id="post" value="{{$post->id}}">
                            <input class="form-control" name="price" type="hidden" id="price" value="{{$post->price}}">
                            <input class="form-control" name="number" type="hidden" id="number" value="{{$post->amount}}">
                            <input class="form-control" name="type" type="hidden" id="type">
                            <input class="form-control" name="status" type="hidden" id="status">
                        </form>
                    </div>
                    <button onclick="pay()" class="btn btn-memove btn-block mt-5 p-3">ยืนยันการรับฝาก</button>
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
        var total = <?php echo $post->price*$post->amount?>+parseInt(document.getElementById('fee').value);
        
        if(document.getElementById('fee').value != ""){
            document.getElementById('price').value = total;

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn border-radius-10'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'ยืนยันการรับฝากซื้อ',
                text: "ราคารวมทั้งหมด " + total + " บาท",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('status').value = 'ยังไม่ชำระเงิน';
                        document.getElementById('payment-form').submit();
                        swalWithBootstrapButtons.fire(
                        'สำเร็จ',
                        'รับออร์เดอร์เรียบร้อย',
                        'success'
                        )
                    }
                })
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'กรอกข้อมูลไม่ครบ',
                text: 'กรุณาใส่ราคาค่ารับฝากของ',
            })
        }
    }
</script>