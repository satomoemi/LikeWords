@extends('layouts.app')
@section('content')
<body>





@if (session('status'))
    {{ session('status') }}
@endif
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>ユーザー情報・設定</h3></div>
                    <div class="card-body">

                        <form method="POST" action="/user/edit/email">
                        @csrf  
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">email変更</label>
                                <div class="col-md-6">
                                    <input id="email" name="Email" value="{{$auth["email"]}}" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input type="hidden" name="UserId" value={{$auth["id"]}}>
                                <button dusk="view-button" class="btn btn-primary">更新</button>
                            </div>

                        </form>

                        <form method="POST" action="/user/edit/password">
                        @csrf
                            <div class="form-group row">
                                <label for="password"  class="col-md-4 col-form-label text-md-right">現在のパスワードを入力</label>
                                <div class="col-md-6">
                                    <input  type="password"　id="password"  name="CurrentPassword" class="form-control @error('CurrentPassword') is-invalid @enderror">
                                    @error('CurrentPassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">新規パスワードを入力</label>
                                <div class="col-md-6">
                                    <input　 type="password" id="password" name="newPassword" class="form-control @error('password') is-invalid @enderror" name="newPassword">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">新規パスワードを再入力</label>
                                <div class="col-md-6">
                                    <input  type="password" id="password" name="newPassword_confirmation" class="form-control @error('newPassword') is-invalid @enderror" name="newPassword">
                                    @error('newPassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input type="hidden" name="UserId" value={{$auth["id"]}}>
                                <button dusk="view-button" class="btn btn-primary">更新</button>


                            </div>
                        </form>
                        <form method="GET" action="{{route('user.edit.delete')}}">
                            <br>
                            <button type="submit" class="btn btn-primary"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
@endsection
