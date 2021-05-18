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
              <form action='/home/createfolder' method="post">
                @csrf
                <div class="form-group">
                  <label for="name">フォルダ名</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" />

                  @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                  @enderror

                </div>
                <div class="form-group text-center">
                  <label for="push">通知</label> 
                  <input type="radio" class="btn-check" name="push" id="push1" value="ON" {{ (old('push_id') =='ON') ? "checked" : "" }}> ON
                  <input type="radio" class="btn-check" name="push" id="push2" value="男" {{ (old('push_id') =='OFF') ? "checked" : "" }}> OFF

                  @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="text-center">
                <button type="submit" class="btn btn-primary">作成</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection