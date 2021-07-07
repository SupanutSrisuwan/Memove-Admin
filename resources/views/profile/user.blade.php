@extends('layouts.app')

@section('content')
    <div class="container p-3">
        <div class="text-center d-flex justify-content-center">
            <h3>Profile</h3>
        </div>
        <div class="row mt-5">
            <div class="col-4">
                @if($user->img == null)
                    <img style="width: 100%" class="rounded-circle float-left" src="https://th.jobsdb.com/en-th/cms/employer/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png">
                @else
                    <img style="width: 100%" class="rounded-circle float-left" src="{{ url('') }}/uploads/photos/{{$user->img}}">
                @endif
            </div>
            <div class="col-8">
                <h2>{{ $user->username }}</h2>
                <small class="text-black" style="font-weight: 300">USER ID#{{ $user->id  }}</small>
                <p class="mt-3">
                    คณะ : {{ $user->major }}
                    <br>
                    รหัสนักศึกษา : {{ $user->student_id }}
                    <br>
                    <i class="fas fa-phone-alt mt-2"></i> {{ $user->phone }}
                </p>
            </div>
        </div>
        
    </div>
    <div class="row text-center" style="color: #0669B1;font-size:24px;">
        <div class="mb-3 mt-3 p-3 col-6" style="box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.2);">
            <i class="far fa-thumbs-up"></i> {{ $user->fav  }}
        </div>
        <div class="mb-3 mt-3 p-3 col-6" style="box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.2);">
            <i class="far fa-thumbs-down"></i> {{ $user->dislike  }}  
        </div>
    </div>
    <div class="container mb-5 ">
        <div class="row p-4">
            <h3 class="col-12 mb-4">Review</h3>
            @if($count > 0)
                @foreach($reviews as $review)
                @if($review->user_review === \Auth::user()->id)
                    <a href="/profile">
                @else
                    <a href="/profile/{{$review->user_review}}">
                @endif
                    <div class="col-12" style="box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.2);border-radius: 20px;">
                        <div class="row p-3">
                            <div class="col-3">
                                <?php 
                                    $ur = DB::table('users')->where('id', '=', $review->user_review)->get()
                                ?>
                                <img style="width: 100%" class="rounded-circle float-left" src="{{ url('') }}/uploads/photos/{{$ur[0]->img}}" >
                            </div>
                            <div class="col-9">
                            <span style="font-size:20px;">
                                {{$ur[0]->name}}
                            </span>
                            <br>
                            <span style="font-size:14px;font-weight: 200;">
                                {{ date("d/m/Y", strtotime($review->created_at)) }}
                            </span>
                            <br>
                            <span style="color: #6179E5;font-weight: 300;">
                                {{$review->review}}
                            </span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            @else
                <p class="col-12">ยังไม่มีการรีวิว</p>
            @endif
        </div>
    </div>
@endsection

<script>
</script>
