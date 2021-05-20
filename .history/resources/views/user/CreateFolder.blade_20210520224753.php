@extends('layouts.app')

@section('content')
<div class="py-5">
  <div class="container">
      <div class="row">
        <div class="mx-auto col-md-8">
          <div class="card">
            <div class="card-header">
            フォルダ作成
            </div>
            <div class="card-body">
              <form action="{{ action('HomeController@CreateFolder') }}" method="post">
              @csrf
                <div class="form-group">
                  <label for="title">フォルダ名</label>
                  <input type="text" class="form-control @error('title') is-invalid @enderror" name="title">

                  @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                  @enderror

                </div>
                <div class="form-group text-center">
                  <label for="push">通知</label> 
                  <input type="radio" class="btn-check @error('pushes_id') is-invalid @enderror" name="push" value="ON" {{ (old('pushes_id') =='ON') ? "checked" : "" }}> ON

                  <input type="radio" class="btn-check @error('pushes_id') is-invalid @enderror" name="push" value="OFF" {{ (old('pushes_id') =='OFF') ? "checked" : "" }}> OFF

                  @error('pushes_id')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                </div>
                <div class="text-center">
                  <button  class="btn btn-primary">作成</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection