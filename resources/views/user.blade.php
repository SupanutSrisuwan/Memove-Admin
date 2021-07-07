@extends('layouts.app')

@section('content')
<nav class="p-4" style="background: linear-gradient(90.12deg, #FF2547 0%, #FD8B9C 99.47%);color:#fff;font-size: 26.8711px;">
    <div class="container">
        <span>Dashboard</span>
    </div>
</nav>

<div class="mt-4">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-10 p-4 pl-5">
            <h3>User</h3>
            <div class="row p-3">
                @if(!empty($users))
                    @foreach($users as $user)
                    <div class="col-3 p-0">
                        <div class="p-2">
                            <hr>
                            {{$user->name}}
                        </div>
                    </div>
                    <div class="col-8 p-0">
                        <div class="p-2">
                            <hr>
                            ชื่อที่ใช้ใน memove : {{$user->username}}
                        </div>
                    </div>
                    <div class="col-1 p-0"></div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@endsection