@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="btn btn-primary" href="{{ route('create.folder')}}">新規フォルダ作成</a>
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
                Folder
                </div>

                <div class="card-body">
                    <div class="list-group  d-flex justify-content-between align-items-center">
                        @foreach($folders as $folder)
                        <a href="{{ route('home') }}" class="list-group-item">
                            {{ $folder->name }}
                        </a>
                        <a class="btn btn-primary ml-auto mr-1" href="#">編集</a>
                        <a class="btn btn-danger" href="#">削除</a></li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="column col-md-6">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="#">Word作成</a>
                    <label></label>
                </div>
                <div class="card-body">
                    <div class="list-group  d-flex justify-content-between align-items-center">
                        @foreach($words as $word)
                        <li class="list-group-item">
                            {{ $word->word }} 
                            <i class="fa fa-microphone ml-2 mr-auto" aria-hidden="true">
                            <a class="btn btn-primary ml-auto mr-1" href="#">編集</a>
                            <a class="btn btn-danger" href="#">削除</a></li>
                        </li>
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
