@extends('layouts.app')

@section('content')
<div class="py-5 text-center">
  <div class="container">
      <div class="form-group row">
        <div class="mx-auto col-md-8">
        <form method="POST" action="{{ route('unsubsc') }}">
          @csrf
          <h3 contenteditable="true" class="">退会理由のご入力お願いします</h3>
          <textarea name="memo" class="form-control" value="{{old('reason')}}"></textarea>
            @error('reason')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
      </div>
      <p class="text-danger lead"> ＊退会すると今まで登録したものが全て削除され、復元できません。それでも退会しますか？ </p>
      <div class="form-group">
        <div class="col-md-8 mx-auto">
          <input type="submit" class="btn btn-primary" value="更新"> 
        </div>
      </div>
    </form>
  </div>
</div>
@endsection