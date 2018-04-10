@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="alert  text-danger">
                        请仔细填写店主信息以便彩友查询
                    </h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="card-body"  >
                    <div class="alert-danger">{!! empty($errormsg)?'':$errormsg !!}</div>
                    <form action="{!! url('postshop') !!}" method="post" class="shopform">
                        <div class="form-control ">
                            <label class="label">请输入您的姓名</label>
                            <input type="text" name="realname" class="d-inline" />

                            <label class="custom-control-label" for="address">请输入您的彩店地址</label>
                            <textarea type="text" name="address" class="inlinearea" ></textarea>
                        </div>

                        <div class="form-control ">
                            <label class="label">请输入您微信号码</label>
                            <input type="text" name="wechatnum" class="d-inline" />

                            <label class="custom-control-label" for="address">请输入您的彩店电话</label>
                            <input type="text" name="mobiletel" class="d-inline"  />
                        </div>
                        <div class="form-control ">
                            <label class="label">请输入您的QQ号码</label>
                            <input type="text" name="qqnum" class="d-inline" />
                        </div>
                       <div class="form-control">
                            <label class="custom-control-label" for="address">请上传您的头像照片</label>
                           <div class="row margin-bottom-40">
                               <div class=" col-md-3">
                                   <div id="cropContainerEyecandy"></div>
                               </div>
                           </div>
                        </div>
                        <div class="form-control">
                            <label class="custom-control-label" for="shopbigarea">请选择您的业务类型</label>
                            <select class="d-inline" name="shopbigarea" title="shopbigarea">
                                <option value="福彩">福彩</option>
                                <option value="体彩">体彩</option>
                                <option value="福彩体彩">福彩体彩都有</option>
                            </select>
                        </div>
                        <div class="form-control">
                            <label class="custom-control-label" for="shopsmallarea">请填写您的详细业务类型</label>
                            <textarea class="d-inline" name="shopsmallarea" type="text" title="shopsmallarea"></textarea>
                        </div>
                        <div class="form-control">

                            <label class="custom-control-label" for="shophistory">请填写您的店铺的历史成
                                绩，请尽量全面些</label>
                            <textarea class="d-inline" name="shophistory" type="text" title="shophistory"></textarea>
                        </div>
                        <div class="btn-block">
                            <button class="btn btn-success form-control" type="submit">提交信息</button>
                        </div>
                        {!! csrf_field() !!}
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
