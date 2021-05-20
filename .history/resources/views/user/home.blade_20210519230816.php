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
        <div class="column col-md-6">
        </
    </div>
</div>
    
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! -->
                
@endsection
