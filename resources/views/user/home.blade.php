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
                                    
                                    <a class="btn btn-outline-light mr-1 btn-sm" data-toggle="modal" data-target="#EditFolderModal" data-title="{{ $folder->title }}"  data-url="{{ route('update.folder',['id' => $folder->id, 'user_id' => $user]) }}" >編集</a>

                                    <!--Folder編集Modal-->
                                    <div class="modal fade" id="EditFolderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                        <form role="form" method="post" action="">
                                        @csrf
                                        <!-- modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ --> 
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-dark">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-white" id="myModalLabel">Folder編集</h4>
                                                    </div>
                                                    <div class="modal-body text-white">
                                                        <label for="title" class="text-white">フォルダ名</label>
                                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="" >

                                                        @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror

                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
                                                        <button type="submit" class="btn btn-outline-light">更新</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!--modalにtitleとURLのデータを渡すにはscriptが必要-->
                                    <!--必ずmodalのdivの後に実装-->
                                    <script type="application/javascript">
                                        window.addEventListener('load', function() {
                                            $('#EditFolderModal').on('shown.bs.modal', function (event) {
                                                var button = $(event.relatedTarget);//モーダルを呼び出すときに使われたボタンを取得
                                                var title = button.data('title');
                                                var url = button.data('url');//data-urlの値を取得
                                                var modal = $(this);//モーダルを取得

                                                //Ajaxの処理はここに
                                                //valueは入力ボックスの場合は現在の値（変更後の値）を取得するから、変更前の値（もともとのvalue属性・初期値）を取得するには、defaultValueプロパティを使うらしい
                                                //でもdefaultValueを使っても編集はできるが、値が表示されないからvalueに直接title記載した
                                                modal.find('input').attr('defaultValue',title);
                                                // modal.find('input').val(title);
                                                modal.find('form').attr('action',url);
                                            });
                                        });
                                    </script>
                                
                                

                                    <!--「data-*」でmodalやscriptにデータを渡せる-->
                                    <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteFolderModal" data-title="{{ $folder->title }}" data-url="{{ route('delete.folder',['id' => $folder->id]) }}" >削除</a>

                                    <!--Folder削除Modal-->
                                    <!--必ずforeach内に実装する。foreach外だと$folderの値がない時ERが出る-->
                                    <div class="modal fade" id="DeleteFolderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                        <!--削除のリクエストメソッドをgetからpostに変えるにはformを使用する必要あり-->
                                        <!--form-inline:文字の量に合わせてモーダルの大きさが変化する-->
                                        <!--role属性は要素の「役割」を明示的に示すもの-->
                                        <form role="form" class="form-inline" method="post" action="">
                                        @csrf
                                        <!--modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ-->
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-dark">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-white" id="myModalLabel">Folder削除確認</h4>
                                                    </div>
                                                    <div class="modal-body text-white">
                                                        <p></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
                                                        <!--formタグ使用してるならaタグではなくてbuttonタグね-->
                                                        <button type="submit" class="btn btn-outline-danger">削除</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!--modalにtitleとURLのデータを渡すにはscriptが必要-->
                                    <!--必ずmodalのdivの後に実装-->
                                    <script type="application/javascript">
                                        window.addEventListener('load', function() {
                                            $('#DeleteFolderModal').on('shown.bs.modal', function (event) {
                                                var button = $(event.relatedTarget);//モーダルを呼び出すときに使われたボタンを取得
                                                var title = button.data('title');//data-titleの値を取得
                                                var url = button.data('url');//data-urlの値を取得
                                                var modal = $(this);//モーダルを取得
                                                //Ajaxの処理はここに
                                                //eq（0）：インデックス番号を利用して要素を取得
                                                modal.find('.modal-body p').eq(0).text("本当に"+title+"を削除しますか?");
                                                modal.find('form').attr('action',url);
                                            });
                                        });
                                    </script>

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
                                <a class="btn btn-outline-light mr-1 btn-sm" data-toggle="modal" data-target="#EditWordModal" data-word="{{ $word->word }}" data-memo="{{ $word->memo }}"data-url="{{ route('update.word',['folder_id' => $word->folder_id, 'id' => $word->id]) }}">編集</a>

                                <!--Word編集Modal-->
                                <div class="modal fade" id="EditWordModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                        <form role="form" method="post" action="">
                                        @csrf
                                        <!-- modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ --> 
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-dark">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-white" id="myModalLabel">Word編集</h4>
                                                    </div>
                                                    <div class="modal-body text-white">
                                                        <label for="title" class="text-white">フォルダ名</label>
                                                        <input type="text" class="form-control @error('word') is-invalid @enderror" name="word" value="">

                                                        @error('word')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror

                                                        <label for="memo" class="text-white">メモ（入力は必須ではありません）</label>
                                                        <textarea name="memo" class="form-control" value="{{ old('memo') }}"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
                                                        <button type="submit" class="btn btn-outline-light">更新</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!--modalにtitleとURLのデータを渡すにはscriptが必要-->
                                    <!--必ずmodalのdivの後に実装-->
                                    <script type="application/javascript">
                                        window.addEventListener('load', function() {
                                            $('#EditWordModal').on('shown.bs.modal', function (event) {
                                                var button = $(event.relatedTarget);//モーダルを呼び出すときに使われたボタンを取得
                                                var word = button.data('word');
                                                var memo = button.data('memo');
                                                var url = button.data('url');//data-urlの値を取得
                                                var modal = $(this);//モーダルを取得

                                                //Ajaxの処理はここに
                                                modal.find('input').attr('defaultValue',word);
                                                modal.find('.modal-body textarea').text(memo);
                                                modal.find('form').attr('action',url);
                                            });
                                        });
                                    </script>

                                
                                <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteWordModal" data-title="{{ $word->word }}" data-url="{{ route('delete.word',['id' => $word->id]) }}">削除</a>
                                
                                <!--Word削除Modal-->
                                <div class="modal fade" id="DeleteWordModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                    <form role="form" class="form-inline" method="post" action="">
                                    @csrf
                                <!--modal-dialog：閉じるまで親ウィンドウの操作ができなくなるダイアログ-->
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-dark">
                                                <div class="modal-header">
                                                    <h4 class="modal-title text-white" id="myModalLabel">Word削除確認</h4>
                                                </div>
                                                <div class="modal-body text-white">
                                                    <p></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-outline-light" data-dismiss="modal">閉じる</a>
                                                    <button type="submit" class="btn btn-outline-danger">削除</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <script type="application/javascript">
                                    window.addEventListener('load', function() {
                                        $('#DeleteWordModal').on('shown.bs.modal', function (event) {
                                            var button = $(event.relatedTarget);//モーダルを呼び出すときに使われたボタンを取得
                                            var title = button.data('title');//data-titleの値を取得
                                            var url = button.data('url');//data-urlの値を取得
                                            var modal = $(this);//モーダルを取得
                                            //Ajaxの処理はここに
                                            modal.find('.modal-body p').eq(0).text("本当に"+title+"を削除しますか?");
                                            modal.find('form').attr('action',url);
                                        });
                                    });
                                </script>

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

                    <label for="memo" class="text-white py-1">メモ （入力は必須ではありません）</label>
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


                   
                
@endsection
