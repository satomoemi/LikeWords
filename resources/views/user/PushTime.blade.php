@extends('layouts.app')

@section('content')

@if($push->doesntExist())
  <div class="container">
    <div class="row justify-content-center text-white">
      <h2>通知の登録をしてから通知時間を設定してください</h2>
    </div> 
    <div class="row justify-content-center text-white"> 
      <p>右下のベルマークで登録できます</p>
    </div>
  </div>
@else
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-white"><h3>通知時間設定</h3>
              <p class="lead"> Wordを毎日・ランダムに通知します </p> <!--leadは文字を大きくする-->
          </div>

          <div class="card-body bg-dark">
            <form method="POST" action="/push/time">
            @csrf

              <div class="form-group row">
                <label for="push_time" class="col-md-4 col-form-label text-md-right text-white">
                  通知時間
                </label>

                <div class="col-md-6 ">
                  <input type="time" name="push_time" {{ $pushtime != NULL ? "value={$pushtime}" : "" }}  class="form-control text-center @error('push_time') is-invalid @enderror">
                  
                  @error('push_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-12 col-11 text-center">
                  <button type="submit" class="btn btn-outline-light">更新</button>
                </div>
              </div>

              
          
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
@endif
@endsection