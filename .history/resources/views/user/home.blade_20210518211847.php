@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="btn btn-primary" href="#">新規フォルダ作成</a>
        <div class="col-md-12">
        <input type="search" class="form-control-sm" >
          <!-- <span class="input-group-btn"> -->
            <button class="btn btn-default" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </span>
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
