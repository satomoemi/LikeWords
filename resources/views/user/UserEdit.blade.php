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
                    <div class="card-header bg-white"><h3>ユーザー情報・設定</h3></div>
                    <div class="card-body bg-dark">

                        <form method="POST" action="{{ route('edit.name') }}">
                        @csrf  
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right text-white">ユーザー名変更</label>
                                <div class="col-md-6 col-9">
                                    <input id="name" name="name" value="{{ $user_edit->name }}" class="form-control @error('name') is-invalid @enderror">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <input type="hidden" name="UserId" value="{{ $user_edit->id }}"><!--画面には表示しなくていいけど送りたい値があるとき-->
                                <button dusk="view-button" class="btn btn-outline-light">更新</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('edit.email') }}">
                        @csrf  
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right text-white">メール変更</label>
                                <div class="col-md-6 col-9">
                                    <input id="email" name="email" value="{{ $user_edit->email }}" class="form-control @error('email') is-invalid @enderror">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                </div>
                                <input type="hidden" name="UserId" value={{$user_edit["id"]}}>
                                <button dusk="view-button" class="btn btn-outline-light">更新</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('edit.birthday') }}">
                        @csrf  
                            <div class="form-group row">
                                <label for="birthday" class="col-md-4 col-form-label text-md-right text-white">生年月日変更</label>
                                <div class="col-md-6 col-9">
                                    <input id="birthday" type="date" name="birthday" value="{{$user_edit["birthday"]}}" class="form-control @error('birthday') is-invalid @enderror">

                                    @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <input type="hidden" name="UserId" value={{$user_edit["id"]}}>
                                <button dusk="view-button" class="btn btn-outline-light">更新</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('edit.gender') }}">
                        @csrf  
                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right text-white">性別変更</label>
                                <div class="col-md-6 col-9">
                                    <input  id="gender" type="radio" name="gender" class="btn-check @error('gender') is-invalid @enderror"  value="男" {{ $user_edit["gender"] =='男'? "checked" : "" }} > 
                                    <label class="text-white">男</label>

                                    <input id="gender1" type="radio" name="gender" class="btn-check  @error('gender') is-invalid @enderror" value="女" {{ $user_edit["gender"] =='女'? "checked" : "" }} > 
                                    <label class="text-white">女</label>

                                    <input id="gender2" type="radio" name="gender" class="btn-check @error('gender') is-invalid @enderror"  value="答えたくない" {{ $user_edit["gender"] == '答えたくない'? "checked" : "" }}>
                                    <label class="text-white">答えたくない</label>


                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <input type="hidden" name="UserId" value={{$user_edit["id"]}}>
                                <button dusk="view-button" class="btn btn-outline-light">更新</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('edit.password') }}">
                        @csrf
                            <div class="form-group row">
                                <label for="password"  class="col-md-4 col-form-label text-md-right text-white">現在のパスワードを入力</label>
                                <div class="col-md-6 col-9">
                                    <input  type="password" id="password"  name="CurrentPassword" class="form-control @error('CurrentPassword') is-invalid @enderror">

                                    @error('CurrentPassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right text-white">新規パスワードを入力</label>
                                <div class="col-md-6 col-9">
                                    <input type="password" id="password" name="NewPassword" class="form-control @error('NewPassword') is-invalid @enderror" name="newPassword">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right text-white">新規パスワードを再入力</label>
                                <div class="col-md-6 col-9">
                                    <input  type="password" id="password" name="NewPassword_confirmation" class="form-control @error('re-NewPassword') is-invalid @enderror" name="newPassword">

                                    @error('newPassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <input type="hidden" name="UserId" value={{$user_edit["id"]}}>
                                <button dusk="view-button" class="btn btn-outline-light">更新</button>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
@endsection
