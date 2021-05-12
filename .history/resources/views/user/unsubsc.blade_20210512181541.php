@extends('layouts.app')

@section('content')
<div class="py-5 text-center">
  <div class="container">
      <div class="form-group row">
        <div class="mx-auto col-md-8">
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

      <form method="post" action="/unsubsc">
      @csrf
              <div class="form-group row">
                  <label for="password"  class="col-md-4 col-form-label text-md-right">現在のパスワードを入力</label>
                  <div class="col-md-6">
                      <input type="password"  name="CurrentPassword" class="form-control @error('CurrentPassword') is-invalid @enderror">
                      @error('CurrentPassword')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div>
                  <input type="hidden" name="UserId" value={{$auth["id"]}}>
                  
                  <button class="btn btn-danger">退会</button>
                  </div>
              </div>
      </form>

        </div>
      </div>
    
  </div>
</div>
@endsection