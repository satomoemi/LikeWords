@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="btn btn-primary" href="#">新規フォルダ作成</a>
            <div class="col-md-6">
                <input type="search" class="form-control-sm" >
                    <a href="#" class=btn btn-default >
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col col-md-4">
            <div class="card">
                <div class="card-header">フォルダ
                
                </div>

                <div class="card-body">
            </div>
        </div>
    </div>
</div>
            
        </div>
    </div>
</div>
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! -->
                
@endsection
