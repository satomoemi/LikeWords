@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="btn btn-primary" href="{{ action('HomeController@CreateFolderForm')}}" method="get">新規フォルダ作成</a>
            <div class="py-2">
                <div class="col-md-4">
                    <form method = get action = "{{ route('home') }}">
                        <div class="form-group row">
                            <input type="text" class="form-control-md" name="cond_word" >
                                <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                
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
                                    <a class="btn btn-primary ml-auto mr-1" href="{{ route('edit.folder',['id' => $folder->id])}}">編集</a>
                                    
                                    <a class="btn btn-danger" href="{{ route('delete.folder',['id' => $folder->id]) }}">削除</a>
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
                                    {{ $word->word }} 
                            </th>
                            <td>
                                <div>
                                    <a class="btn btn-primary ml-auto mr-1" href="{{ route('edit.word',['id' => $word->id]) }}">編集</a>
                                    
                                    <a class="btn btn-danger" href="{{route('word.delete',['id' => $word->id])}}">削除</a>
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
