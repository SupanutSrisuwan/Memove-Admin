@extends('layouts.app')

@section('content')
<nav class="p-4" style="background: linear-gradient(90.12deg, #FF2547 0%, #FD8B9C 99.47%);color:#fff;font-size: 26.8711px;">
    <div class="container">
        <span>Report</span>
    </div>
</nav>

<div class="mt-4">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-10 p-4 pl-5">
            <div class="row p-3">
                <div class="col-5 p-0">
                    <div class="p-3">
                        หัวข้อ
                    </div>
                </div>
                <div class="col-3 p-0 text-center">
                    <div class="p-3">
                        รายละเอียด
                    </div>
                </div>
                <div class="col-3 p-0 text-center">
                    <div class="p-3">
                        ชื่อแจ้งปัญหา
                    </div>
                </div>
                <div class="col-1 p-0"></div>
                @if(!empty($reports))
                    @foreach($reports as $report)
                    <div class="col-5 p-0">
                        <div class="p-3">
                            <?php
                                $user = DB::table('users')->where('id', '=', $report->user_id)->get()
                            ?>
                            <hr>
                            {{$report->topic}}
                        </div>
                    </div>
                    <div class="col-3 p-0 text-center">
                        <div class="p-3">
                            <hr>
                            {{$report->message}}
                        </div>
                    </div>
                    <div class="col-3 p-0 text-center">
                        <div class="p-3">
                        <hr>
                            {{$user[0]->name}} ID#{{$user[0]->id}}
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