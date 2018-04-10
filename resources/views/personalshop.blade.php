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
                    <div class="col-md-4">
                        <h5 class="text-success">
                            <img src="img/seqiu.jpg" class="zhongleipic" />
                            <span class="picname"> 双色球</span> </h5>
                    </div>
                    <div class="col-md-8">
                        <div class="list-group">
                            <div class="list-group-item">
                                <span  class="text-info">第</span> <span class="label ">432423442</span>
                                <span class="text-info">期</span>
                                <p class="seqiuhaoma">
                                    <span class="haomanum">3</span>
                                    <span class="haomanum">3</span>
                                    <span class="haomanum">3</span>
                                    <span class="haomanum">3</span>
                                    <span class="haomanum">3</span>
                                    <span class="haomanum">3</span>
                                    <span class="haomanum blue">3</span>

                                </p>
                                <span class="text-info"> 下期开奖</span> <span class="label ">年月日</span>
                            </div>
                            <div class="list-group-item">
                                <a class=" btn  btn-success linkhemai">发起合买</a>
                                <a class="  btn btn-dark  linkhemai danmai">发起单买</a>
                            </div>
                        </div>
                    </div>
                    </div>
                <div class="header-row row">
                    <div class="col-md-4">
                        888844444444444444444
                    </div>
                    <div class="col-md-8">
                        3322322222222222222222
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
