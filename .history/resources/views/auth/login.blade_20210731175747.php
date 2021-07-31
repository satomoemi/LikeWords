@extends('layouts.app')

@section('content')
<div class="py-5 bg-dark">
  <div class="container">
    <div class="row">
        <div class="col-md-6 d-flex flex-column justify-content-center">
        <h4 class="display-4 text-white border-white border-bottom">好きなWordを!<br></h4>
            <p class="mb-4 lead text-white">記録したい「単語」「定型文」「メモ」を登録でき、毎日ランダムに好きな時間に通知してくれる語学学習アプリです。<br>あなただけのWord帳になるようにご登録よろしくお願いします！<br></p>
                <h4 contenteditable="true" class="text-white">毎日の継続で語学力をアップを目指しましょう！</h4>
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
                                <label class="col-md-7 col-form-label text-md-right text-white">アカウント登録がまだの方は</label>
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
            <h1 class="text-white border-white border-bottom">使い方</h1>

            <div class="row col-md-12 py-5 justify-content-center">
                <img src="/storage/登録のピクトアイコン2.jpeg" class="img-fluid" alt="">
                <label class="col-md-7 col-form-label text-md-right text-white">
                    <h3>あなたのオリジナルのWord帳にするため<br>「新規会員登録」から登録します</h3>
                </label>
            </div>

            <div class="row col-md-12 py-5 justify-content-center">
                <img src="/storage/線画のフォルダアイコン.jpeg" class="img-fluid" alt="">
                <label class="col-md-7 col-form-label text-md-right text-white">
                    <h3>まず「新規フォルダ作成」から<br></h3>
                </label>
            </div>
        </div>
    </div>
</div>
@endsection
