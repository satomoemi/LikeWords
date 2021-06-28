<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
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
        $loginUser = Auth::user(); //Authでログインしたユーザーを取得
    ?>
    <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
            appId: "8f2d0d35-3d44-4f4d-ab3b-33d3a1f6f6a7",
            });

            

            @if(isset($loginUser))//isset()変数の値が存在するか否か。あればtrue
            //onesignalにuser_idをセット
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
                                'player_id' : userId
                            },
    
                            success: function() {
                                //通信が成功した場合の処理をここに書く
                                console.log('success');
                            },
    
                            error: function() {
                                //通信が失敗した場合の処理をここに書く
                                consle.log('error');
                            }
                            
                        // //OneSignalのユーザーとアプリ側のユーザーを一致する
                        // OneSignal.setExternalUserId('{{ $loginUser->id }}');
                        // //ユーザーのブラウザにローカルに保存されている値を取得
                        // OneSignal.getExternalUserId().then(function (id) {
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
                                consle.log('error_delete');
                            }
                            // //通知を拒否されたら現在のユーザーの外部ユーザーIDとして設定されているものをすべて削除
                            // OneSignal.removeExternalUserId();
                    });
                }
                   
            });
            @endif
        });
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
                                    <a class="dropdown-item" href="{{ route('push') }}">通知設定</a> 
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
