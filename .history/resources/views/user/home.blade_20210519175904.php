@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- <a class="btn btn-primary" href="{{ route('create.folder')}}">新規フォルダ作成</a> -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">新規フォルダ作成</button>

            <div class="modal fade" id="folderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header mx-auto">
          <h5 class="modal-title">ファイル作成</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> 
          </button>
        </div>
        <div class="modal-body">
          <p>ファイル名</p>
          <input type="text" id="form17" class="form-control"> 通知 <input type="radio" class="btn-check" name="push" id="push1" autocomplete="off">
          <label class="pushON" for="push1">ON</label>
          <input type="radio" class="btn-check" name="push" id="push2" autocomplete="off">
          <label class="pushOFF" for="push2">OFF</label>
        </div>
        <div class="modal-footer"> <button type="button" class="btn btn-primary">作成</button> </div>
      </div>
    </div>
  </div>



            <div class="py-2">
            <div class="col-md-4">
                <input type="search" class="form-control-md" >
                    <a href="#" class="btn btn-primary">検索</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col col-md-6">
            <div class="card">
                <div class="card-header">
                フォルダ
                </div>

                <div class="card-body">
                    <div class="list-group">
                        @foreach($folders as $folder)
                        <a href="{{ route('home') }}" class="list-group-item">
                            {{ $folder->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! -->
                
@endsection
