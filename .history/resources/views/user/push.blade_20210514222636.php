@extends('layouts.app')

@section('content')
<div class="py-5 text-center">
    <div class="container">
      <div class="row">
        <div class="mx-auto col-md-8">
          <h1 contenteditable="true" class="">通知設定</h1>
          <p class="lead"> Wordを毎日・ランダムに通知します </p> 
          通知時間
          <input type="time" name="push-time"><br> 
          アプリ全体に対して通知
          <input type="radio" class="btn-check" name="push" id="push1">ON
          <input type="radio" class="btn-check" name="push" id="push2">OFF
        </div>
      </div>
      <
      <button type="submit" class="btn btn-primary">更新</button>
  </div>
</div>
@endsection