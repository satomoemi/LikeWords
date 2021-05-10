@extends('layouts.app')

@section('content')
<div class="py-5 text-center">
  <div class="container">
      <div class="row">
        <div class="mx-auto col-md-8">
          <h3 contenteditable="true" class="">退会理由のご入力お願いします</h3>
          <textarea name="memo" class="form-control" value=></textarea>
        </div>
      </div>
      <p class="text-danger lead"> ＊退会すると今まで登録したものが全て削除され、復元できません。それでも退会しますか？ </p>
      <button type="submit" class="btn btn-danger">退会</button>
  </div>
</div>
@endsection