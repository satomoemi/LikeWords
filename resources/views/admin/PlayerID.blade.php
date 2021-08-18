@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white"><h4>Player ID一覧</h4></div>

                <div class="card-body bg-dark">
                    <table class="table table-responsive text-nowrap ">
                        <thead>
                            <tr class="text-white">
                                <th width="5%">ID</th>
                                <th width="5%">User ID</th>
                                <th width="30%">Player ID</th>
                                <th width="20%">Push Time</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($push_playerids as $push_playerid)
                                <tr class="text-white">
                                    <th>{{ $push_playerid->id }}</th>
                                    <td>{{ $push_playerid->user_id }}</td>
                                    <td>{{ $push_playerid->player_id }}</td>
                                    <td>{{ $push_playerid->push_time }}</td>
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
