@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="d-flex justify-content-between">
            <a href="/?order=1" class="mt-3">
                <i class="fas fa-arrow-left" style="font-size: 25px; color: black;"></i>
            </a>
            <div class="text-center mb-4">
                <img class="mb-1" src={{ asset('img/logo.png') }} width="50" alt="logo">
                <img class="mb-1" src={{ asset('img/logo_text.png') }} width="100" alt="logo text">
            </div>
            <div></div>
        </div>
        
        <div class="row">
            <div class="col-12 mb-3 mt-3">
                <div class="row mr-2 ml-2">
                    <input type="text" value="{{$name}}" class="form-control p-3" placeholder="&#xF002;  ค้นหาสิ่งที่คุณต้องการเลยทันที" style="background: #FFFFFF;font-weight: 300;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.15);border-radius: 10px;font-family:'Kanit', sans-serif ,Arial, FontAwesome" id="search" name="search" onkeypress="return runScript(event)" />
                </div>
            </div>
            
            @if(!empty($posts) && $count > 0)
                @foreach($posts as $post)
                    <div class="col-6 text-center">
                        @if(request()->get('order') == 1)
                            <a href="/detail/{{$post->id}}">
                        @else
                            <a href="/post/detail/{{$post->id}}">
                        @endif
                            <div class="card-list mb-4 box-shadow ">
                                <div class="card-list-img">
                                    <img class="card-img-top" src="{{ url('') }}/uploads/photos/{{$post->image}}" >
                                </div>
                                <div class="card-body p-0 pb-3" >
                                    <p class="mt-2">{{$post->title}}</p>
                                    <hr>
                                    @if($post->type_post == 1)
                                        รับฝากซื้อ
                                    @else
                                        หาคนรับซื้อให้
                                    @endif
                                    <hr>
                                    <p class="card-text text-pink">ค่าสินค้า {{$post->price}} ฿</p>
                                </div>
                                
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
            <div class="col-12 mb-3 mt-3">
                <div class="row mr-2 ml-2">
                    ไม่มีโพสที่ตรงกับการค้นหา
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

<script>
    function runScript(e) {
        if (e.keyCode == 13) {
            let search = document.getElementById("search").value;
            window.location = '/search/' + search
        }
    }
</script>