@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white"><h4>ユーザー一覧</h4></div>

                <div class="card-body bg-dark">
                    <table class="table table-responsive">
                        <thead>
                            <tr class="text-white">
                                <th width="5%">ID</th>
                                <th width="15%">ユーザー名</th>
                                <th width="20%">メールアドレス</th>
                                <th width="10%">生年月日</th>
                                <th width="10%">性別</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($user_indexes as $user_index)
                                <tr class="text-white">
                                    <th>{{ $user_index->id }}</th>
                                    <td>{{ \Str::limit($user_index->name, 50)}}</td>
                                    <td>{{ \Str::limit($user_index->email, 50)}}</td>
                                    <td>{{ \Str::limit($user_index->birthday, 50)}}</td>
                                    <td>{{ \Str::limit($user_index->gender, 20)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
