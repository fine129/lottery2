@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class=" valuehere" data-reds='' data-blues='' data-allnum=""></span>
                    <span class=" valuehalf" data-halfred='' data-halfblue='' ></span>
                    <h2 class="alert  text-danger">
                     祝你好运常在！
                    </h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="card-body"  >
                    <div class="alert-danger">{!! empty($errormsg)?'':$errormsg !!}</div>
                    <router-link class="firstsel btn btn-success " to="/xuanhao">选号</router-link>
                    <router-link to="/confirm">确定选号</router-link>
                    <router-view></router-view>
                </div>
                </div>

        </div>

    </div>
</div>

@endsection
