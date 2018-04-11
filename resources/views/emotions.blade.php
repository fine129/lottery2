@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h2 class="alert  text-danger">
                     个人空间,每日心语
                    </h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="card-body"  >
                    <div class="alert-danger">{!! empty($errormsg)?'':$errormsg !!}</div>
                <div class="emotionpic justify-content-center">
                    <img src="img/xinyu.jpg" class="xinyujpg" />
                </div>
                <div class="list-group">
                    <div class="list-group-item">
                        <span class="xinyucontent">
                            发生了的咖啡机的萨芬离开家第三发多少范德萨了空间
                            发的f撒发了肯定撒即发生的发的撒垃圾
                        </span>
                        <span class="timepart">432432432432</span>
                    </div>
                    <div class="list-group-item">
                        <span class="xinyucontent">
                            发生了的咖啡机的萨芬离开家第三发多少范德萨了空间
                            发的f撒发了肯定撒即发生的发的撒垃圾
                        </span>
                        <span class="timepart">432432432432</span>
                    </div>
                    <div class="list-group-item">
                        <span class="xinyucontent">
                            发生了的咖啡机的萨芬离开家第三发多少范德萨了空间
                            发的f撒发了肯定撒即发生的发的撒垃圾
                        </span>
                        <span class="timepart">432432432432</span>
                    </div>
                    <div class="list-group-item">
                        <span class="xinyucontent">
                            发生了的咖啡机的萨芬离开家第三发多少范德萨了空间
                            发的f撒发了肯定撒即发生的发的撒垃圾
                        </span>
                        <span class="timepart">432432432432</span>
                    </div>
                    <div class="pager">3,33,3,33,3,3,3,,3,3,3</div>

                </div>
                </div>
                <div class="card-body"  >
                    <div class="alert-danger">{!! empty($errormsg)?'':$errormsg !!}</div>
                    <div class="emotionpic justify-content-center">
                        <img src="img/riji.jpg" class="xinyujpg" />
                    </div>
                    <div class="list-group">
                        <div class="list-group-item">
                            <a class="diarypart" title="请点击查看详细内容">发生了空间分散撒旦法， 阿斯蒂
                                芬， dfa撒旦，范德萨，法法师，......</a>
                        </div>
                        <div class="list-group-item">
                            <a class="diarypart" title="请点击查看详细内容">发生了空间分散撒旦法， 阿斯蒂
                                芬， dfa撒旦，范德萨，法法师，......</a>
                        </div>
                        <div class="list-group-item">
                            <a class="diarypart" title="请点击查看详细内容">发生了空间分散撒旦法， 阿斯蒂
                                芬， dfa撒旦，范德萨，法法师，......</a>
                        </div>
                        <div class="list-group-item">
                            <a class="diarypart" title="请点击查看详细内容">发生了空间分散撒旦法， 阿斯蒂
                                芬， dfa撒旦，范德萨，法法师，......</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-3 ">
            <div class="othercontent">
             <div class="list-group">
                 <div class="list-group-item">
                     <a class="mydream">我的中奖理想内容</a>
                 </div>
                 <div class="list-group-item">
                     <a class="mydream">困难</a>
                 </div>
                 <div class="list-group-item">
                     <a class="mydream">历史家乡</a>
                 </div>
                 <div class="list-group-item">
                     <a class="mydream">亲人朋友</a>
                 </div>
                 <div class="list-group-item">
                     <a class="mydream">用处打算计划</a>
                 </div>

             </div>

            </div>

        </div>
    </div>
</div>

@endsection
