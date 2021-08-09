@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="btn btn-outline-light" href="{{ route('create.folder')}}" method="post">
                新規Folder作成
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
 <!--通知時間表示（読み取りのみ）-->   
    <div class="row">
        <div class="col-md-6"> 
        </div>
        <div class="col-md-6 mb-2"> 
            <label class="text-white">設定した通知時間</label>
            <input type="time" name="push_time" {{ $pushtime != NULL ? "value={$pushtime}" : "" }}  readonly>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col col-md-6">
            <table class="table table-hover">
                <thead class="bg-white">
                    <tr class="text-dark mb-9">
                        <th>
                            <h5 class="mb-0 py-1">
                                <i class="fas fa-folder fa-lg"></i>
                                Folder
                            </h5>
                        </th>
                        <!--この空白がないとheadが欠ける-->
                        <!--width：私からみて右から左へ移動してく-->
                        <th width="30%"></th>

                    </tr>
                </thead>

                    <tbody>
                        @foreach($folders as $folder)
                            <tr class="align-items-center text-white">
                                <th class="mr-auto">
                                    <i class="fas fa-folder fa-lg"></i>
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
                        <th>
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
                            <i class="fas fa-pencil-alt fa-lg"></i>
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
</div>
<!--Modal関連-->
<!--Folder編集Modal-->
<!-- <div class="modal fade" id="FolderEditModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"> -->
    <!--modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ-->
    <!-- <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h4 class="modal-title text-white" id="myModalLabel">Folder編集</h4>
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

<!--Folder削除Modal-->
<!-- <div class="modal fade" id="FolderDeleteModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"> -->
    <!--modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ-->
    <!-- <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h4 class="modal-title text-white" id="myModalLabel">Folder削除確認</h4>
            </div>
            <div class="modal-body text-white">
                <label>本当にFolderを削除しますか？<br>Folderを削除したらWordも削除されます</label>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
                <a class="btn btn-outline-danger">削除</a>
            </div>
        </div>
    </div>
</div> -->

<!--Word削除Modal-->
    <!-- <div class="modal fade" id="WordDeleteModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"> -->
        <!--modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ-->
        <!-- <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h4 class="modal-title text-white" id="myModalLabel">Word削除確認</h4>
                </div>
                <div class="modal-body text-white">
                    <label>本当にWordを削除しますか？</label>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
                    <a class="btn btn-outline-danger">削除</a>
                </div>
            </div>
        </div>
    </div> -->
                   
                
@endsection
