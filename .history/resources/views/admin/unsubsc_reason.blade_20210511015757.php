@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>退会理由一覧</h4></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="10%">理由</th>
                            </tr>
                        </thead>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
