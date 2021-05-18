@extends('layouts.app')

@section('content')
<div class="py-5">
  <div class="container">
      <div class="row">
        <div class="mx-auto col-md-8">
              <form action="#" method="post">
          <div class="card">
            <div class="card-header">
            フォルダ作成
            </div>
            <div class="card-body">
                @csrf
                <div class="form-group">
                  <label for="title">フォルダ名</label>
                  <input type="text" class="form-control" name="title" id="title" />
                </div>
                <div class="form-group text-center">
                  <label for="push">通知</label> 
                  <input type="radio" class="btn-check" name="push" id="push1" autocomplete="off">ON
                  <input type="radio" class="btn-check" name="push" id="push2" autocomplete="off">OFF
                </div>
                
                <button class="btn btn-primary">作成</button>

            </div>
          </div>
        </div>
              </form>
      </div>
  </div>
</div>
@endsection