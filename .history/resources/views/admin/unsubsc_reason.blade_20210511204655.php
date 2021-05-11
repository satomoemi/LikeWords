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
                                <th width="30%">理由</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($unsubsc_reason_indexes as $unsubsc_reason_index)
                                <tr>
                                    <th>{{ $unsubsc_reason_index->id }}</th>
                                    <td>{{ \Str::limit($unsubsc_reason_index->reason, 200)}}</td>
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
