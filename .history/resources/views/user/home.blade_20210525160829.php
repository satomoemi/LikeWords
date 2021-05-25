@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="btn btn-primary" href="{{ action('HomeController@CreateFolderForm')}}" method="get">新規フォルダ作成</a>
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
            <table class="table table-white">
                <thead class="thead thead-dark">
                    <tr>
                        <th>Folder</th>
                    </tr>
                </thead>

                    <tbody>
                        @foreach($folders as $folder)
                            <tr  class="d-flex justify-content-between align-items-center">
                                <th>
                                @if($current_folder != NULL)
                                    <a href="{{ route('home', ['id' => $folder->id]) }}" 
                                    class="{{ $current_folder->id === $folder->id ? 'class=active' : '' }}">
                                        {{ $folder->title }}    
                                    </a>
                                @else
                                    <a href="{{ route('home', ['id' => $folder->id]) }}" >
                                        {{ $folder->title }}    
                                    </a>
                                @endif
                                </th>
                                <td>
                                    <div>
                                    <a class="btn btn-primary ml-auto mr-1" href="#">編集</a>
                                    
                                    <a class="btn btn-danger" href="{{ route('folder.delete',['id' => $folder->id]) }}">削除</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach   
                    </tbody>
            </table>
        </div>

        <div class="col col-md-7">
            @if($current_folder != NULL)
            <table class="table table-white">
                <thead class="thead thead-dark">
                    <tr>
                        <th>
                            <a class="btn btn-primary" href="{{ route('create.word', ['id' => $current_folder->id]) }}">Word作成</a>
                        </th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($words as $word)
                        <tr class="d-flex justify-content-between align-items-center">
                            <th>
                                <a >
                                    {{ $word->word }}
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
            @endif
        </div>
    </div>
</div>
    
                   
                
@endsection
