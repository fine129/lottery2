<template>
    <div class="text-center">

        <h4 class="alert-info">红球区，请至少选择6个红球</h4>
      <div class="ballholder" @click="changeSelect">

      </div>
        <h4 class="alert-info">蓝球区，请至少选择1个蓝球</h4>
        <div class="blueholder" @click="changeSelectBlue">

        </div>
        <div class="btn-block">
            <button class="btn btn-info onebeat" @click="selectOnebeat">机选一注</button>
            <button class="btn btn-info fivebeats" @click="selectFiveBeats">机选五注</button>

            <div class="d-inline">
               <label class="inputlabel">补充机选红球</label> <input class=" rednum" name="rednum" value=""/>个
               <button class="btn btn-info onebeat" title="手选蓝球或者红球后，指定剩余球数目机选"
                        @click="selectRedBuchong">红球机选补充</button>
                <label class="inputlabel">补充机选蓝球</label><input class=" bluenum" name="bluenum" />个
                <button class="btn btn-info onebeat" title="手选蓝球或者红球后，指定剩余球数目机选"
                        @click="selectBlueBuchong">蓝球机选补充</button>
            </div>
            <button class="btn btn-info confirm btn-block btn-dark"
                    @click="confirmSelect"
            >确认选择</button>

        </div>

    </div>
</template>



<script>

    export default {
        name: "xuanhao",
        components: {   },
        mounted(){
            $(function () {
                $('span.valuehere').data('tempdan',null);
                $('span.valuehere').data('temptuo',null);
                $('span.valuehere').data('tempblue',null);

                for(let i = 1;i<=33;i++) {
                    if(i%7 ==0)
                        $('div.ballholder').append('<div class="circlebai text-center cirlbai'+i +'" '+
                            '  ><span class="numnum"> '+i+'</span></div><br/>');
                    else
                        $('div.ballholder').append('<div class="circlebai text-center cirlbai'+i+'" ' +
                            '  ><span class="numnum">'+i+'</span></div>');
                }
                for(let i = 1 ; i <=16; i++){
                    if(i%7 ==0)
                        $('div.blueholder').append('<div class="circlebai text-center cirlbai'+i +'" '+
                            '  ><span class="numnumb numnum"> '+i+'</span></div><br/>');
                    else
                        $('div.blueholder').append('<div class="circlebai text-center cirlbai'+i+'" ' +
                            '  ><span class="numnumb numnum">'+i+'</span></div>');
                }
            });



            console.log('gggggggg=' +Math.random());

        },
        data() {
            let  reds=[parseInt(Math.random()*33+1)]; //1-33的随机数
            //定义一个数组 用来装蓝色球的随机数
            let blues=[parseInt(Math.random()*16+1)]; //1-16的随机数
            return {
                'reds':reds,
                'blues':blues
            }
        },

        // props: {
        //     reds: this.reds ,
        //     blues:this.blues
        // },
        methods: {
            selectBlueBuchong: function() {
                let redall = [];
                if(!$('span.valuehere').data('reds')) {
                    $('span.valuehere').data('reds',{red:[],blue:[]});
                    let tempall = $('span.valuehere').data('reds');
                    redall = [];
                    console.log('hhereee');
                } else {
                    let tempall = $('span.valuehere').data('reds');
                    redall = tempall.red;
                    console.log('there');

                }
                let tempblue = [];
                let bluenum = parseInt($('input[name=bluenum]').val());
                let reg=/^[1-9]\d*$|^0$/;   // 注意：故意限制了 0321 这种格式，如不需要，直接reg=/^\d+$/;

                let bluenumin = $('input[name=bluenum]').val().trim();

                if(bluenumin === ''||!reg.test(bluenumin)|| bluenum < 1) {
                    alert('请至少输入机选补充的蓝球数目大于等于1');
                }
                //处理蓝球逻辑
                for(let k=1;k <=16 ; k++) {
                    if(  $('div.blueholder div.cirlbai'+k).hasClass('blue')) {
                        tempblue.push(k);
                    }
                }
                if(   tempblue.length <1 ||tempblue[0].constructor === Number ) {
                    for(let j =1 ; j<= bluenum; j++) {
                        let m=parseInt(Math.random()*16+1);
                        while ($.inArray(m,tempblue) > -1  ){
                            if( tempblue.length < 16) {
                                m = parseInt(Math.random()*16+1);
                            }
                            else if(tempblue.length >= 16) {
                                break;
                            }
                        }
                        if( tempblue.length < 16) {
                            tempblue.push(m);
                            $('div.blueholder div.cirlbai'+m).click();
                        } else if(j >= bluenum){
                            alert('您已经达到蓝球数目上限！');
                        }

                        console.log('new blues ==='+ tempblue);

                    }
                }
                $('span.valuehere').data('blues',tempblue);
                $('span.valuehere').data('reds').blue=tempblue;
                console.log(' final   new blues ='+  $('span.valuehere').data('reds').blue);
            },
            selectRedBuchong: function () {
                let redall = [];
                if(!$('span.valuehere').data('reds')) {
                    $('span.valuehere').data('reds',{red:[],blue:[]});
                    let tempall = $('span.valuehere').data('reds');
                    redall = [];
                    console.log('hhereee');
                } else {
                    let tempall = $('span.valuehere').data('reds');
                    redall = tempall.red;
                    console.log('there');

                }
               let re = this.reds;
               let bl = this.blues;
               let temp = [];
               let tempred =[];
               let tempblue = [];
               let reg=/^[1-9]\d*$|^0$/;   // 注意：故意限制了 0321 这种格式，如不需要，直接reg=/^\d+$/;

                let rednumin = $('input[name=rednum]').val().trim();
              let rednum = parseInt($('input[name=rednum]').val());
              let bluenum = parseInt($('input[name=bluenum]').val());
            if(rednumin === ''||!reg.test(rednumin)|| rednum < 1) {
                alert('请输入补充机选红球数目大于等于1');
                return null;
            }
              for(let k=1;k <=33 ; k++) {
                  if(  $('div.ballholder div.cirlbai'+k).hasClass('red')) {
                      tempred.push(k);
                  }
              }
               if(   tempred.length <1 ||tempred[0].constructor === Number ) {
                  for(let i =1 ; i<= rednum; i++) {
                     let r=parseInt(Math.random()*33+1);
                      while ($.inArray(r,tempred) > -1  ){
                          if( tempred.length < 33) {
                              r = parseInt(Math.random()*33+1);
                          }
                          else if(tempred.length >= 33) {
                              break;
                          }
                      }
                      if( tempred.length < 33) {
                          tempred.push(r);
                          $('div.ballholder div.cirlbai'+r).click();
                      } else if(i === rednum){
                          alert('您已经达到红球数目上限！');
                      }

                      console.log('new reds ==='+ tempred);

                  }
                  // this.tempred.concat(temp);

                  $('span.valuehere').data('reds',{red:tempred,blue:[]});
                   console.log(' final   new reds ='+  $('span.valuehere').data('reds').red);

               }
               else {


               }
            },
            handleUploaded(resp) {
                this.userAvatar = resp.relative_url;
            },
            selectOnebeat:function() {
                //定义一个数组 用来装红色球的随机数
                // let  reds=[parseInt(Math.random()*33+1)]; //1-33的随机数
                // //定义一个数组 用来装蓝色球的随机数
                // let blues=[parseInt(Math.random()*16+1)]; //1-16的随机数
                this.reds = [parseInt(Math.random()*33+1)];
                this.blues =[];

                while(this.reds.length<6){  //双色球是6红1蓝，故长度小于6 说明会循环5次 因为前面reds已经有一次的默认值
                    let r=parseInt(Math.random()*33+1); //定义r 随机数的取值与reds一致 用于与reds作比较
                    for (let i = 0; i < this.reds.length; i++) {
                        if (this.reds[i] === r) {    //若 reds中的随机值与r中的相等，则跳出，继续i++取值
                            break;        //若reds中的随机值与r中的不相等，则进入else if
                        } else if (i === this.reds.length - 1) { //reds.length-1 --> 原先的reds.length为5，减1为4，而数组是从0 开始算，所以这里会循环5次，刚好与 reds.length<6 同步；且 i等于reds.length-1，是让随机数循环5次（另外就是让它找到定义中的最后一位数）
                            this.reds.push(r);        //将r中的值添加到reds中  push()：向数组中添加元素
//值得注意是！r与reds作比较时，是以reds中现有的数作比较，因为 reds.push(r); 这句代码已经向reds中添加了数值，所以r不是以reds中自身产生的随机数作比较，而是原先r添加到reds中的值作比较
                            }
                        }
                    }
                let jilei15 =[];
                if(  !$('span.valuehere').data('jilei15')) { //如果为空

                }else {
                    jilei15 = $('span.valuehere').data('jilei15');
                }
                console.log('jilei15 onebeat=====',jilei15)
                if(jilei15.length >=5) {
                    alert('最多只能有五组单选号码！');
                    return null;
                }

                $('div.ballholder div.circlebai').each(function (i,n) {
                    if($(this).hasClass('red')) {
                        $(this).toggleClass('red');
                        $(this).find('span').toggleClass('white');
                        // $(this).click();
                    }
                });
                $('div.blueholder div.circlebai').each(function (i,n) {
                    if($(this).hasClass('blue')) {
                        // $(this).click();
                        $(this).toggleClass('blue');
                        $(this).find('span').toggleClass('white');
                    }
                });
                let b= parseInt(Math.random()*16+1);

                $('div.blueholder div.cirlbai'+b).toggleClass('blue');
                $('div.blueholder div.cirlbai'+b).find('span').toggleClass('white');

                this.blues.push(b);

                    console.log(this.reds,b);
                    for(let i =0 ;i < this.reds.length;i++) {
                        // $('div.ballholder div.cirlbai'+this.reds[i]).click();
                        $('div.ballholder div.cirlbai'+this.reds[i]).toggleClass('red');
                        $('div.ballholder div.cirlbai'+this.reds[i]).find('span').toggleClass('white');
                    }
                    if($('div.ballholder div.red').length>=6 && $('div.blueholder div.blue').length >=1) {
                        $('button.confirm').removeClass('btn-dark');
                        $('button.confirm').addClass('btn-btnsuccess');
                        $('span.valuehere').data('redman','yes');
                        $('span.valuehere').data('blueman','yes');


                    }
                    $('span.valuehere').data('reds',{red:this.reds,blue:this.blues}) ; //用reds存储所有红球蓝球号码
                //存储形式，类似五组号码那样
                let andrb = this.reds.concat(this.blues);
                // let jilei15 =[];
                // if(  !$('span.valuehere').data('jilei15')) { //如果为空
                //
                // }else {
                //      jilei15 = $('span.valuehere').data('jilei15');
                // }
                // if(jilei15.length >=5) {
                //     alert('最多只能有五组单选号码！');
                //     return null;
                // }
                $('span.valuehere').data('andrb',andrb);
                // jilei15.push(andrb);
                $('span.valuehere').data('blues',this.blues) ;
                    $('span.valuehere').data('jilei15',jilei15) ;

                // let t = {a:[3,4,3,2,3,4],blue:[3,3,3,3,3]};
                    console.log('spanblues==='+ $('span.valuehere').data('reds').red,
                        $('span.valuehere').data('reds').blue,'合并后是数组==:',andrb,'积累数组是:',jilei15);

                },
            selectFiveBeats: function() {
             let temptarblue = [parseInt(Math.random()*16+1)];
                let redall = [];
                for(let i = 0; i < 5 ; i++) {
                    let temptarred = [parseInt(Math.random()*33+1)];
                    while(temptarred.length < 6) {
                        let r=parseInt(Math.random()*33+1); //定义r 随机数的取值与reds一致 用于与reds作比较
                        for(let j =0 ; j< temptarred.length; j++) {
                            if(temptarred[j] === r) {
                                break;
                            } else if(j === temptarred.length -1 ){
                                temptarred.push(r);
                            }
                        }

                    }
                    let ab= parseInt(Math.random()*16+1);
                    while(temptarblue.length <=5 ) {
                        if($.inArray(ab,temptarblue) > -1) {
                            ab= parseInt(Math.random()*16+1)
                        } else {

                                temptarblue.push(ab);
                                temptarred.push(ab);
                                break;
                            }
                        }

                    console.log('加入的红球组合',temptarred,'蓝球是',ab);
                    redall.push(temptarred);

                    }
                console.log('final 五组号码为：',redall);
                $('span.valuehere').data('allnum',redall) ;
                $('span.valuehere').data('jilei15',redall) ;

                this.$router.push('/confirm?type=five',onComplete=>{
                    console.log('completeeeeeeeeeeee');
                    // $('div.danshinotice').hide();
                    $('button.oneagain').hide();
                },onAbort => {
                    console.log('aborttttttttttttt');
                });

                }


                ,

            confirmSelect:function() {
                if($('span.valuehere').data('redman') === 'yes' &&
                $('span.valuehere').data('blueman') === 'yes' && !$('button.confirm').hasClass('btn-dark')) {
                    $(event.target).removeClass('btn-dark');
                    $(event.target).addClass('btn-success');
console.log('aaaaa','jilei15=',$.isEmptyObject( $('span.valuehere').data('jilei15')));
                    let redblue = $('span.valuehere').data('reds');
                    let jilei15 = $('span.valuehere').data('jilei15');
                    let temp = $('span.valuehere').data('temp');
                    if(!$.isEmptyObject(temp)) {
                        jilei15.push( temp);
                        $('span.valuehere').data('temp',null);
                        $('span.valuehere').data('jilei15',jilei15);
                    }
                    else {
                        let andrb = $('span.valuehere').data('andrb');
                        // jilei15.splice(jilei15.length-1,1,andrb);
                        jilei15.push(andrb);
                        // $('span.valuehere').data('andrb',undefined);
                    }
                    if(redblue.red.length >6 || redblue.blue.length >1) {
                        this.$router.push('confirm?type=fushi',onComplete=>{
                            console.log('completeeeeeeeeeeee');
                        },onAbort => {
                            console.log('aborttttttttttttt');
                        });
                    } else if(redblue.red.length === 6 && redblue.blue.length === 1) {
                        //开始添加到共计五组列表
                        console.log('if heee');
                        let jilei15 =$('span.valuehere').data('jilei15');
                        if(jilei15.length >5) {
                            // alert('您最多只能挑选五组号码');
                            return null;
                        }
                        if( $.isEmptyObject( $('span.valuehere').data('jilei15')))  {
                            $('span.valuehere').data('jilei15',jilei15);
                            alert('请选择确认红球蓝球数量');
                            return null;
                        } else {
                           //处理确认手选一注逻辑
                           //  jilei15.push(redblue.red.concat(redblue.blue));
                           //  $('span.valuehere').data('jilei15',jilei15);
                           //  console.log('jilei15',jilei15);
                           //  let el = redblue.red.concat(redblue.blue);
                           //  jilei15[jilei15.length] = el;
                           //  $('span.valuehere').data('jilei15',jilei15);
                            this.$router.push('confirm?type=danshi');
                        }
                      }
                    else {
                        this.$router.push('confirm?type=danshi',onComplete=>{
                            console.log('completeeeeeeeeeeee');
                        },onAbort => {
                            console.log('aborttttttttttttt');
                        });
                    }
                } else {
                    alert('请选择符合数量要求的红球蓝球');
                    return null;
                }


// 带查询参数，变成 /register?plan=private
                    // axios.post('/api/confirmhao', {
                    //     'red':this.reds,
                    //     'blue':this.blues
                    // }).then(function(response){
                    //     // this.followed = response.data.followed;
                    //     console.log('====='+response);
                    // })

            },
            changeSelect: function() {
                /**
                 * 第一种情况，直接手选一注，然后确认，等待下一注。A,
                 * 第二种情况，直接手选加机选补充，然后确认，等待下一注B,
                 * 第三种情况，直接机选一注，然后手选修改，完善，补充，然后确认，等待下一注C,
                 * 第四种情况,直接机选补充几个红球，蓝球，然后手动修改，完善，然后确认，等待下一注。D,
                 * 上述情况都归结为jilei15,等待下一注
                 * @type {Array}
                 * jilei15需要改变
                 */
               //重新编写代码逻辑，重头开始，
               let redall = [];
                let tempall;

               //还是建立存储红球蓝球集体的逻辑
              // if($.isEmptyObject($('span.valuehere').data('reds'))) {
              if($.isEmptyObject($('span.valuehere').data('reds'))) {
                    $('span.valuehere').data('reds',{red:[],blue:[]});
                     tempall = $('span.valuehere').data('reds');

                } else { //开始返回后第二次手选号码
                    // $('span.valuehere').data('reds',{red:[],blue:[]});
                    let tempall = $('span.valuehere').data('reds');
                     redall = tempall.red;
                    console.log('there');

                }
                // 如果是第二次增加手选单式球
                // let jilei15 = new Array(new Array);
                // if($('span.valuehere').data('jilei15').length>0) {
                //     jilei15 = $('span.valuehere').data('jilei15');
                //     let redall = jilei15[jilei15.length -1].splice(6,1);//删除最新一组号码蓝球号码
                //     let blueall = jilei15[jilei15.length -1].splice(0,5);//删除红球号码
                //     let tempall ={red:redall,blue:blueall};
                //
                // }
                if($(event.target ).hasClass('circlebai')) {
                    if($(event.target).hasClass('red')) {//若此球被点击前有色,删除此号码
                        let rednum = parseInt($(event.target).find('span').text());
                        let ta = [];
                       for(let i =0 ;i <redall.length ; i++) {
                           if(redall[i] !== rednum) {
                               ta.push(redall[i]);
                           }
                       }
                        $('span.valuehere').data('reds').red = ta;
                    }else  { //被点击前无色 添加此号码
                        let rednum = parseInt($(event.target).find('span').text());
                        $('span.valuehere').data('reds').red.push(rednum);
                    }
                    $(event.target).toggleClass('red');
                    $(event.target).find('span').toggleClass('white');

                }
                if($(event.target).hasClass('numnum')) {
                    if($(event.target).hasClass('white')) {
                        let rednum = parseInt($(event.target).text());
                        let ta = [];
                        for(let i =0 ;i <redall.length ; i++) {
                            if(redall[i] !== rednum) {
                                ta.push(redall[i]);
                            }
                        }
                        $('span.valuehere').data('reds').red = ta;
                    } else {
                        let rednum = parseInt($(event.target).text());
                        $('span.valuehere').data('reds').red.push(rednum);
                    }
                    $(event.target).parent('div').toggleClass('red');
                    $(event.target).toggleClass('white');
                }
                //开始A手选红球一注逻辑不断增加jilei15数组内容，形成[Array(7),Array(7),...]这样
                let rednow = [];
                let bluenow = [];

                let rbnow = [];
                if( $.isEmptyObject($('span.valuehere').data('jilei15'))) { //如果jilei15为空,充值

                     rednow = $('span.valuehere').data('reds').red;
                     bluenow = $('span.valuehere').data('reds').blue;
                    let jilei15 = [];
                    jilei15.push( rednow.concat(bluenow));
                    $('span.valuehere').data('jilei15',jilei15);
                    console.log('diyici jilei15===',jilei15);
                } else { //否则是第二次开始添加字符串数组
                    let jilei15 =  $('span.valuehere').data('jilei15');
                    //删除一次点击过jilei15最后一项

                    rednow = $('span.valuehere').data('reds').red;
                    bluenow = $('span.valuehere').data('reds').blue;
                   let temp = rednow.concat(bluenow);
                    $('span.valuehere').data('temp',temp);
                   //判断是否在二维数组里 jilei15类似这个['1,2,3,4','5,5,5,5']
                    //判断是否调整红球



                        console.log('enough!=='+jilei15);


                    // for(let i=0;i<jilei15.length ; i++) {
                    //     if(i ===( jilei15.length -1))
                    //     jilei15[i] = rednow.concat(bluenow);
                    // }
                    // jilei15.push( rednow.concat(bluenow));
                    // $('span.valuehere').data('jilei15',jilei15);
                    console.log('jilei15原始=',jilei15);
                    console.log('data.reds==',$('span.valuehere').data('reds'),'jilei15==',jilei15);

                }

                if( $('span.valuehere').data('reds').red.length <6) { //不够数量，继续选择
                    console.log('不够数量，继续选择');
                    $('span.valuehere').data('redman','not');
                    $('button.confirm').removeClass('btn-success');
                    $('button.confirm').addClass('btn-dark');
                      rednow = $('span.valuehere').data('reds').red;
                } else if( $('span.valuehere').data('reds').red.length === 6) { //达到数量，可以蓝球一起确认选择
                    $('span.valuehere').data('redman','yes');
                      rednow = $('span.valuehere').data('reds').red;
                    console.log('change select jilei15==',$('span.valuehere').data('jilei15'),'rednow=',rednow,'bluenow=',bluenow,'rbnow==',rbnow);
                }else{  //达到数量，可以确认复式号码
                    $('span.valuehere').data('redman','yes');
                      rednow = $('span.valuehere').data('reds').red;
                }
                if($('span.valuehere').data('redman') === 'yes' &&
                    $('span.valuehere').data('blueman') === 'yes') {
                    $('button.confirm').removeClass('btn-dark');
                    $('button.confirm').addClass('btn-success');
                    let jilei15 = new Array(new Array);
                    if($.isEmptyObject($('span.valuehere').data('jilei15'))) {
                         jilei15= new Array(new Array);
                    } else {
                         jilei15 = $('span.valuehere').data('jilei15');
                    }
                     // jilei15[jilei15.length] = rednow.concat(bluenow);
                     //    $('span.valuehere').data('jilei15', jilei15);

                }

                console.log('红球数组变为:',$('span.valuehere').data('reds').red);
            },
            changeSelectBlue:function () {
                let blueall = [];
                if(!$('span.valuehere').data('reds')) { //判断是否有reds值
                    $('span.valuehere').data('reds',{red:[],blue:[]});
                    let tempall = $('span.valuehere').data('reds');
                     blueall = [];
                } else {
                    let tempall = $('span.valuehere').data('reds');
                     blueall = tempall.blue;
                }
                let ta = [];
                if($(event.target ).hasClass('circlebai')) {
                    let bluenum = parseInt($(event.target).find('span').text());
                    if($(event.target).hasClass('blue')) { //点击div对象，删除blue号码

                        for(let i =0; i < blueall.length; i++) {
                            if(bluenum !== blueall[i]) {
                                ta.push(blueall[i]);
                            }
                        }
                        blueall = ta;
                        $('span.valuehere').data('reds').blue = blueall;

                    } else {//点击div对象，增加blue号码
                        $('span.valuehere').data('reds').blue.push(bluenum);
                    }
                    $(event.target).toggleClass('blue');
                    $(event.target).find('span').toggleClass('white');
                }
                if($(event.target).hasClass('numnum')) { //若点击对象为span
                    let bluenum = parseInt($(event.target).text());
                    if($(event.target).hasClass('white')) {

                        for(let i = 0 ;i<blueall.length;i++) {
                            if(bluenum !== blueall[i]) {
                                ta.push(blueall[i]);
                            }
                        }
                        blueall = ta;
                        $('span.valuehere').data('reds').blue = blueall;
                    } else {
                        let bluenum = parseInt($(event.target).text());
                        $('span.valuehere').data('reds').blue.push(bluenum);
                    }
                    // $('span.valuehere').data('reds').blue =ta;
                    $(event.target).parent('div').toggleClass('blue');
                    $(event.target).toggleClass('white');
                }
                //开始手选蓝球一注逻辑 A
                let jilei15 = [];
                let rednow =[];
                let bluenow = [];
                if( $.isEmptyObject( $('span.valuehere').data('jilei15'))) { //若为空
                    rednow = $('span.valuehere').data('reds').red;
                    bluenow = $('span.valuehere').data('reds').blue;
                    jilei15 = [] ;
                    jilei15.push(rednow.concat(bluenow));
                    $('span.valuehere').data('jilei15',jilei15);


                } else {
                    rednow = $('span.valuehere').data('reds').red;
                    bluenow = $('span.valuehere').data('reds').blue;
                    jilei15 = $('span.valuehere').data('jilei15');
                    let temp = rednow.concat(bluenow);
                    $('span.valuehere').data('temp',temp);
                    //判断是否在数组里 jilei15类似这个['1,2,3,4','5,5,5,5']
                    if(jilei15[jilei15.length -1]&& jilei15[jilei15.length -1].length <=7) {
                        jilei15[jilei15.length -1] = temp;
                    } else {
                        console.log('enough! in blue '+jilei15[jilei15.length -1]);
                    }
                    $('span.valuehere').data('jilei15',jilei15);
                    }

                if($('span.valuehere').data('reds').blue.length <1) { //蓝球不够
                    $('span.valuehere').data('blueman', 'not');
                    $('button.confirm').removeClass('btn-success');
                    $('button.confirm').addClass('btn-dark');
                }
                    else if($('span.valuehere').data('reds').blue.length >=1) {
                        $('span.valuehere').data('blueman','yes');


                    }else {
                    $('span.valuehere').data('blueman', 'not')
                    $('button.confirm').removeClass('btn-success');
                    $('button.confirm').addClass('btn-dark');
                }
                if($('span.valuehere').data('redman') === 'yes' &&
                    $('span.valuehere').data('blueman') === 'yes') {
                    $('button.confirm').removeClass('btn-dark');
                    $('button.confirm').addClass('btn-success');
                    console.log('heeeeeeedd');
                }
                console.log('jilei15==',jilei15,'蓝球数组变为:',$('span.valuehere').data('reds').blue,'整体变为==',
                $('span.valuehere').data('reds'),'redman=',$('span.valuehere').data('redman'),'blueman=',$('span.valuehere').data('blueman'));

            }
        }
    }
</script>

<style  scoped>
input.rednum,input.bluenum {
    width:25px;
}
</style>