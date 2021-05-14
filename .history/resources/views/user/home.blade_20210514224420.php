@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <a class="btn btn-primary" href="#">新規フォルダ作成</a> </div>
      </div>
    </div>
  </div>
  <div class="text-center py-3">
    <div class="container">
      <div class="row">
        <div class="mx-auto col-md-8 py-5">
          <h1 class="mb-3">フォルダ一覧表示<br></h1>
          <p class="lead">「英語」「中国語」など<br></p>
        </div>
      </div>
    </div>
  </div>
            <!-- <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div> -->
            </div>
        </div>
    </div>
</div>
@endsection
