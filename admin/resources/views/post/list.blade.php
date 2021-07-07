@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="text-center mb-4">
            <img class="mb-1" src={{ asset('img/logo.png') }} width="50" alt="logo">
            <img class="mb-1" src={{ asset('img/logo_text.png') }} width="100" alt="logo text">
        </div>
        <div class="row">
            <div class="col-12 mb-3 mt-3">
                <div class="row mr-2 ml-2">
                    <input type="text" class="form-control p-3" placeholder="&#xF002;  ค้นหาสิ่งที่คุณต้องการเลยทันที" style="background: #FFFFFF;font-weight: 300;box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.15);border-radius: 10px;font-family:'Kanit', sans-serif ,Arial, FontAwesome" id="search" name="search" onkeypress="return runScript(event)" />
                </div>
            </div>
            <div class="col-12 mb-5">
                <div class="row mr-2 ml-2">
                    <div class="col-6 p-2 text-center {{ request()->get('order') == 1 ? 'bg-c' : 'menu-search' }}" style="border-radius: 10px 0px 0px 10px;">
                        <a class="btn btn-block" href="/?order=1">ฝากซื้อ</a>
                    </div>
                    <div class="col-6 p-2 text-center {{ request()->get('order') == 2 ? 'bg-c' : 'menu-search' }}" style="border-radius: 0px 10px 10px 0px;">
                        <a class="btn btn-block" href="/?order=2">รับซื้อฝาก</a>
                    </div>
                </div>
            </div>
            
            @if(!empty($posts))
                @foreach($posts as $post)
                    <div class="col-6 text-center">
                        @if(request()->get('order') == 1)
                            <a href="/detail/{{$post->id}}">
                        @else
                            <a href="/post/detail/{{$post->id}}">
                        @endif
                            <div class="card-list mb-4 box-shadow ">
                                <div class="card-list-img">
                                    <img class="card-img-top" src="uploads/photos/{{$post->image}}" >
                                </div>
                                <div class="card-body p-0 pb-3" >
                                    <p class="mt-2">{{$post->title}}</p>
                                    <hr>
                                    <p class="card-text text-pink">ค่าสินค้า {{$post->price}} ฿</p>
                                </div>
                                
                            </div>
                        </a>
                    </div>
                @endforeach
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