<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Store Management</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,700&display=swap');
            body {
                font-family: 'Roboto', sans-serif;
            }
            .background{
                height: 850px;
                position: relative;
                overflow: hidden;
                z-index: 0;
                background: linear-gradient(45deg, #553be6 0%, #a87ffa 100%);
            }
            .background:before{
                position: absolute;
                bottom: -90px;
                left: 0;
                width: 40%;
                height: 180px;
                content: '';
                background: #000000;
                z-index: -1;
                opacity: .05;
                border-radius: 0 50% 50% 0;
            }
            .background:after{
                position: absolute;
                top: -150px;
                left: -200px;
                width: 550px;
                height: 550px;
                border-radius: 50%;
                content: '';
                background: #fff;
                z-index: -1;
                opacity: .05;
            }
            .background img{
                height: 100%;
                margin-top: 100px;
            }
            .background h1{
                font-weight: 700;
                color: #fff;
                font-size: 60px;
                line-height: 1.2;
                margin-top: 200px;
            }
            .background p{
                color: #f6f6f6;
            }
            .link{
                margin-top: 40px;
            }
            .button{
                padding: 20px 30px;
                border-radius: 40px 40px 40px 0;
                color: #fff;
                transition: .5s;
            }
            .button:hover{
                padding: 20px 30px;
                border-radius: 0 40px 40px 40px;
                color: #fff;
                transition: .5s;
            }
            .user-btn{
                background: #1FB6FC;
                margin-right: 10px;
            }
            .admin-btn{
                background: #BC6FF1;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="background" >
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Make Your Business More Profitable</h1>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                        @if (Route::has('login'))
                            <div class="link">
                                @auth
                                    <a class="button user-btn" href="{{ url('/dashboard') }}">Dashboard</a>
                                @else
                                    <a class="button user-btn" href="{{ route('login') }}">User Login</a>
                                    <a class="button admin-btn" href="{{ route('admin.login') }}">Admin Login</a>
                                @endauth

                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('backend/img/bg_1.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hover:bg-white hover:text-blue-500 border-2 border-blue-500 bg-blue-500 p-2 text-sm text-white mr-2 dark:text-gray-500">User Login</a>
                        <a href="{{ route('admin.login') }}" class="hover:bg-white hover:text-blue-500 border-2 border-blue-500 bg-blue-500 p-2 text-sm text-white">Admin Login</a>

                        @if (Route::has('admin.register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div> --}}

        <script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
