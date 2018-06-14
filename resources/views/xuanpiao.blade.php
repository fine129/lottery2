@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class=" valuehere" data-reds='' data-danusedall=""
                          data-dannum="" data-tuonum="" data-bluenum="" data-tempdan="" data-temptuo=""
                          data-blues='' data-allnum=""></span>
                    <span class=" valuehalf" data-halfred='' data-halfblue='' ></span>
                    <h5 class="alert  text-danger">
                       祝你好运常在！<h6 class="btn btn-info ruledesc " >规则说明</h6>
                        <div class="text-info modal-dialog-centered ruledesc  ">
                            <div class="">
                                一、机选功能用法
                                1、使用各个按钮前必须在前面输入框中输入整数，切不可超过最高限额。
                                2、胆球机选最高不可超过五个。
                                3、拖球机选最高不可好过剩余球数。
                                4、蓝球机选不可超过剩余蓝球数目。
                                二、胆拖投注须知
                                1、
                            </div>


                        </div>
                    </h5>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="card-body"  >
                    <div class="alert-danger">{!! empty($errormsg)?'':$errormsg !!}</div>
                    <router-link class="firstsel   " to="/">选号</router-link>
                    <router-link to="/dantuo">胆拖选号</router-link>
                    <router-view></router-view>
                </div>
                </div>

        </div>

    </div>
</div>

@endsection
