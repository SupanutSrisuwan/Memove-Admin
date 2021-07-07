@extends('layouts.login')

@section('content')
<div class="container" id="part-one">
    <div class="text-center pl-3 pr-3 pt-5 d-flex justify-content-between">
        <a href="/login">
            <button class="btn btn-link m-0 p-0"><i class="fas fa-arrow-left" style="font-size: 25px; color: black;"></i></button>
        </a>
        <h4>
            สมัครสมาชิก
        </h4>
        <div></div>
    </div>
    <div class="row justify-content-center p-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="due" class="control-label">บัตรนักศึกษา<span class="text-pink">*</span></label>
                    <input class="form-control" style="height: 200px;background: #FA3654;box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.25);border-radius: 18px;" name="photo" id="photo" type="file" onchange="readURL(this)">
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">ชื่อ-นามสกุล<span class="text-pink">*</span></label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="text-md-right">รหัสนักศึกษา<span class="text-pink">*</span></label>
                    <input id="studentID" type="number" class="form-control" name="studentID" value="" required autocomplete="studentID" autofocus>
                </div>
                <div class="form-group">
                    <label for="name" class="text-md-right">คณะ<span class="text-pink">*</span></label>
                    <select class="form-control" id="major" name="major" style="background: #FA3654;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);">
                        <option value="คณะเทคโนโลยีสารสนเทศและการสื่อสาร">คณะเทคโนโลยีสารสนเทศและการสื่อสาร</option>
                        <option value="คณะสัตวศาสตร์และเทคโนโลยีการเกษตร">คณะสัตวศาสตร์และเทคโนโลยีการเกษตร</option>
                        <option value="คณะวิทยาการจัดการ">คณะวิทยาการจัดการ</option>
                    </select>
                </div>
                <input id="coin" type="hidden" class="form-control" name="coin" value="0">
                <button onclick="nextOne()" type="button" class="p-3 mt-5 btn btn-block btn-memove">
                    ถัดไป
                </button>
        </div>
    </div>
</div>

<div class="container" id="part-two">
    <div class="text-center pl-3 pr-3 pt-5 d-flex justify-content-between">
        <button onclick="backOne()" class="btn btn-link m-0 p-0 ml-2"><i class="fas fa-arrow-left" style="font-size: 25px; color: black;"></i></button>
        <h4>
            สมัครสมาชิก
        </h4>
        <div></div>
    </div>
    <div class="row justify-content-center p-5">
        <div class="col-md-8">
                <div class="form-group">
                    <label for="name" class="text-md-right">username<span class="text-pink">*</span></label>
                    <input id="username" type="text" class="form-control" name="username" value="" required autocomplete="username" autofocus>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}<span class="text-pink">*</span></label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">รหัสผ่าน</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">ยืนยันรหัสผ่าน</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="text-md-right">เบอร์โทรศัพทมือถือ<span class="text-pink">*</span></label>
                    <input id="phone" type="text" class="form-control" name="phone" value="" required autocomplete="phone" autofocus>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3 ">
                        <button type="submit" class="mt-5 p-3 btn btn-block btn-memove">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('blah').setAttribute('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }

    }

    function nextOne() {
        document.getElementById('part-one').style.display = 'none';
        document.getElementById('part-two').style.display = 'block';
    }
        
    function backOne() {
        document.getElementById('part-one').style.display = 'block';
        document.getElementById('part-two').style.display = 'none';
    }
</script>