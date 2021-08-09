<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!--InternetExplorerのブラウザではバージョンによって崩れることがあるので、互換表示をさせないため-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--スマホやタブレットのモバイル端末で最適にWeb表示させるため-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'LikeWords') }}</title>
    <link rel="icon"  href="{{ asset('4fffb3142e02bc041550c600282ad22c_ol.ico') }}">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/73ae890c2c.js" crossorigin="anonymous"></script>

    <!--赤いベルマークの実装をしている(word.phpとの関連はなし)-->
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <!-- php上で別のところで定義された変数をscriptタグの中では直接使えない。だから@phpを使ってblade上で直接定義する -->
    <?php
        $loginUser = Auth::check(); //ユーザーがログインしてるか否か してればtrue
        $appId = env('ONESINGAL_APP_ID');
        $safari_web_id = env('YOUR_SAFARI_WEB_ID');
    ?>

    <script>
        //ユーザーがログインしてればベルマーク登場
        if( {{$loginUser==null ? "false":"true"}} ) {
            console.log("login",{{$loginUser}});

            //ベルマーク表示関係
            window.OneSignal = window.OneSignal || [];
            OneSignal.push(function() { //if文の中まで
                    OneSignal.init({
                        appId: '{{ $appId }}', 
                    });
                    
                //通知を登録,解除してもonesignalのplayerid発行してuserIdに入れる
                //それを ajax非同期通信 使って指定URLに送信
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
                                            'player_id' : userId //controllerに送るデータ
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
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img src="/4fffb3142e02bc041550c600282ad22c_ol.ico" class="img-fluid pb-2" alt="">
                <a class="navbar-brand ml-2" href="{{ url('/') }}">
                   <h4>{{ config('app.name', 'LikeWords') }}</h4>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <!-- ログインしていなかったらログイン画面へのリンクを表示 -->
                        @guest
                            <li class="nav-item dropdown">
                                <a class="nav-link text-dark" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt fa-lg"></i>
                                    {{ __('messages.Login') }}
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('register') }}">
                                        <i class="far fa-address-card fa-lg"></i>
                                        {{ __('messages.Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('home') }}">
                                    <i class="fas fa-home fa-lg"></i>
                                    ホーム（Folder/Word）
                               </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('user') }}">
                                    <i class="fas fa-address-card fa-lg"></i>
                                    ユーザー情報
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('push.time') }}">
                                    <i class="far fa-clock fa-lg"></i>
                                    通知時間設定
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('unsubsc') }}">
                                    <i class="fas fa-user-slash fa-lg"></i>
                                    退会
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-lg"></i>
                                    {{ __('messages.Logout') }}
                                </a>
                            </li>
                    </ul>
                            <span class="navbar-text ml-auto text-dark">
                                {{ Auth::user()->name }}さんようこそ
                                <i class="far fa-grin-squint fa-lg"></i>
                            </span>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                                
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4 bg-dark">
            @yield('content')
        </main>
    </div>
    
    <footer>
        <div class="py-3" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="mb-0">© LikeWords 2021</p>
                    </div> 
                </div>
            </div>
        </div>
    </footer>
    </body>
</html>
