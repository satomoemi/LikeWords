@extends('layouts.app')

@section('content')

@if($push->doesntExist())
<div class="container">
  <div class="row justify-content-center">
  <h2>通知の登録をしてから通知時間を設定してください</h2>
  <p>左下のベルマークで登録できます</p>
  </div>
</div>
@else
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header"><h3>通知時間設定</h3>
              <p class="lead"> Wordを毎日・ランダムに通知します </p> <!--leadは文字を大きくする-->
          </div>

          <div class="card-body">
            <form method="POST" action="/push/time">
            @csrf

              <div class="form-group row">
                <label for="push_time" class="col-md-4 col-form-label text-md-right">通知時間</label>

                <div class="col-md-6">
                  <input type="time" name="push_time" value={{$pushtime}} {{ $pushtime = NULL ? "" : $pushtime }}  class="form-control @error('push_time') is-invalid @enderror">

                  @error('push_time')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>

              <!-- <div class="form-group row">
                <label for="push" class="col-md-4 col-form-label text-md-right">アプリ全体に対して通知</label>

                <div class="col-md-6">
                  <input id="push1" type="radio" class="btn-check @error('') is-invalid @enderror" name="push" value="">ON
                  <input id="push2" type="radio" class="btn-check @error('') is-invalid @enderror" name="push" id="push2">OFF
                </div>
              </div> -->

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">更新</button>
                </div>
              </div>

              
          
            </form>
          </div>
              @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif
        </div>
      </div>
    </div>
  </div>
  
@endif
@endsection