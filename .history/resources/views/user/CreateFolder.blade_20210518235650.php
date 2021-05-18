@extends('layouts.app')

@section('content')
<div class="py-5 text-center">
  <div class="container">
      <div class="row">
        <div class="mx-auto col-md-8">
          <div class="card">
          <div class="card-header">
          フォルダ名
          </div>
          
          <input type="text" id="form17" class="form-control"> 通知 <input type="radio" class="btn-check" name="push" id="push1" autocomplete="off">ON
          <input type="radio" class="btn-check" name="push" id="push2" autocomplete="off">OFF
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
  </div>
</div>
@endsection