@extends('layouts.app')

@section('content')
<div class="py-5">
  <div class="container">
      <div class="row">
        <div class="mx-auto col-md-8">

          <div class="card">
            <div class="card-header">
            Word作成
            </div>

            <div class="card-body">
              <!--folder_idはwordテーブルのやつ--> 
              <!--folder_idにはvalidateをかけてるからNULLじゃ保存ができないから、folder_idに入れたい$folder->idという値を渡して保存する--> 
              <form method="post" action="{{ route('create.word',['folder_id' => $folder->id]) }}" >
              @csrf

                <div class="form-group row">
                  <label for="word">Word</label>
                  <input type="text" class="form-control @error('word') is-invalid @enderror" name="word" value="{{ old('word') }}">{{ $word->word}}

                  @error('word')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror

                  <label for="memo">メモ</label>
                  <textarea name="memo" class="form-control @error('memo') is-invalid @enderror" value="{{ old('memo') }}">{{$word->memo}}</textarea>

                  @error('memo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror

                </div>

                <!-- <div class="form-group text-center">
                  <label for="push">通知</label> 
                  <input type="radio" class="btn-check @error('pushes_id') is-invalid @enderror" name="push" value="ON" {{ (old('pushes_id') =='ON') ? "checked" : "" }}> ON

                  <input type="radio" class="btn-check @error('pushes_id') is-invalid @enderror" name="push" value="OFF" {{ (old('pushes_id') =='OFF') ? "checked" : "" }}> OFF

                  @error('pushes_id')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror -->

                <!-- </div> -->

                <div class="text-center">
                  <button  type="submit" class="btn btn-primary">更新</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection