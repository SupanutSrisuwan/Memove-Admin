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
            <div class="row p-3">
                <div class="col-5 p-0">
                    <div class="p-3">
                        ชื่อผู้ใช้งาน
                    </div>
                </div>
                <div class="col-3 p-0 text-center">
                    <div class="p-3">
                        จำนวนเงิน
                    </div>
                </div>
                <div class="col-3 p-0 text-center">
                    <div class="p-3">
                        Action
                    </div>
                </div>
                <div class="col-1 p-0"></div>
                @if(!empty($b1))
                    @foreach($b1 as $b)
                    <div class="col-5 p-0">
                        <div class="p-3">
                            <?php
                                $user = DB::table('users')->where('id', '=', $b->user_id)->get()
                            ?>
                            <hr>
                            {{$user[0]->name}}
                        </div>
                    </div>
                    <div class="col-3 p-0 text-center">
                        <div class="p-3">
                            <hr>
                            {{$b->money}}
                        </div>
                    </div>
                    <div class="col-3 p-0 text-center">
                        <div class="p-3">
                        <hr>
                            @if($b->status == 'ยังไม่ไดด้รับการยืนยัน')
                                <a href="/topup/confirm/{{$b->id}}">
                                    <button class="btn btn-green">ยืนยัน</button>
                                </a>
                                <a href="/topup/cancel/{{$b->id}}">
                                    <button class="btn btn-memove">ล้มเหลว</button>
                                </a>
                            @else
                                {{$b->status}}
                            @endif
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