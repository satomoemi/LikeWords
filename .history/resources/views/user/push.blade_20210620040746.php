@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h3>通知設定</h3>
            <p class="lead"> Wordを毎日・ランダムに通知します </p> <!--leadは文字を大きくする-->
        </div>

        <div class="card-body">
          <form method="POST" action="">
          @csrf

            <div class="form-group row">
              <label for="push" class="col-md-4 col-form-label text-md-right">通知時間</label>

              <div class="col-md-6">
                <input type="time" name="push_time" class="form-control @error('push_time') is-invalid @enderror">

                @error('push_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label>アプリ全体に対して通知
              <input type="radio" class="btn-check" name="push" id="push1">ON
              <input type="radio" class="btn-check" name="push" id="push2">OFF
            </div>
        
        <button type="submit" class="btn btn-primary">更新</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection