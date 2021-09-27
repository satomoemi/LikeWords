@extends('layouts.app')

@section('content')
<div class="container pt-2">
    <div class="row">
        <div class="col-md-7 col-12">
            <form method = get action = "{{ route('home') }}">
            @csrf
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right text-white">
                        Word検索
                    </label>
                    <div class="col-md-4 col-8">
                        <input type="text" class="form-control" name="cond_word" value="{{ $cond_word }}">
                    </div>
                    <div class="col-md-3 col-4">
                        <button type="submit" class="btn btn-outline-light"> 
                        <i class="fas fa-search" style="color: white;"></i>
                        検索 
                    </buttton>
                    </div>
                </div>
            </form>
        </div>

        <!--通知時間表示（入力の無効化）-->   
        <div class="form-group row ml-auto mr-1">
            <div class="col-md-12"> <!--rowのrowの中の12かも-->
                <label class="text-white" >設定した通知時間</label>
                <input type="time" name="push_time" class=" pl-4 text-center text-dark" {{ $pushtime != NULL ? "value={$pushtime}" : "" }}  disabled>
            </div>
        </div>

    </div>
</div>


<div class="container py-5">
    <div class="row">
        <div class="col-12 col-md-6">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="45%" id="FolderIndex" class="text-white pb-3">
                            Folder一覧
                        </th>
                        <!--この空白がないとtheadが欠ける-->
                        <th width="30%" id="FolderSpace1"></th>
                        <th width="25%" id="CreateFolderButton">
                            <a class="btn btn-outline-light btn-sm" data-toggle="modal" data-target="#CreateFolderModal">
                                <i class="fas fa-folder fa-lg"></i>
                                Folder作成
                            </a>
                        </th>
                    </tr>
                </thead>

                    <tbody>
                        @foreach($folders as $folder)
                            <tr class="align-items-center text-white">
                                <th  class="mr-auto">
                                    <a href="{{ route('home', ['id' => $folder->id]) }}">
                                        <i class="fas fa-folder fa-lg"></i>
                                        {{ $folder->title }}
                                    </a>
                                </th>
                                <td></td>
                                <td>
                                    <a class="btn btn-outline-light mr-1 btn-sm " href="{{ route('edit.folder',['id' => $folder->id])}}">編集</a>
                                    
                                    <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteFolderModal">削除</a>
                                </td>
                            </tr>
                        @endforeach   
                    </tbody>
            </table>
        </div>

        <div class="col-12 col-md-6">
            <table class="table table-white table-hover">
                @if($current_folder != NULL)
                <thead>
                    <tr>
                        <th width="45%" id="WordIndex" class="text-white pb-3">
                            Word一覧
                        </th>
                            <!--この空白がないとheadが欠ける-->
                            <th width="30%" id="WordSpace1"></th>
                            <th width="25%" id="CreateWordButton">
                                <a class="btn btn-outline-light btn-sm" data-toggle="modal" data-target="#CreateWordModal">
                                    <i class="fas fa-pencil-alt fa-lg"></i>
                                    Word作成
                                </a>
                            </th>
                    </tr>
                </thead>
                @endif
                
                <tbody>
                    @foreach($words as $word)
                        <tr class="align-items-center text-white">
                            <th class="mr-auto">
                            <i class="fas fa-pencil-alt fa-lg"></i>
                                {{ $word->word }} 
                            </th>
                            <td></td>
                            <td>
                                <a class="btn btn-outline-light mr-1 btn-sm" href="{{ route('edit.word',['id' => $word->id]) }}">編集</a>
                                
                                <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteWordModal">削除</a>
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Modal関連-->
<!--Folder作成Modal-->
<div class="modal fade" id="CreateFolderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <!--modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ-->
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h4 class="modal-title text-white" id="myModalLabel">Folder作成</h4>
            </div>
            <div class="modal-body text-white">
                <form method="post" action="{{ route('create.folder',['user_id' => $user]) }}" >
                    @csrf
                    <label for="title" class="text-white">フォルダ名</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title')}}">
                    
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
                    <button  type="submit" class="btn btn-outline-light">作成</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Folder編集Modal-->
<!-- @foreach($folders as $folder)
    <div class="modal fade" id="EditFolderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"> -->
        <!-- modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ -->
        <!-- <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h4 class="modal-title text-white" id="myModalLabel">Folder編集</h4>
                </div>
                <div class="modal-body text-white">
                    <form method="post" action="{{ route('edit.folder',['id' => $folder->id, 'user_id' => $user]) }}" >
                    @csrf
                        <div class="form-group row">
                            <label for="title" class="text-white">フォルダ名</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title')}} {{ $folder->title }}">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
                    <button  type="submit" class="btn btn-outline-light">更新</button>
                </div>
                </form>
            </div>
        </div>
    </div> -->
<!-- @endforeach  --> 


<!--Folder削除Modal-->
<!--これがないと$folderの値がない時ERが出る。つまり上のforeachの$folderがなくなるからここにもforeach書く-->
@foreach($folders as $folder)
<div class="modal fade" id="DeleteFolderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <!--modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ-->
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h4 class="modal-title text-white" id="myModalLabel">Folder削除確認</h4>
            </div>
            <div class="modal-body text-white">
                <label>本当にFolderを削除しますか？<br>Folderを削除したらWordも削除されます</label>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
                <a class="btn btn-outline-danger" href="{{ route('delete.folder',['id' => $folder->id]) }}">削除</a>
            </div>
        </div>
    </div>
</div>
@endforeach   

<!--これがないと/homeの時（?id=1がない時）ER出る。idの値ないけど？って-->
@if($current_folder != NULL)
<!--Word作成Modal-->
<div class="modal fade" id="CreateWordModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <!--modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ-->
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h4 class="modal-title text-white" id="myModalLabel">Word作成</h4>
            </div>
            <div class="modal-body text-white">
                <!--WordModelのfolder_idにはvalidateをかけてるからNULLでは保存ができない、folder_idに値を入れたいなら$word_folder->idという値を渡して保存する--> 
                <form method="post" action="{{ route('create.word',['folder_id' => $word_folder->id]) }}" >
                @csrf
                    <label for="word" class="text-white">Word</label>
                    <input type="text" class="form-control @error('word') is-invalid @enderror" name="word" value="{{ old('word') }}">

                    @error('word')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label for="memo" class="text-white py-1">メモ</label>
                    <textarea name="memo" class="form-control" >{{ old('memo') }}</textarea>
            </div>
                    <div class="modal-footer">
                        <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
                        <button  type="submit" class="btn btn-outline-light">作成</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endif

<!--Word編集Modal-->
<!-- <div class="modal fade" id="WordEditModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"> -->
    <!--modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ-->
    <!-- <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h4 class="modal-title text-white" id="myModalLabel">Word編集</h4>
            </div>
            <div class="modal-body text-white">
                
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
                    <button  type="submit" class="btn btn-outline-light">更新</button>
                </div>
            
        </div>
    </div>
</div> -->

<!--Word削除Modal-->
<!--これがないと/homeの時（?id=1がない時）ER出る。idの値ないけど？って-->
@if($current_folder != NULL)
<!--これがないと$wordの値がない時ERが出る。つまり上のforeachの$wordがなくなるからここにもforeach書く-->
    @foreach($words as $word)
        <div class="modal fade" id="DeleteWordModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <!--modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ-->
            <div class="modal-dialog">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h4 class="modal-title text-white" id="myModalLabel">Word削除確認</h4>
                    </div>
                    <div class="modal-body text-white">
                        <label>本当にWordを削除しますか？</label>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
                        <a class="btn btn-outline-danger" href="{{route('word.delete',['id' => $word->id])}}">削除</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach 
@endif


                   
                
@endsection
