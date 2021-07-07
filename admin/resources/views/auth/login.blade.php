@extends('layouts.login')

@section('content')
<div class="container" style="margin-top:8rem;">
    <div id="logo-wrap" class="row">
        <img class="col-4 offset-4" src={{ asset('img/logo.png') }} alt="logo">
        <img class="col-4 offset-4 mt-3" src={{ asset('img/logo_text.png') }} width="100" alt="logo text">
        <div class="col-4 offset-4 mt-5 text-center"><i class="fas fa-spinner fa-spin"></i></div>        
    </div>
    <div id="login-wrap" class="row justify-content-center p-5">
        <div class="col-12 text-left mb-4">
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center">
                <img class="" src={{ asset('img/logo.png') }} alt="logo">
                <h3 class="ml-1" style="font-weight: 300;">Admin Dashboard</h3>
                </div>
            </div>
        </div>
        <div class="col-12">
        <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group row mb-4">
                    <div class="col-md-6 offset-md-3">
                        <input id="email" placeholder="E-Mail Address" type="email" class="form-control @error('email') is-invalid @enderror pl-4" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="background: #FFF;border-color:#FA3654;color:#FA3654;">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <div class="col-md-6 offset-md-3">
                        <input id="password" type="password" class="pl-4 form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password" style="background: #FFF;border-color:#FA3654;color:#FA3654;">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-block btn-memove" style="border-radius: 25px;">
                            {{ __('Sign In') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link float-right" href="{{ route('password.request') }}">
                                <small class="text-pink">Forgot Your Password?</small>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    setTimeout(function(){
        document.getElementById('logo-wrap').style.display = 'none';
        document.getElementById('login-wrap').style.display = 'block';
    }, 1000); // 10000ms = 10s
</script>
