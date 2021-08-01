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
                                <label class="col-md-2  col-form-label text-md-right text-white">
                                    Word検索
                                </label>
                                <div class="col-md-4">
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
        <div class="col col-md-6">
            <table class="table table-hover">
                <thead class="bg-white">
                    <tr class="text-dark">
                        <th>Folder</th>
                        <th width="30%"></th><!--この空白がないとheadが欠ける-->

                    </tr>
                </thead>

                    <tbody>
                        @foreach($folders as $folder)
                            <tr class="align-items-center">
                                <th class="mr-auto">
                                    <a href="{{ route('home', ['id' => $folder->id]) }}">
                                        {{ $folder->title }}    
                                    </a>
                                </th>
                                <td>
                                    <a class="btn btn-outline-light mr-1 btn-sm" href="{{ route('edit.folder',['id' => $folder->id])}}">編集</a>
                                    
                                    <a class="btn btn-outline-danger btn-sm" href="{{ route('delete.folder',['id' => $folder->id]) }}">削除</a>
                                </td>
                            </tr>
                        @endforeach   
                    </tbody>
            </table>
        </div>

        <div class="col col-md-6">
            <table class="table table-white table-hover">
                @if($current_folder != NULL)
                <thead class="bg-white">
                    <tr>
                        <th >
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('create.word', ['id' => $current_folder->id]) }}">Word作成</a>
                        </th>
                        <th width="30%"></th><!--この空白がないとheadが欠ける-->
                    </tr>
                </thead>
                @endif
                
                <tbody>
                    @foreach($words as $word)
                        <tr class="align-items-center text-white">
                            <th class="mr-auto">
                                {{ $word->word }} 
                            </th>
                            <td>
                                <a class="btn btn-outline-light mr-1 btn-sm" href="{{ route('edit.word',['id' => $word->id]) }}">編集</a>
                                
                                <a class="btn btn-outline-danger btn-sm" href="{{route('word.delete',['id' => $word->id])}}">削除</a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>
    
                   
                
@endsection
