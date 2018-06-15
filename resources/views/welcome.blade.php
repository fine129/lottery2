<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>探索命运 - 问天</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/croppic.js') }}" defer></script>
        <script src="{{ asset('js/my.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/croppic.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            div.content {

                text-align: center ;

            }

            .title {
                font-size: 134px;
                letter-spacing: 1.3rem;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

    </head>
    <body>
        <div id="" class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">内容页</a>
                    @else
                        <a href="{{ route('login') }}">登录</a>
                        <a href="{{ route('register') }}">注册</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    问天
                </div>
                <div class="titledesc">
                    专门研究彩票和命运，在这里你能收获方法和成就
                </div>

            </div>



        </div>

            <div class=" " id="app">
                <div class="row  firstrow">
                    <div class="col-md-8">
                        <div class="usename"> 研究彩票选号和中奖秘密</div>
                    </div>
                    <div class="col-md-4">
                       <a class="imlink"> 链接外部</a>
                    </div>
                </div>
                <div class="row secondrow">

                        <div class="col-md-8">
                            <div class="usename"  >探索神秘</div>
                        </div>
                        <div class="col-md-4">
                            <a class="imlink">链接外部 </a>
                        </div>

                </div>
            </div>


        <script>


        </script>

    </body>
</html>
