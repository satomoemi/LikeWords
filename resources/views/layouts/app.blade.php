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
    <!-- php上で別のところで定義された変数をscriptタグの中では直接使えない。だから?php?を使ってblade上で直接定義する -->
    <?php
        $loginUser = Auth::check(); //ユーザーがログインしてるか否か してればtrue
        $appId = env('ONESINGAL_APP_ID');
    ?>

    <script>
        //ユーザーがログインしてればベルマーク登場
        if( {{$loginUser==null ? "false":"true"}} ) {//最後まで
            console.log("login",{{$loginUser}});

            //ベルマーク表示関係
            window.OneSignal = window.OneSignal || [];
            OneSignal.push(function() { //if文の中まで
                    OneSignal.init({
                        appId: '{{ $appId }}', 
                    });

                //通知を登録,解除してもonesignalのplayerid発行してuserIdに入れる
                //それを ajax非同期通信 使って指定URLに送信（今回はコントローラーに）
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
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
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
                                <!--nav-link：liタグの黒点消したい時使う-->
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
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="https://github.com/satomoemi/LikeWords#readme">
                                <i class="fas fa-book-open fa-lg"></i>
                                使い方詳しく
                               </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('home') }}">
                                    <i class="fas fa-home fa-lg"></i>
                                    ホーム
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
                                <a class="nav-link text-dark" href="https://github.com/satomoemi/LikeWords#readme">
                                    <i class="fas fa-book-open fa-lg"></i>
                                    使い方詳しく
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
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>        
                    </ul>
                            <span class="navbar-text ml-auto text-dark">
                                {{ Auth::user()->name }}さんようこそ
                                <i class="far fa-grin-squint fa-lg"></i>
                            </span>

                        @endguest
                    </div>
                </div>
            </div>
        </nav>

         
        <!-- ユーザー編集で使われるフラッシュメッセージ -->
        @if (session('flash_message'))
            <div class="flash_message alert-success text-center py-3 my-0">
                {{ session('flash_message') }}
            </div>
        @endif


        <main class="py-4 bg-dark">
            @yield('content')
        </main>
    </div>
    
    <footer>
        <div class="py-3" >
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <p>© LikeWords 2021</p>
                    </div> 
                    <div class="col-md-12">
                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#Rule">利用規約</button>
                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#Privacy">プライバシー</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </body>
</html>

<!--利用規約・プライバシーModal-->
<div class="modal fade" id="Rule" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <!-- modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ-->
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content bg-dark">
          <div class="modal-header">
              <h4 class="modal-title text-white" id="myModalLabel">LikeWords 利用規約</h4>
          </div>
          <div class="modal-body text-white">
            <p>本利用規約（以下、「本規約」と言います。）には、本サービスの提供条件及び製作者と登録ユーザーの皆様との間の権利義務関係が定められています。本サービスの利用に関しては、本規約の全文をお読み頂いた上で、本規約に同意していただく必要があります。</p>

            <p>第１条（適用）</p>
                <ol>
                    <li>本規約は、本サービスの提供条件及び本サービスの利用に関する製作者と登録ユーザーの間の権利義務関係を定めることを目的とし、登録ユーザーと製作者との間の本サービスの利用に関わる一切の関係に適用されます。</li>
                </ol>

             <p>第２条（定義）</p>
                <ol>
                    <li>「サービス利用契約」とは、本規約を契約条件としてと登録ユーザーの間で締結される、本サービスの利用契約を意味します。</li>
                    <li>「投稿データ」とは、登録ユーザーが本サービスを利用して投稿その他送信するコンテンツ（文章、画像、その他のデータを含みますがこれに限りません。）を意味します。</li>
                    <li>「当ウェブサイト」とは、そのドメインが「https://like-words/」である、製作者が運営するウェブサイト（理由の如何を問わず、このドメインまたは内容が変更された場合は、該当変更後のウェブサイトを含みます。）を意味します。</li>
                    <li>「知的財産権」とは、著作権、特許権、実用新案権、意匠権、商標権その他の知的財産権（それらの権利を取得し、またはそれらの権利につき登録等を出願する権利を含みます。）を意味します。</li>
                    <li>「登録ユーザー」とは、第３条（本サービスについて）に基づいて本サービスの利用者としての登録がなされた個人を意味します。</li>
                    <li>「本サービス」とは、製作者が提供する「LikeWords」という名称のサービス（理由の如何を問わず、サービスの名称または内容が変更された場合は、該当変更後のサービスを含みます。）を意味します。</li>
                </ol>

            <p>第３条（本サービスについて）</p>
                <ol>
                    <li>本サービスの登録を希望する者は、本規約を遵守することに同意し、かつ製作者の定める一定の情報（以下、「登録事項」と言います。）を製作者の定める方法で提供することにより、本サービスの利用の登録をすることが出来ます。</li>
                    <li>前項に定める登録の完了時に、サービス利用契約が登録ユーザーとの間に成立し、登録ユーザーは本サービスを本規約に従い利用することが出来るようになります。</li>
                    <li>本サービスは、インターネットを通じて提供されます。本サービスの利用にあたり、利用者に発生する機器の取得・維持費、接続料、その他通信等により発生する一切の費用は利用者が負担するものとします。</li>
                </ol>

            <p>第４条（パスワード及び登録したメールアドレスの管理）</p>
                <ol>
                    <li>登録ユーザーは、自己の責任において、本サービスに関するパスワード及び登録したメールアドレスを適切に管理・及び保管するものとします。</li>
                    <li>パスワードまたは登録したメールアドレスの管理不十分、使用上の過誤、第三者の使用等によって生じた損害に関する責任は登録ユーザーが追うものとします。</li>
                </ol>

            <p>第５条（禁止事項）</p>
                <ol>
                    <p>登録ユーザーは、本サービスの利用にあたり、以下の各号のいずれかに該当する行為または該当すると製作者が判断する行為をしてはなりません。</p>
                    
                    <li>法令に違反する行為または犯罪行為に関連する行為</li>
                    <li>製作者、本サービスの他の利用者またはその他の第三者に対する詐欺行為または強迫行為</li>
                    <li>製作者、本サービスの利用者またはその他の第三者の知的財産権、肖像権、プライバシーの権利、名誉、その他の権利または利益を侵害する行為</li>
                    <li>公序良俗に反する行為</li>
                    <li>本サービスを通じ、以下に該当し、または該当すると製作者が判断する情報を製作者に送信または本サービスに投稿すること</li>
                    <ul>
                        <li>過度に暴力的または残虐な表現を含む情報</li>
                        <li>コンピューター・ウィルスその他の有害なコンピューター・プログラムを含む情報</li>
                        <li>製作者、本サービスの他の利用者またはその他の第三者の名誉または信用を毀損する表現を含む情報</li>
                        <li>過度に猥褻な表現を含む情報</li>
                        <li>差別を助長する表現を含む情報</li>
                        <li>自殺・自傷行為を助長する表現を含む情報</li>
                        <li>薬物の不適切な利用を助長する表現を含む情報</li>
                    </ul>
                    <li>本サービスのネットワークまたはシステム等に過度な負荷をかける行為</li>
                    <li>製作者が提供するソフトウェアその他のシステムに対するリバースエンジニアリングその他の解析行為</li>
                    <li>本サービスの運営を妨害する恐れのある行為</li>
                    <li>製作者のネットワークまたはシステム等への不正アクセス</li>
                    <li>本サービスの他の利用者のパスワードまたは登録したメールアドレスを利用する行為</li>
                    <li>本サービスの他の利用者の情報の収集</li>
                    <li>製作者、本サービスの他の利用者またはその他の第三者に不利益・損害・不快感を与える行為</li>
                    <li>反社会的勢力等への利益供与</li>
                    <li>前各号の行為を直接または関節に惹起し、または容易にする行為</li>
                    <li>前各号の行為を試みること</li>
                    <li>その他、製作者が不適切と判断する行為</li>
                </ol>

            <p>第６条（本サービスの停止等）</p>
                <ol>
                    <li>製作者は、以下のいずれかに該当する場合には、登録ユーザーに事前に通告することなく本サービスの全部・または一部の提供を停止または中断出来るものとします。</li>
                    <ul>
                        <li>本サービスに係るコンピューター・システムの点検または保守作業を緊急に行う場合</li>
                        <li>コンピューター、通信回線等の障害、誤操作、過度なアクセスの集中、不正アクセス、ハッキング等により本サービスの運営が出来なくなった場合</li>
                        <li>地震、落雷、火災、風水害、停電、天災地変などの不可抗力により本サービスの運営が出来なくなった場合</li>
                        <li>製作者の傷病、死亡などにより本サービスの運営が出来なくなった場合</li>
                        <li>その他、製作者が停止、または中断を必要と判断した場合</li>
                    </ul>
                </ol>

            <p>第７条（権利帰属）</p>
                <ol>
                    <li>当ウェブサイト及び本サービスに関する知的財産権は全て製作者に帰属しており、本規約に基づく本サービスの利用許諾は、当ウェブサイトまたは本サービスに関する製作者の知的財産権の使用許諾を意味するものではありません。</li>
                    <li>登録ユーザーは、投稿データについて、自らがその投稿その他送信することについての適切な権利を有していること、及び投稿データが第三者の権利を侵害していないことについて、製作者に対し表明し、保証するものとします。</li>
                </ol>

            <p>第８条（登録抹消等）</p>
                <ol>
                    <li>製作者は、登録ユーザーが、以下の各号のいずれかの事由に該当する場合は、事前に通知または催告することなく、投稿データを削除もしくは非表示にし、該当登録ユーザーについて本サービスの利用を一時的に停止し、 または登録ユーザーとしての登録を抹消することができます</li>
                    <ul>
                        <li>本規約のいずれかの条項に違反した場合</li>
                        <li>６ヶ月以上本サービスの利用がない場合</li>
                        <li>製作者からの問い合わせその他回答を求める連絡に対して30日間以上応答がない場合</li>
                        <li>その他、製作者が本サービスの利用または登録ユーザーとしての登録の継続を適当でないと判断した場合</li>
                    </ul>
                </ol>

            <p>第９条（退会）</p>
                <ol>
                    <li>登録ユーザーは、製作者の定める手続きの完了により、本サービスから退会し、自己の登録ユーザーとしての登録を抹消することが出来ます。</li>
                    <li>退会後の利用者情報の取り扱いについては、第１３条の規定に従うものとします。</li>
                </ol>

            <p>第１０条（本サービスの内容の変更、終了）</p>
                <ol>
                    <li>製作者は、自身の都合により、本サービスの内容を変更し、または提供を終了することが出来ます。</li>
                    <li>製作者が本サービスの提供を終了する場合、製作者は登録ユーザーに事前に告知するものとします。</li>
                </ol>

            <p>第１１条（保証の否認及び免責）</p>
                <ol>
                    <li>製作者は、本サービスが登録ユーザーの特定の目的に適合すること、期待する機能・商品的価値・正確性・有用性を有すること、 登録ユーザーによる本サービスの利用が登録ユーザーに適用のある法令または業界団体の内部規則等に適合すること、継続的に利用出来ること、及び不具合が生じないことについて、 明示または黙字を問わず何ら保証するものではありません。</li>
                    <li>製作者は、本サービスに関して登録ユーザーが被った被害につき、賠償する責任を負わないものとし、また、付随的損害、間接損害、特別損害、将来の損害及び逸失利益にかかる損害についても、賠償する責任を負わないものとします。</li>
                    <li>本サービスまたは当ウェブサイトに関連して登録ユーザーと他の登録ユーザーまたは第三者との間において生じた紛争等については、登録ユーザーが自己の責任において解決するものとします。</li>
                </ol>

            <p>第１２条（秘密保持）</p>
                <ol>
                    <li>登録ユーザーは、本サービスに関連して製作者が登録ユーザーに対して秘密に取り扱うことを求めて開示した非公知の情報について、製作者の事前の書面による承諾がある場合を除き、秘密に取り扱うものとします。</li>
                </ol>

            <p>第１３条（利用者情報の取り扱い）</p>
                <ol>
                    <li>製作者による登録ユーザーの利用者情報の取り扱いについては、別途プライバシーポリシーの定めによるものとし、登録ユーザーはこのプライバシーポリシーに従って製作者が登録ユーザーの利用者情報を取り扱うことについて同意するものとします。</li>
                </ol>

            <p>第１4条（本規約等の変更）</p>
                <ol>
                    <li>製作者は、必要と認めた場合には、本規約を変更出来るものとします。本規約を変更する場合、変更後の本規約の施行時期及び内容を当ウェブサイト上で掲示その他適切な方法により周知し、または登録ユーザーに通知します。</li>
                </ol>

            <p>第１５条（連絡、通知）</p>
                <ol>
                    <li>本サービスに関する問い合わせその他登録ユーザーから製作者に対する連絡または通知、及び製作者から登録ユーザーに対する連絡または通知は、製作者の定める方法で行うものとします。</li>
                    <li>製作者が登録事項に含まれるメールアドレスに連絡または通知を行なった場合、登録ユーザーは該当連絡または通知を受領したものとみなします。</li>
                </ol>

            <p>第１６条（サービス利用契約上の地位の譲渡等）</p>
                <ol>
                    <li>登録ユーザーは、製作者の事前の承諾なく、利用契約上の地位または本規約に基づく権利もしくは義務につき、第三者に対し、譲渡、移転、その他の処分をすることは出来ません。</li>
                    <li>製作者は本サービスの運営を他者に譲渡した場合には、それ伴い利用契約上の地位、本規約に基づく権利及び義務並びに登録ユーザーの登録事項を譲受人に譲渡することが出来るものとし、登録ユーザーは、かかる譲渡につき本項においてあらかじめ同意したものとします。 なお、本項に定める運営譲渡には、通常の運営譲渡のみならず、あらゆる場合を含むものとします。</li>
                </ol>

            <p> 第１７条（分離可能性）</p>
                <ol>
                    <li>本規約のいずれかの条項またはその一部が、法令等によ無効または執行不能と判断された場合であっても、本規約の残りの規定及び一部が無効または執行不能と判断された規定の残りの部分は、継続して完全に効力を有するものとします。</li>
                </ol>

            <p>第１８条（準拠法及び管轄裁判所）</p>
                <ol>
                    <li>本規約及びサービス利用契約の準拠法は日本法とします</li>
                    <li>本規約またはサービス利用契約に起因し、または関連する一切の紛争については、東京地方裁判所を第一審の専属的合意管轄裁判所とします。</li>
                </ol>
            <p>【2021年8月11日制定】</p>
          </div>
          <div class="modal-footer">
              <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="Privacy" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <!-- modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ-->
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content bg-dark">
          <div class="modal-header">
              <h4 class="modal-title text-white" id="myModalLabel">LikeWordsプライバシーポリシー</h4>
          </div>
          <div class="modal-body text-white">
            <p>製作者は、提供するサービス（以下「本サービス」といいます。）における、ユーザーについての個人情報を含む利用者情報の取扱いについて、以下のとおりプライバシーポリシー（以下「本ポリシー」といいます。）を定めます。</p>

            <ol>
                <li>収集する利用者情報及び収集方法</li>
                    <ul>
                        本ポリシーにおいて、「利用者情報」とは、ユーザーの識別に係る情報、通信サービス上の行動履歴、その他ユーザーまたはユーザーの端末に関連して生成または蓄積された情報であって、本ポリシーに基づき製作者が収集するものを意味するものとします。本サービスにおいて製作者が収集する利用者情報は、 その収集方法に応じて、以下のようなものとなります。
                    </ul>
                        <ol>
                            <li>ユーザーからご提供いただく情報</li>
                            <ul>
                                <p>本サービスを利用するために、または本サービスの利用を通じてユーザーからご提供いただく情報は以下のとおりです</p>
                                
                                <li>名前及びニックネーム、生年月日、メールアドレス、パスワード等ユーザー登録時にご入力頂く情報</li>
                                <li>ユーザーの肖像写真を含む入力フォームを通じてユーザーが入力または送信する情報</li>
                            </ul>
                                <li>ユーザーが本サービスを利用するにあたって、製作者が収集する情報</li>
                                <p>製作者は、本サービスへのアクセス状況やそのご利用方法に関する情報を収集することがあります。これには以下の情報が含まれます。</p>
                            <ul>
                                <li>リファラ</li>
                                <li>IPアドレス</li>
                                <li>サーバーアクセスログに関する情報</li>
                                <li>Cookie、ADID、IDFAその他の識別子</li>
                            </ul>
                        </ol>    
                <li>利用目的</li>
                    <ul>
                        本サービスのサービス提供にかかわる利用者情報の具体的な利用目的は以下のとおりです。
                        
                        <li>本サービスに関する登録の受付、ユーザー認証、ユーザー設定の記録、本サービスの提供、維持、保護及び改善のため</li>
                        <li>ユーザーのトラフィック測定及び行動測定のため</li>
                        <li>広告の配信、表示及び効果測定のため</li>
                        <li>本サービスに関するご案内、お問い合わせ等への対応のため</li>
                        <li>本サービスに関する製作者の規約、ポリシー等（以下「規約等」といいます。）に違反する行為に対する対応のため</li>
                        <li>本サービスに関する規約等の変更などを通知するため</li>
                    </ul>

                <li>利用中止要請の方法</li>
                    <ul>
                        ユーザーが所定の方法により本サービスを退会した場合、利用者情報の収集又は利用を停止します。
                    </ul>
                
                <li>外部送信、第三者提供、情報収集モジュールの有無</li>
                    <ul>
                        本サービスにはOne Signalが組み込まれています。これに伴い、One Signal提供者への利用者情報の提供を行います。</br>
                    
                        上記提供者のプライバシーポリシーは
                        <a href="https://onesignal.com/privacy_policy">こちら</a>
                        の通りです。
                    </ul>
                
                <li>第三者提供</li>
                    <ul>
                        製作者は、利用者情報のうち、個人情報については、あらかじめユーザーの同意を得ないで、第三者（日本国外にある者を含みます。）に提供しません。但し、次に掲げる必要があり第三者（日本国外にある者を含みます。）に提供する場合はこの限りではありません。
                        
                        <li>製作者が利用目的の達成に必要な範囲内において個人情報の取扱いの全部または一部を委託する場合</li>
                        <li>譲渡、その他の事由による運営の承継に伴って個人情報が提供される場合</li>
                        <li>国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって、ユーザーの同意を得ることによって当該事務の遂行に支障を及ぼすおそれがある場合</li>
                        <li>その他、個人情報の保護に関する法律（以下「個人情報保護法」といいます。）その他の法令で認められる場合</li>
                    </ul>

                <li>個人情報の訂正及び利用停止等</li>
                    <ul>
                        <li>6-1. 製作者は、ユーザーから、(1)個人情報が真実でないという理由によって個人情報保護法の定めに基づきその内容の訂正を求められた場合、及び(2)あらかじめ公表された利用目的の範囲を超えて取扱われているという理由または偽りその他不正の手段により収集されたものであるという理由により、 個人情報保護法の定めに基づきその利用の停止を求められた場合には、ユーザーご本人からのご請求であることを確認の上で遅滞なく必要な調査を行い、その結果に基づき、個人情報の内容の訂正または利用停止を行い、その旨をユーザーに通知します。なお、訂正または利用停止を行わない旨の決定をしたときは、 ユーザーに対しその旨を通知いたします。</li>
                        
                        <li>6-2. 製作者は、ユーザーから、ユーザーの個人情報について消去を求められた場合、製作者が当該請求に応じる必要があると判断した場合は、ユーザーご本人からのご請求であることを確認の上で、個人情報の消去を行い、その旨をユーザーに通知します。</li>
                        
                        <li>6-3. 個人情報保護法その他の法令により、製作者が訂正等または利用停止等の義務を負わない場合は、6-1および6-2の規定は適用されません。</li>
                    </ul>
                
                <li>お問い合わせ窓口</li>
                    <ul>
                        ご意見、ご質問、その他利用者情報の取扱いに関するお問い合わせは、現在準備中です。
                    </ul>
                
                <li>プライバシーポリシーの変更手続</li>
                    <ul>
                        製作者は必要に応じて本ポリシーを変更します。但し、法令上ユーザーの同意が必要となるような本ポリシーの変更を行う場合、変更後の本ポリシーは、製作者所定の方法で変更に同意したユーザーに対してのみ適用されるものとします。なお、製作者は、本ポリシーを変更する場合には、 変更後の本ポリシーの施行時期及び内容を当ウェブサイト上での表示その他の適切な方法により周知し、またはユーザーに通知します。
                    </ul>
            </ol>
            
            <p>【2021年8月11日制定】</p>
          </div>
          <div class="modal-footer">
              <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
          </div>
      </div>
  </div>
</div>
