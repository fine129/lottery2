@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="alert  text-danger">
                     请选择号码
                    </h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="card-body"  >
                    <div class="alert-danger">{!! empty($errormsg)?'':$errormsg !!}</div>
                    <xuanhao></xuanhao>
                </div>
                </div>
        </div>

    </div>
</div>

@endsection
