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
        <div class=" col-md-6">
            <table class="table table-hover">
                <thead class="bg-white">
                    <tr class="text-dark mb-9">
                        <th>
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('create.folder')}}" method="post">
                                <i class="fas fa-folder fa-lg"></i>
                                新規Folder作成
                            </a>
                        </th>
                        <!--この空白がないとtheadが欠ける-->
                        <th class="col-md-3 col-5"></th>

                    </tr>
                </thead>

                    <tbody>
                        @foreach($folders as $folder)
                            <tr class="align-items-center text-white">
                                <th class="mr-auto">
                                    <a href="{{ route('home', ['id' => $folder->id]) }}">
                                        <i class="fas fa-folder fa-lg"></i>
                                        {{ $folder->title }}
                                    </a>
                                </th>
                                <td>
                                    <a class="btn btn-outline-light mr-1 btn-sm " href="{{ route('edit.folder',['id' => $folder->id])}}">編集</a>
                                    
                                    <a class="btn btn-outline-danger btn-sm" href="{{ route('delete.folder',['id' => $folder->id]) }}">削除</a>
                                </td>
                            </tr>
                        @endforeach   
                    </tbody>
            </table>
        </div>

        <div class="col-12 col-md-6">
            <table class="table table-white table-hover">
                @if($current_folder != NULL)
                <thead class="bg-white">
                    <tr>
                        <th>
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('create.word', ['id' => $current_folder->id]) }}">
                                <i class="fas fa-pencil-alt fa-lg"></i>
                                Word作成
                            </a>
                        </th>
                        <th class="col-md-3 col-5"></th><!--この空白がないとheadが欠ける-->
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
                   
                
@endsection
