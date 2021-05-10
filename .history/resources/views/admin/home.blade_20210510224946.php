@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>ユーザー一覧</h4></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div> -->
                    @endif
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">ユーザー名</th>
                                <th width="30%">メールアドレス</th>
                                <th width="30%">生年月日</th>
                                <th width="%">性別</th>

                            </tr>
                        </thead>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
