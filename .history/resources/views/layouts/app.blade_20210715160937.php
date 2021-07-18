<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!--スマホやタブレットのモバイル端末で最適にWeb表示させるため-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--赤いベルマークの実装をしている(word.phpとの関連はなし)-->
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <!-- php上で別のところで定義された変数をscriptタグの中では直接使えない。だから@phpを使ってblade上で直接定義する -->
    <?php
        $loginUser = Auth::check(); //ユーザーがログインしてるか否か してればtrue
        $appId = env('ONESINGAL_APP_ID');
        $safari_web_id = env('YOUR_SAFARI_WEB_ID');
    ?>

    <script>
        //ユーザーがログインしてればベルマーク登場＆通知登録したら
        if( {{$loginUser==null ? "false":"true"}} ) {
            console.log("login",{{$loginUser}});

            //ベルマーク表示不表示関係
            window.OneSignal = window.OneSignal || [];
            OneSignal.push(function() { //if文の中まで
                OneSignal.init({
                    appId: '{{ $appId }}', 
                    safari_web_id: '{{ $safari_web_id }}',
                });

                //通知を登録,解除してもonesignalのplayerid発行してuserIdに入れる
                //それをajax使って指定
                OneSignal.on('subscriptionChange', function (isSubscribed) {
                    if (isSubscribed == true) {
                        OneSignal.getUserId(function(userId) {
                            console.log("OneSignal User ID:", userId);
                            // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316   
                            
                            $.ajax({
                                headers: {
                                    // csrf対策
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                
                                
                                url: '/push/subsc', // アクセスするURL
                                type: 'POST', // POSTかGETか
                                data: { 
                                    'player_id' : userId //controllerに送るデータ
                                },
                                
                                success: function() {
                                    //通信が成功した場合の処理をここに書く
                                    console.log('success');
                            },
                            
                            error: function() {
                                //通信が失敗した場合の処理をここに書く
                                console.log('error');
                            }
                            
                            
                        });
                    });
                } else if (isSubscribed == false) {
                    OneSignal.getUserId(function(userId) {
                        console.log("OneSignal User ID:", userId);
                        // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316    
                        
                        $.ajax({
                            headers: {
                                // csrf対策
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            
                            
                            url: '/push/delete', // アクセスするURL
                            type: 'GET', // POSTかGETか
                            data: { 
                                'player_id' : userId
                            },
                            
                            success: function() {
                                //通信が成功した場合の処理をここに書く
                                console.log('success_delete');
                            },
                            
                            error: function() {
                                //通信が失敗した場合の処理をここに書く
                                console.log('error_delete');
                            }
                        });
                    });
                }
                
                });
            });
        }
        
    </script>
        
        <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('messages.Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user') }}">ユーザー情報</a> 
                                    <a class="dropdown-item" href="{{ route('push.time') }}">通知時間設定</a> 
                                    <a class="dropdown-item" href="{{ route('unsubsc') }}">退会</a> 
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('messages.Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
    <footer>
        <div class="py-3" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="mb-0">© 2021 Sato Moemi</p>
                    </div> 
                </div>
            </div>
        </div>
    </footer>
</body>
</html>