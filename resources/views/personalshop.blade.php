@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <img src="img/welfarelogo.png"  class="logofucai"/>
            <img src="img/ticai.jpg"  class="logoticai"/>

            <div class="card">
                <div class="card-header ">
                    <h3 class="welcomeword text-center" >欢迎参观我店</h3>
                </div>

                <div class="card-body"  >
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="list-group firstpage">
                        <div class="list-group-item">
                            <span class="namedesc">店主姓名</span>
                            <span class="shopownername">张飞赵云</span>
                            <div class="imgholder">
                                <img src="{{asset('/img/girl-small.jpg')}}" />
                            </div>
                        </div>
                        <div class="list-group-item">
                            <span class="namedesc">业务团队名称</span>
                            <span class="shopownername">我是团队对对对</span>
                        </div>
                        <div class="list-group-item">
                            <span class="namedesc">店铺地址</span>
                            <span class="shopownername">地址知道的弟弟IDIDIDID滴滴滴滴</span>
                        </div>
                        <div class="list-group-item">
                            <span class="namedesc">请多加联系</span>
                            <span class="shopownername"> weixin,qq,dianhua,,</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card detaillei">
                <div class="card-header subheader row">
                    <div class="col-md-5">
                        <h5 class="text-success">
                            <img src="img/seqiu.jpg" class="zhongleipic" />
                            <span class="picname"> 双色球</span> </h5>
                    </div>
                    <div class="col-md-7">
                        fadsf
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
