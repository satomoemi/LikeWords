@extends('layouts.app')

@section('content')
<div class="py-5 bg-dark">
  <div class="container">
    <div class="row">
        <div class="col-md-6 d-flex flex-column justify-content-center">
            <h4 class="display-4 text-white border-white border-bottom">好きなWordを!<br></h4>
            <p class="py-4 lead text-white">記録したい「単語」「定型文」「メモ」を登録でき、毎日ランダムに好きな時間に通知してくれる語学学習アプリです。<br>あなただけのWord帳になるようにご登録よろしくお願いします！<br></p>
            <h3 class="text-white">毎日の継続で語学力をUP!を目指しましょう</h3>
        </div>
        <div class="col-md-6">
            <div class="card bg-dark border-light">
                <div class="card-header bg-white text-dark">{{ __('messages.Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right text-white">{{ __('messages.E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right text-white">{{ __('messages.Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-white" for="remember">
                                        {{ __('messages.Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-outline-light">
                                    {{ __('messages.Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('messages.Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-md-7 col-7  pl-0 col-form-label text-md-right text-white">アカウント登録がまだの方は</label>
                                <a class="btn btn-outline-light" href="{{ route('register') }}">
                                    {{ __('messages.Register') }}
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--使い方-->
<div class="py-5 bg-dark"><!--pyは上下のpadding調整-->
    <div class="container">
        <div class="row col-md-12 justify-content-center">
            <h1 class="display-4 text-white border-white border-bottom">使い方</h1>

            <div class="row col-md-12 py-5 justify-content-center">
                <!--style=：デザイン微調整によく利用される-->
                <i class="far fa-address-card fa-8x" style="color: white;"></i>
                <label class="col-md-7 col-form-label text-md-right text-white">
                    <h3>あなたのオリジナルのWord帳にするため<br>「新規会員登録」から登録します<br>登録が終わったらログインへ！</h3>
                </label>
            </div>

            
            <div class="row col-md-12 py-5 justify-content-center">
                <i class="fas fa-folder fa-8x" style="color: white;"></i>
                <label class="col-md-7 col-form-label text-md-right text-white">
                    <h3>「新規フォルダ作成」からフォルダを作成します<br>例：「英語」「中国語」</h3>
                </label>
            </div>
            
            
            <div class="row col-md-12 py-5 justify-content-center">
                <i class="fas fa-pencil-alt fa-8x" style="color: white;"></i>
                <label class="col-md-7 col-form-label text-md-right text-white">
                    <h3>フォルダ名をクリックするとWord一覧がみれます<br>「Word作成」から単語or文・メモが登録できます</h3>
                </label>
            </div>
            
            <div class="row col-md-12 py-5 justify-content-center">
                <i class="fas fa-search fa-8x" style="color: white;"></i>
                <label class="col-md-7 col-form-label text-md-right text-white">
                    <h3>登録したWordの部分検索ができます</h3>
                </label>
            </div>
            
            <div class="row col-md-12 py-5 justify-content-center">
                <i class="far fa-bell fa-8x" style="color: white;"></i>
                <label class="col-md-7 col-form-label text-md-right text-white">
                    <h3>右下のベルマークで通知ON/OFFの設定ができます<br>初めてベルマーク押すとブラウザから通知許可表示が出ます</h3>
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#PushDetailModal">通知について詳しくこちら</button>
                </label>
            </div>
            
            <div class="row col-md-12 py-5 justify-content-center">
                <i class="far fa-clock fa-8x" style="color: white;"></i>
                <label class="col-md-7 col-form-label text-md-right text-white">
                    <h3>通知時間の設定ができます</br>「毎日・ランダム」は設定済で、変更はできません<br>通知OFFの場合は時間の設定ができません</h3>
                </label>
            </div>

        </div>
    </div>
</div>

<!--通知についてのModal-->
<div class="modal fade" id="PushDetailModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <!-- modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ-->
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h4 class="modal-title text-white" id="myModalLabel">WebPush通知について</h4>
                </div>
                <div class="modal-body text-white">
                    <ul>
                        <li>LikeWords以外のWebサイトを表示していても通知が届きます。</li>
                        <li>現時点（2021/8/10）PCからのブラウザ「GoogleChrome」のみ対応しています。</li>
                        <li>受信設定はアカウントではなくブラウザに保存されます。</li>
                        <li class="text-danger">複数のユーザーを作成し、全てに通知しようとするとベルマーク表示の不具合が生じてしまいます。そのため、一人につき一人のユーザーに対して通知するようにお願い致します。</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
                </div>
            </div>
        </div>
    </div>
@endsection
