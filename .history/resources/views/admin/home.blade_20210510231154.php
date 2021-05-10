@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4>ユーザー一覧</h4></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div> -->
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">ユーザー名</th>
                                <th width="20%">メールアドレス</th>
                                <th width="10%">生年月日</th>
                                <th width="10%">性別</th>
                                <th width="20%">パスワード</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th>{{ $user->id }}</th>
                                    <td>{{ \Str::limit($user->,name 50) }}</td>
                                    <td>{{ \Str::limit($user->,email 50) }}</td>
                                    <td>{{ \Str::limit($user->,birthday 10) }}</td>
                                    <td>{{ \Str::limit($user->, 100) }}</td>
                                    <td>{{ \Str::limit($user->,email 100) }}</td>
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
