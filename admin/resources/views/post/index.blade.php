@extends('layouts.app')

@section('content')
    <div class="container mb-5" id="part-one">
        <div class="row text-center justify-content-between mb-4 p-2">
            <div class="ml-4"></div>
            <div class="row">
                <div class="num-active">1</div>
                <hr class="num-hr m-0 mt-2">
                <div class="num">2</div>
                <hr class="num-hr m-0 mt-2">
                <div class="num">3</div>
            </div>
            <button onclick="nextOne()" class="btn btn-link m-0 p-0 mr-2"><i class="fas fa-arrow-right" style="font-size: 24px; color: black;"></i></button>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <input type="radio" name="f-type_post" id="f-type_post" value="1">
                    <label for="text" class="control-label"><i class="fas fa-border-all"></i> เลือกประเภทโพส</label>
                    <div class="row text-center pl-3 pr-3">
                        <label class="type-check col-6">
                            <input type="radio" name="f-type_post" onclick="myFunction(this.value)" checked value="1">
                            <check class="row p-3" style="border-radius: 10px 0px 0px 10px;">
                                <div class="col-12">
                                    รับฝากซื้อ
                                </div>
                            </check>
                        </label>
                        <label class="type-check col-6">
                            <input type="radio" name="f-type_post" onclick="myFunction(this.value)" value="2">
                            <check class="row p-3" style="border-radius: 0px 10px 10px 0px;">
                                <div class="col-12">
                                     ขอฝากซื้อ
                                </div>
                            </check>
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label for="text" class="control-label"><i class="fas fa-border-all"></i> เลือกประเภทของ</label>
                        <select class="form-control pl-3 pr-3" style="background: #FF2547;color:#fff;height: 51px;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);border-radius: 10px;" id="f-category" name="f-category">
                            <option selected>เลือกประเภทของ</option>
                            @if(!empty($categories))
                                @foreach($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="text" class="control-label"><i class="fas fa-file-signature"></i> ตั้งชื่อโพสท์</label>
                        <input class="form-control sy-input" style="height: 51px;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.15);border-radius: 10px;" name="f-title" placeholder="หาคนรับฝากซื้อ...." type="text" id="f-title">
                    </div>

                    <div class="form-group">
                        <label for="body" class="control-label"><i class="fas fa-file-signature"></i> เพิ่มรายละเอียดสินค้า</label>
                        <textarea class="form-control" style="box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.15);border-radius: 10px;" placeholder="รุ่น ยี่ห้อ Size  ความต้องการเพิ่มเติม..." name="f-description" cols="50" rows="5" id="f-description"></textarea>
                    </div>
                    
                    <div class="form-group mb-5">
                        <label for="due" class="control-label"><i class="far fa-image"></i> เพิ่มรูปภาพสินค้า</label>
                        <form method="POST" action="/post/store" style="margin-bottom:100px;" id="form-store" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="user" type="hidden" id="user" value="{{ \Auth::user()->id  }}">
                            <input name="price" type="hidden" id="price">
                            <input name="date-time" type="datetime-local" id="date-time" style="display:none;">
                            <input name="buy_at" type="hidden" id="buy_at">
                            <input name="place" type="hidden" id="place">
                            <input name="des-place" type="hidden" id="des-place">
                            <input type="hidden" name="type_post" id="type_post" >
                            <input type="hidden" name="description" id="description" >
                            <input type="hidden" name="title" id="title" >
                            <input type="hidden" name="category" id="category" >
                            <input type="hidden" name="fee" id="fee" >
                            <input type="hidden" name="amount" id="amount" >
                            <input class="form-control" style="height: 51px;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.15);border-radius: 10px;" name="photo" id="photo" type="file" onchange="readURL(this)">
                        </form>
                    </div>
            </div>
        </div>
    </div>
    <div class="container mb-5" id="part-two">
        <div class="row text-center justify-content-between mb-4 p-2">
            <button onclick="backOne()" class="btn btn-link m-0 p-0 ml-2"><i class="fas fa-arrow-left" style="font-size: 24px; color: black;"></i></button>
            <div class="row">
                <div class="num-active">1</div>
                <hr class="num-hr-active m-0 mt-2">
                <div class="num-active">2</div>
                <hr class="num-hr m-0 mt-2">
                <div class="num">3</div>
            </div>
            <button onclick="nextTwo()" class="btn btn-link m-0 p-0 mr-2"><i class="fas fa-arrow-right" style="font-size: 24px; color: black;"></i></button>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                    <div class="form-group">
                        <label for="text" class="control-label"><i class="fas fa-map-marker-alt"></i> ระบุสถานที่นัดหมาย</label>
                        <select class="form-control" id="f-place" name="f-place" style="border-radius: 10px;height: 51px;background: #FA3654;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);">
                            <option value="ข้อมูลสถานที่นัดหมาย">ข้อมูลสถานที่นัดหมาย</option>
                            <option value="อาคารเรียนรวม 1">อาคารเรียนรวม 1</option>
                            <option value="อาคารเรียนรวม 2">อาคารเรียนรวม 2</option>
                            <option value="อาคารยานยนต์">อาคารยานยนต์</option>
                            <option value="โรงยิม">โรงยิม</option>
                            <option value="โรงอาหาร หอ2">โรงอาหาร หอ2</option>
                            <option value="หอพัก 1">หอพัก 1</option>
                            <option value="หอพัก 2">หอพัก 2</option>
                            <option value="หอพัก 3">หอพัก 3</option>
                            <option value="หอพัก 4">หอพัก 4</option>
                            <option value="หอพัก 5">หอพัก 5</option>
                            <option value="หอพัก 6">หอพัก 6</option>
                            <option value="Su Cafe">Su Cafe</option>
                            <option value="7-Eleven">7-Eleven</option>
                            <option value="อาคารบริหาร">อาคารบริหาร</option>
                            <option value="สนามฟุตบอล">สนามฟุตบอล</option>
                            <option value="สนามบาสเก็ตบอล">สนามบาสเก็ตบอล</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="body" class="control-label"><i class="fas fa-file-signature"></i> รายละเอียดสถานที่เพิ่มเติม</label>
                        <textarea class="form-control" style="box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.15);border-radius: 10px;" placeholder="รายละเอียดสถานที่เพิ่มเติม เช่น หน้าประตูทางเข้าหอ" name="f-description-pickup" cols="50" rows="5" id="f-description-pickup"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="text" class="control-label"><i class="fas fa-hand-holding-usd"></i> ราคาสินค้า</label>
                        <input class="form-control" style="height: 51px;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.15);border-radius: 10px;" name="f-price" type="number" id="f-price">
                    </div> 
                    <div id="fristtype">
                        <div class="form-group">
                            <label for="text" class="control-label"><i class="fas fa-hand-holding-usd"></i> เสนอราคาหิ้ว</label>
                            <input class="form-control" style="height: 51px;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.15);border-radius: 10px;" name="f-fee" type="number" id="f-fee">
                        </div>
                    </div>
                    <div id="secondtype"> 
                        <div class="form-group">
                            <label for="text" class="control-label"><i class="fas fa-file-signature"></i> จำนวนที่ต้องการ</label>
                            <input class="form-control" style="height: 51px;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.15);border-radius: 10px;" name="f-amount" type="number" id="f-amount">
                        </div>
                        <div class="form-group">
                            <label for="body" class="control-label"><i class="fas fa-file-signature"></i> รายละเอียดสถานที่ซื้อสินค้า</label>
                            <textarea class="form-control" style="box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.15);border-radius: 10px;" placeholder="อาคาร..." name="f-description-place" cols="50" rows="5" id="f-description-place"></textarea>
                        </div>
                    </div>   
                    <div class="form-group mb-5">
                        <label for="text" class="control-label"><i class="far fa-clock"></i> เวลารับสินค้า</label>
                        <input class="form-control" type="datetime-local" id="f-date-time"
                                style="height: 51px;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.15);border-radius: 10px;"
                                name="f-date-time"
                                min="2021-01-01T00:00" max="2021-12-31T00:00">
                    </div>
            </div>
        </div>
    </div>
    <div id="part-three" class="position-relative">
        <div style="position: absolute; top: 7%; left: 7%">
            <button onclick="backTwo()" class="position-relative btn btn-link m-0 p-0 ml-2">
                <i class="fas fa-arrow-left" style="font-size: 30px; color: black; text-shadow: -1px 1px 8px rgba(0,0,0,0.6);"></i>
                <i class="fas fa-arrow-left" style="font-size: 30px; color: white; position: absolute;left:1px;"></i>
            </button>
        </div>
        <div style="position: absolute; top: 3%; right: 7%">
            <button onclick="create()" class="btn btn-memove mt-3 mb-5 btn-block">สร้างโพสเลย</button>
        </div>
        
        <img id="blah" style="width: 100%;" src="#" alt="your image" />
        <div class="mb-5 position-relative">
            <div class="card-detail">
                <div class="">
                    <div class="row p-5 mb-5">
                        <div class="col-3">
                            <img width="100" id="tp">
                        </div>
                        <div class="col-9">
                            <h3 class="float-left mt-2" id="head"></h3>
                        </div>
                        <div class="col-12 mt-5">
                            <h5>รายละเอียด</h5>
                            <p style="color: #A0A0A0;" id="type-name"></p>
                            <p style="color: #A0A0A0;" id="text-des"></p>
                        </div>
                        
                        <div class="col-12 mt-4">
                            <img width="50" class="float-left" src="{{ url('') }}/img/time.png">
                            <span class="ml-3 float-left" style="line-height: 1.2">
                                <label>ส่งภายใน</label>
                                <br>
                                <label class="text-pink" style="font-weight: 300" id="text-time"></label>
                            </span>
                        </div>
                        <div class="col-12 mt-4">
                            <img width="50" class="float-left" src="{{ url('') }}/img/courier.png">
                            <span class="ml-3 float-left" style="line-height: 1.2">
                                <label>สถานที่นัดรับ</label>
                                <br>
                                <label class="text-pink" style="font-weight: 300" id="text-place"></label>
                            </span>
                            <span class="ml-3 float-left" style="line-height: 1.2">
                                <label>รายละเอียดสถานที่เพิ่มเติม</label>
                                <br>
                                <label class="text-pink" style="font-weight: 300" id="text-des-place"></label>
                            </span>
                        </div>
                        <div class="col-12 mt-4">
                            <img width="50" class="float-left" src="{{ url('') }}/img/exchange.png">
                            <span class="ml-3 float-left" style="line-height: 1.2">
                                <label>ราคาสินค้า</label>
                                <br>
                                <label class="text-pink" style="font-weight: 300" id="text-price"></label>
                            </span>
                        </div>
                        <div id="frist"> 
                            <div class="col-12 mt-4 mb-5">
                                <img width="50" class="float-left" src="{{ url('') }}/img/exchange.png">
                                <span class="ml-3 float-left" style="line-height: 1.2">
                                    <label>ราคาหิ้ว</label>
                                    <br>
                                    <label class="text-pink" style="font-weight: 300" id="text-fee"></label>
                                </span>
                            </div>
                        </div>
                        <div id="second"> 
                            <div class="col-12 mt-4 mb-5">
                                <img width="50" class="float-left" src="{{ url('') }}/img/exchange.png">
                                <span class="ml-3 float-left" style="line-height: 1.2">
                                    <label>จำนวน</label>
                                    <br>
                                    <label class="text-pink" style="font-weight: 300" id="text-amount"></label>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
    function nextOne() {
        document.getElementById('part-one').style.display = 'none';
        document.getElementById('part-two').style.display = 'block';
        document.getElementById('part-three').style.display = 'none';

        if(document.getElementById("f-type_post").value == '1'){
            document.getElementById('fristtype').style.display = 'block';
            document.getElementById('secondtype').style.display = 'none';
        } else {
            document.getElementById('fristtype').style.display = 'none';
            document.getElementById('secondtype').style.display = 'block';
        }
    }
        
    function backOne() {
        document.getElementById('part-one').style.display = 'block';
        document.getElementById('part-two').style.display = 'none';
        document.getElementById('part-three').style.display = 'none';
    }

    function nextTwo() {
        document.getElementById('part-one').style.display = 'none';
        document.getElementById('part-two').style.display = 'none';
        document.getElementById('part-three').style.display = 'block';
        document.getElementById('part-three').style.marginTop = '-25px';

        document.getElementById('text-fee').innerText = document.getElementById('f-fee').value;
        document.getElementById('text-amount').innerText = document.getElementById('f-amount').value;

        document.getElementById('head').innerText = document.getElementById('f-title').value;
        if(document.getElementById("f-type_post").value == '1'){
            document.getElementById('type-name').innerText = "เดี๋ยวซื้อให้";
            document.getElementById('frist').style.display = 'block';
            document.getElementById('second').style.display = 'none';
        } else {
            document.getElementById('type-name').innerText = "ฝากซื้อหน่อย";
            document.getElementById('frist').style.display = 'none';
            document.getElementById('second').style.display = 'block';
        }
        document.getElementById('text-des').innerText = document.getElementById('f-description').value;
        document.getElementById('text-time').innerText = new Date(document.getElementById('f-date-time').value).toLocaleString();
        document.getElementById('text-price').innerText = document.getElementById('f-price').value + " ฿";
        document.getElementById('text-place').innerText = document.getElementById('f-place').value;
        document.getElementById('text-des-place').innerText = document.getElementById('f-description-pickup').value;

        if(document.getElementById("f-category").value == 'อาหาร & เครื่องดื่ม'){
            document.getElementById('tp').setAttribute('src', '{{ url('') }}/img/fast-food.png');
        } else if(document.getElementById("f-category").value == 'เสื้อผ้า & เครื่องแต่งกาย'){
            document.getElementById('tp').setAttribute('src', '{{ url('') }}/img/casual-t-shirt-.png');
        } else if(document.getElementById("f-category").value == 'อุปกรณ์อิเล็กทรอนิกส'){
            document.getElementById('tp').setAttribute('src', '{{ url('') }}/img/device.png');
        } else if(document.getElementById("f-category").value == 'อุปกรณ์การเรียน'){
            document.getElementById('tp').setAttribute('src', '{{ url('') }}/img/education.png');
        }
    }

    function backTwo() {
        document.getElementById('part-one').style.display = 'none';
        document.getElementById('part-two').style.display = 'block';
        document.getElementById('part-three').style.display = 'none';
    }
    
    function myFunction(browser) {
        document.getElementById("f-type_post").value = browser;
    }

    function create() {
        document.getElementById('price').value = document.getElementById('f-price').value;
        document.getElementById('place').value = document.getElementById('f-place').value;
        document.getElementById('des-place').value = document.getElementById('f-description-pickup').value;
        document.getElementById('date-time').value = document.getElementById('f-date-time').value;
        document.getElementById('buy_at').value = document.getElementById('f-description-place').value;
        document.getElementById('type_post').value = document.getElementById('f-type_post').value;
        document.getElementById('description').value = document.getElementById('f-description').value;
        document.getElementById('title').value = document.getElementById('f-title').value;
        document.getElementById('category').value = document.getElementById('f-category').value;
        document.getElementById('fee').value = document.getElementById('f-fee').value;
        document.getElementById('amount').value = document.getElementById('f-amount').value;
        document.getElementById('form-store').submit();
    }
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('blah').setAttribute('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }

    }
    
</script>