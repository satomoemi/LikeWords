@extends('layouts.app')

@section('content')
<div class="py-5 text-center">
    <div class="container">
      <div class="row">
        <div class="mx-auto col-md-8">
          <h2 contenteditable="true" class="">通知設定</h2>
          <p class="lead"> Wordを毎日・ランダムに通知します </p> 通知時間　<input type="time" name="push-time"><br> アプリ全体に対して通知　<input type="radio" class="btn-check" name="pushON" id="push1">
          <label class="pushON" for="push1">ON</label>
          <input type="radio" class="btn-check" name="pushOFF" id="push2">
          <label class="pushOFF" for="push2">OFF</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">更新</button>
    </div>
  </div>
@endsection