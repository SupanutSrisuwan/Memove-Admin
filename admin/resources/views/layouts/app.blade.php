<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Memove</title>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href={{ asset('css/style.css') }} rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.1/sweetalert2.css" integrity="sha512-tAB44Mx++ci+FGvwu3N7f1RSXeN2s+M+pbJHHbYOmkla05H3zV0Y/LFVtwFAPU92HQcLj6SRHS925pcBBxJ4XQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.1/sweetalert2.min.css" integrity="sha512-A374yR9LJTApGsMhH1Mn4e9yh0ngysmlMwt/uKPpudcFwLNDgN3E9S/ZeHcWTbyhb5bVHCtvqWey9DLXB4MmZg==" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.1/sweetalert2.min.js" integrity="sha512-haPWapEH4geHw14UUzxrXfv7WygtauJoqmcg9f3HRgqE1cr+TSlB8hqsyq0F3i34DUsvq9k3r8uCjJFBmdDE4g==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.1/sweetalert2.all.min.js" integrity="sha512-ojURvQScDt20pdPXNumdFLzEKdVJYmQW7eoJrLEbuMZh7XDEAkTnqpnXTmFTU3q19k5rnV//gIl8+I3b9fhEUg==" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

</head>
<body style="font-family: 'Kanit', sans-serif;">
    <div id="app">
        <div class="wrapper">
            <nav id="sidebar">
                <div class="row pl-4">
                    <a href="{{ url('/') }}" class="col-12 p-3">
                        <div class="row">
                            <div class="col-2">
                                <img class="mb-1" src={{ (request()->is('/')) ? asset('img/mu_1A.png') : asset('img/mu_1.png') }} width="35" alt="mu_1A">
                            </div>
                            <div class="ml-2 col-8 pt-1">
                                <span class="{{ (request()->is('/')) ? 'text-pink' : 'text-black' }}" >Dashboard</span>
                            </div>
                        </div>
                    </a>
                    
                    <a href="{{ url('/topup') }}" class="col-12 p-3">
                        <div class="row">
                            <div class="col-2">
                                <img class="mb-1" src={{ (request()->is('topup')) ? asset('img/mu_1A.png') : asset('img/mu_1.png') }} width="35" alt="mu_1A">
                            </div>
                            <div class="ml-2 col-8 pt-1">
                                <span class="{{ (request()->is('topup')) ? 'text-pink' : 'text-black' }}" >รายการเติมเงิน</span>
                            </div>
                        </div>
                    </a>
                    
                    <a href="{{ url('/withdraw') }}" class="col-12 p-3">
                        <div class="row">
                                <div class="col-2">
                                    <img class="mb-1" src={{ (request()->is('withdraw')) ? asset('img/mu_2A.png') : asset('img/mu_2.png') }} width="35" alt="mu_2A">
                                </div>
                                <div class="ml-2 col-8 pt-1">
                                    <span class="{{ (request()->is('withdraw')) ? 'text-pink' : 'text-black' }}" >รายการถอนเงิน</span>
                                </div>
                        </div>
                    </a>
                    
                    <a href="{{ url('/report') }}" class="col-12 p-3">
                        <div class="row">
                                <div class="col-2">
                                    <img class="mb-1" src={{ (request()->is('report')) ? asset('img/mu_3A.png') : asset('img/mu_3.png') }} width="35" alt="mu_3A">
                                </div>
                                <div class="ml-2 col-8 pt-1">
                                    <span class="{{ (request()->is('report')) ? 'text-pink' : 'text-black' }}" >Report (แจ้งปัญหา)</span>
                            </div>
                        </div>
                    </a>
                    
                    <a href="{{ url('/users') }}" class="col-12 p-3">
                        <div class="row">
                            <div class="col-2">
                                <img class="mb-1" src={{ (request()->is('users')) ? asset('img/mu_4A.png') : asset('img/mu_4.png') }} width="35" alt="mu_4A">
                            </div>
                            <div class="ml-2 col-8 pt-1">
                                <span class="{{ (request()->is('users')) ? 'text-pink' : 'text-black' }}" >สมาชิกทั้งหมด</span>
                            </div>
                        </div>
                    </a>

                    <a class="col-12 p-3" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    
                </nav>   
            </div>
        </div>  
        <main class="">
            @yield('content')
        </main>
    </div>
</body>
</html>
