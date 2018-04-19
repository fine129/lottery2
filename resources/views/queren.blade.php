@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body"  >
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                   <h3 class="bg-success text-center">
                       <a class="alert-dark" href="{!! url('iamshop') !!}">
                         变量是：   {!! $red.'==='.$blue !!}
                       </a>
                   </h3>
                        <example-component v-bind:title="msg"></example-component>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
