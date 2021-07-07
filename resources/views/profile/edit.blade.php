@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="text-center">
            <h3 class="mb-5">แก้ไขโปรไฟล์</h3>
        </div>
        <form method="POST" action="/profile/edit" enctype="multipart/form-data">
                    {{ csrf_field() }}
        <div class="row justify-content-center pb-5">
            <div class="col-12 text-center">
                <img id="blah" width="100" class="rounded-circle" alt="your image" src="{{ url('') }}/uploads/photos/{{ $user->img}}" />
            </div>
            <div class="col-md-12 mt-5">
                    <div class="form-group">
                        <label for="text" class="control-label">ชื่อที่ใช้ใน Memove</label>
                        <input class="form-control" name="username" type="text" id="username" value="{{ $user->username }}">
                    </div>
                    <div class="form-group">
                        <label for="body" class="control-label">เกี่ยวกับฉัน</label>
                        <textarea class="form-control" name="description" cols="50" rows="5" id="body">
                            {{ $user->description }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="text" class="control-label">ชื่อ-นามสกุล</label>
                        <input class="form-control" name="name" type="text" id="name" value="{{ $user->name }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="name" class="text-md-right">รหัสนักศึกษา<span class="text-pink">*</span></label>
                        <input id="studentID" type="text" class="form-control" name="studentID" value="{{ $user->student_id }}" required autocomplete="studentID" autofocus>
                    </div>

                    <div class="form-group">
                        <label for="name" class="text-md-right">คณะ<span class="text-pink">*</span></label>
                        <select class="form-control" id="major" name="major" style="background: #FA3654;color:#fff;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.25);">
                            <option {{$user->major == 'คณะเทคโนโลยีสารสนเทศและการสื่อสาร'  ? 'selected' : ''}} value="คณะเทคโนโลยีสารสนเทศและการสื่อสาร">คณะเทคโนโลยีสารสนเทศและการสื่อสาร</option>
                            <option {{$user->major == 'คณะสัตวศาสตร์และเทคโนโลยีการเกษตร'  ? 'selected' : ''}} value="คณะสัตวศาสตร์และเทคโนโลยีการเกษตร">คณะสัตวศาสตร์และเทคโนโลยีการเกษตร</option>
                            <option {{$user->major == 'คณะวิทยาการจัดการ'  ? 'selected' : ''}} value="คณะวิทยาการจัดการ">คณะวิทยาการจัดการ</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name" class="text-md-right">เบอร์โทรศัพทมือถือ<span class="text-pink">*</span></label>
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}" required autocomplete="phone" autofocus>
                    </div>

                    <div class="form-group">
                        <label for="due" class="control-label">File</label>
                        <input class="form-control" style="height: 51px;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.15);border-radius: 10px;" name="photo" id="photo" type="file" onchange="readURL(this)">
                    </div>

                    <input class="form-control" name="user" type="hidden" id="user" value="{{ \Auth::user()->id  }}">
                    <div>
                        <input class="btn btn-memove-w btn-block" type="submit" value="Submit">
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
</script>