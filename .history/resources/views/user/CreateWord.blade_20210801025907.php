@extends('layouts.app')

@section('content')
<div class="py-5">
  <div class="container">
      <div class="row">
        <div class="mx-auto col-md-8">

          <div class="card">
            <div class="card-header bg-white">
            Word作成
            </div>

            <div class="card-body bg-dark">
              <!--folder_idはwordテーブルのやつ--> 
              <!--folder_idにはvalidateをかけてるからNULLじゃ保存ができないから、folder_idに入れたい$folder->idという値を渡して保存する--> 
              <form method="post" action="{{ route('create.word',['folder_id' => $folder->id]) }}" >
              @csrf

                  <div class="form-group row">
                      <label for="word" class="text-white">Word</label>
                      <input type="text" class="form-control @error('word') is-invalid @enderror" name="word" value="{{ old('word') }}">

                      @error('word')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                      <label for="memo">メモ</label>
                      <textarea name="memo" class="form-control" >{{ old('memo') }}</textarea>
                  </div>

                  <div class="text-center">
                    <button  type="submit" class="btn btn-outline-light">作成</button>
                  </div>
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection