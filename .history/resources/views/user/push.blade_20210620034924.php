@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h3>通知設定</h3>
            <p class="lead"> Wordを毎日・ランダムに通知します </p> <!--leadは文字を大きくする-->
        </div>
            通知時間
            <input type="time" name="push-time"><br> 
            アプリ全体に対して通知
            <input type="radio" class="btn-check" name="push" id="push1">ON
            <input type="radio" class="btn-check" name="push" id="push2">OFF
          </div>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </div>
    </div>
  </div>
</div>



@endsection