@extends('layouts.app')

@section('content')
<div class="py-5 text-center">
  <div class="container">
      <div class="row">
        <div class="mx-auto col-md-8">
          <h2 contenteditable="true" class="">フォルダ名</h2>
          <input type="text" id="form17" class="form-control"> 通知 <input type="radio" class="btn-check" name="push" id="push1" autocomplete="off">
          <label class="pushON" for="push1">ON</label>
          <input type="radio" class="btn-check" name="pushOFF" id="push2" autocomplete="off">
          <label class="pushOFF" for="push2">OFF</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
  </div>
</div>