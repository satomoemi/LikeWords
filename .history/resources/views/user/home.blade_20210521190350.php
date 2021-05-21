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
        <div class="col col-md-5">
            <table class="table table-dark">
                <thead><tr><th>Folder</th></tr></thead>

                    <tbody>
                        @foreach($folders as $folder)
                            <tr  class="d-flex justify-content-between align-items-center">
                                <th>
                                    <a href="{{ route('home') }}">
                                    {{ $folder->title }}    
                                    </a>
                                </th>
                                <td>
                                    <div>
                                    <a class="btn btn-primary ml-auto mr-1" href="#">編集</a>
                                    
                                    <a class="btn btn-danger" href="#">削除</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach   
                    </tbody>
            </table>
        </div>
        <div class="col col-md-7">
            <table class="table table-dark">
                <thead><tr><th><a class="btn btn-primary" href="#">Word作成</a></th></tr></thead>

                    <tbody>
                        <tr class="d-flex justify-content-between align-items-center">
                            <th></th>
                        
                        <a href="#" class="list-group-item">
                            
                        </a>
                        <div>
                        <a class="btn btn-primary ml-auto mr-1" href="#">編集</a>
                        <a class="btn btn-danger" href="#">削除</a></div>
                       </tr>
                    </tbody>

            </table>
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
