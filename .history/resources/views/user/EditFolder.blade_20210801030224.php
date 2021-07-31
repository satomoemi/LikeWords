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

            <div class="card-body bg-">
              <!--'id' => $folder->id これがないと更新する内容を送れずnullになってしまうidを送ってcontrollでmodelとfindしてレコードを出してる-->
              <form method="post" action="{{ route('edit.folder',['id' => $folder->id, 'user_id' => $user]) }}" >
              @csrf

                  <div class="form-group row">
                      <label for="title" class="text-white">フォルダ名</label>
                      <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title')}} {{ $folder->title }}">

                      @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  </div>

                <div class="text-center">
                  <button  type="submit" class="btn btn-outline-light">更新</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection