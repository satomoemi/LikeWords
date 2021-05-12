@extends('layouts.app')
@section('content')
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">退会</div> -->
                <div class="card-body">

                    <!-- <form method="post" action="/user/edit/Withdrawal">
                    @csrf
                            <div class="form-group row">
                                <label for="password"  class="col-md-4 col-form-label text-md-right">現在のパスワードを入力</label>
                                <div class="col-md-6">
                                    <input type="password"  name="CurrentPassword" class="form-control @error('CurrentPassword') is-invalid @enderror">
                                    @error('CurrentPassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input type="hidden" name="UserId" value={{$auth["id"]}}>
                                <button class="btn btn-danger">退会</button>
                            </div>
                    </form> -->

                </div>
            </div>
        </div>
    </div>
</div>



</body>
@endsection