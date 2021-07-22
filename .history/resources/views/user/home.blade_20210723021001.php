@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="btn btn-outline-light" href="{{ route('create.folder')}}" method="post">
                新規フォルダ作成
            </a>
                <div class="py-2">
                    <div class="col-md-8">
                        <form method = get action = "{{ route('home') }}">
                        @csrf
                            <div class="form-group row">
                                <label class="col-md-2  col-form-label text-md-right text-white">Word検索</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="cond_word" value="{{ $cond_word }}">
                                    </div>
                                    <div class="col-md-2">
                                            <input type="submit" class="btn btn-outline-light" value="検索">
                                    </div>
                            </div>
                        </form>
                    </div>      
                </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col col-md-5">
            <table class="table table-white">
                <thead class="thead thead-light">
                    <tr>
                        <th><h6 class=text-dark>Folder</h6></th>
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
                                    <a class="btn btn-outline-light ml-auto mr-1 btn-sm" href="{{ route('edit.folder',['id' => $folder->id])}}">編集</a>
                                    
                                    <a class="btn btn-outline-danger" href="{{ route('delete.folder',['id' => $folder->id]) }}">削除</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach   
                    </tbody>
            </table>
        </div>

        <div class="col col-md-7">
            <table class="table table-white">
                @if($current_folder != NULL)
                <thead class="thead thead-light">
                    <tr>
                        <th>
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('create.word', ['id' => $current_folder->id]) }}">Word作成</a>
                        </th>
                    </tr>
                </thead>
                @endif
                
                <tbody>
                    @foreach($words as $word)
                        <tr class="d-flex justify-content-between align-items-center text-white">
                            <th>
                                    {{ $word->word }} 
                            </th>
                            <td>
                                <div>
                                    <a class="btn btn-outline-light ml-auto mr-1 btn-sm" href="{{ route('edit.word',['id' => $word->id]) }}">編集</a>
                                    
                                    <a class="btn btn-outline-danger btn-sm" href="{{route('word.delete',['id' => $word->id])}}">削除</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>
    
                   
                
@endsection
