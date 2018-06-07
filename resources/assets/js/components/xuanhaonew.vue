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

            <!--<div class="d-inline">-->
               <!--<label class="inputlabel">补充机选红球</label> <input class=" rednum" name="rednum" value=""/>个-->
               <!--<button class="btn btn-info onebeat" title="手选蓝球或者红球后，指定剩余球数目机选"-->
                        <!--@click="selectRedBuchong">红球机选补充</button>-->
                <!--<label class="inputlabel">补充机选蓝球</label><input class=" bluenum" name="bluenum" />个-->
                <!--<button class="btn btn-info onebeat" title="手选蓝球或者红球后，指定剩余球数目机选"-->
                        <!--@click="selectBlueBuchong">蓝球机选补充</button>-->
            <!--</div>-->
            <div class="d-inline macompute">
                <label class="inputlabel">机选红球数量</label>
                <input class="rednum" name="rednum" value="0" />个
                <label class="d-inline">机选蓝球数量</label>
                <input class="bluenum" name="bluenum" value="0">个
                <button class="btn btn-info btn-success" title="开始机选"  @click="machineSelect">开始机选</button>
                <button class="btn btn-info btn-success" title="重新选择"  @click="machineReset">重新选择</button>
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
                for(let i = 1;i<=33;i++) {
                    if(i%7 ==0)
                        $('div.ballholder').append('<div data-numhere="'+i +'" class="circlebai text-center cirlbai'+i +'" '+
                            '  ><span class="numnum"> '+i+'</span></div><br/>');
                    else
                        $('div.ballholder').append('<div data-numhere="'+i+'" class="circlebai  text-center cirlbai'+i+'" ' +
                            '  ><span class="numnum">'+i+'</span></div>');
                }
                for(let i = 1 ; i <=16; i++){
                    if(i%7 ==0)
                        $('div.blueholder').append('<div  data-numhere="'+i+'" class="circlebai text-center cirlbai'+i +'" '+
                            '  ><span class="numnumb numnum"> '+i+'</span></div><br/>');
                    else
                        $('div.blueholder').append('<div  data-numhere="'+i+'" class="circlebai text-center cirlbai'+i+'" ' +
                            '  ><span class="numnumb numnum">'+i+'</span></div>');
                }
            });



            console.log('gggggggg=' +Math.random());

        },
        data() {
            let  reds=[parseInt(Math.random()*33+1)]; //1-33的随机数
            //定义一个数组 用来装蓝色球的随机数
            let blues=[parseInt(Math.random()*16+1)]; //1-16的随机数
            let tempred = [];
            let tempblue = [];
            let tempall = [] ;
            let confirmedall = [] ;
            let confirmedred = [] ;
            let confirmedblue = [] ;
            let onebeatred = [] ;
            let fivebeatsred = [];
            let onebeatblue =[];
            let fivebeatsblue = [];
            return {
                'reds':reds,
                'blues':blues,
                'tempred':tempred,
                'tempblue':tempblue,
                'tempall':tempall,
                'confirmedall':confirmedall,
                'confirmedred':confirmedred,
                'confirmedblue':confirmedblue,
                'onebeatred':onebeatred,
                'onebeatblue':onebeatblue
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
                this.reds = [];
                this.blues =[];
                let onebeatred = $('span.valuehere').data('onebeatred')?$('span.valuehere').data('onebeatred'):[];
                let onebeatblue = $('span.valuehere').data('onebeatblue')?$('span.valuehere').data('onebeatblue'):[];
                console.log('lenth =',onebeatred.length);
                if(this.onebeatred.length >=5) {
                    alert('最多五注！');
                    return null;
                }
                    while(this.reds.length<6){  //双色球是6红1蓝，故长度小于6 说明会循环5次 因为前面reds已经有一次的默认值
                        let r=parseInt(Math.random()*33+1); //定义r 随机数的取值与reds一致 用于与reds作比较
                        if($.inArray(r,this.reds) === -1) {
                            this.reds.push(r);
                        }else {
                            // r=parseInt(Math.random()*33+1)
                        }
                    }



                $('div.ballholder div.circlebai').each(function (i,n) {
                    if($(this).hasClass('red')) {
                        $(this).click();
                    }
                });
                $('div.blueholder div.circlebai').each(function (i,n) {
                    if($(this).hasClass('blue')) {
                        $(this).click();
                    }
                });
                let b= parseInt(Math.random()*16+1);

                $('div.blueholder div.cirlbai'+b).click();
                this.onebeatblue.push(b);


                    for(let i =0 ;i < this.reds.length;i++) {
                        $('div.ballholder div.cirlbai' + this.reds[i]).click();
                    }
                //存储形式，存储于onebeatred,onebeatblue
                this.onebeatred.push([this.reds]);
                $('span.valuehere').data('onebeatred',this.onebeatred);
                $('span.valuehere').data('onebeatblue',this.onebeatblue);
                    console.log('onebeatred==='+ $('span.valuehere').data('onebeatred').length);
                    console.log('onebeatblue==='+ $('span.valuehere').data('onebeatblue'));
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
                this.$router.push('/confirm?type=five');

                }


                ,

            confirmSelect:function() {
                if($('span.valuehere').data('redman') === 'yes' &&
                $('span.valuehere').data('blueman') === 'yes') {
                    $(event.target).removeClass('btn-dark');
                    $(event.target).addClass('btn-success');
console.log('aaaaa','jilei15=',$.isEmptyObject( $('span.valuehere').data('jilei15')));
                    let redblue = $('span.valuehere').data('reds');
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
                        if(jilei15.length >=5) {
                            alert('您最多只能挑选五组号码');
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
                 *
                 */
               //重新编写代码逻辑，重头开始，

                if($(event.target ).hasClass('circlebai')) {
                    let rednum = parseInt($(event.target).data('numhere'));
                    if($.inArray(rednum,this.tempred) === -1) {
                        this.tempred.push(rednum);
                        console.log(this.tempred);
                    } else {
                        this.tempred.remove(rednum);
                    }
                    $(event.target).toggleClass('red');
                    $(event.target).find('span').toggleClass('white');
                }
                if($(event.target).hasClass('numnum')) {
                    let rednum = parseInt($(event.target).text());
                    if($.inArray(rednum,this.tempred) === -1) {
                        this.tempred.push(rednum);
                        console.log(this.tempred);
                    } else {
                        this.tempred.remove(rednum);
                    }
                    $(event.target).parent('div').toggleClass('red');
                    $(event.target).toggleClass('white');
                } //若点击对象为span


            },
            machineSelect:function() {
                let rednum = parseInt($('div.macompute input.rednum').val());
                let bluenum = parseInt($('div.macompute input.bluenum').val());
                let tempredsm = [];
                let tempbluesm = [];
                if(rednum >=33) {
                    alert('超出红球机选限额');
                    return null;
                }
                if(this.reds.length >=33|| this.tempred.length >=33) {
                    alert('机选红球已满，无法机选');
                    return null;
                } else {
                    while(tempredsm.length < rednum) {
                        let randomred = parseInt(Math.random()*33+1);
                        if($.inArray(randomred,this.tempred) === -1 && $.inArray(randomred,tempredsm)=== -1) {
                            tempredsm.push(randomred);
                        }
                        if((33 - rednum) < this.tempred.length) {
                            alert('超出红球限额');
                            break;

                        }
                    }

                }
                this.tempred = this.tempred.concat(tempredsm);
                for(let i =0;i<tempredsm.length;i++) {
                    $('div.ballholder div.cirlbai'+tempredsm[i]).toggleClass('red');
                    $('div.ballholder div.cirlbai'+tempredsm[i]+' span.numnum').toggleClass('white');
                }
                console.log(this.tempred);
                //机选蓝球逻辑
                if(bluenum >=16) {
                    alert('超出机选限额');
                    return null;
                }
                if(this.blues.length >=16|| this.tempblue.length >=16) {
                    alert('机选蓝球已满，无法机选');
                    return null;
                }  else {
                    while (tempbluesm.length < bluenum) {
                        let randomblue = parseInt(Math.random() * 16 + 1);
                        if ($.inArray(randomblue, this.tempblue) === -1 && $.inArray(randomblue, tempbluesm) === -1) {
                            tempbluesm.push(randomblue);
                        }
                        if ((16 - bluenum) < this.tempblue.length) {
                            alert('超出蓝球限额');
                            break;

                        }
                    }
                }
                this.tempblue = this.tempblue.concat(tempbluesm);
                for(let i =0;i<tempbluesm.length;i++) {
                    $('div.blueholder div.cirlbai'+tempbluesm[i]).toggleClass('blue');
                    $('div.blueholder div.cirlbai'+tempbluesm[i]+' span.numnum').toggleClass('white');
                }
                console.log("蓝球数组为",this.tempblue);
            },
            machineReset: function() {
                let red = this.tempred;
                let blue = this.tempblue;
                for(let i =0 ;i<red.length;i++) {
                    $('div.ballholder div.cirlbai'+red[i]).toggleClass('red');
                    $('div.ballholder div.cirlbai'+red[i]+' span.numnum').toggleClass('white');
                }
                for(let i =0 ;i <blue.length;i++) {
                    $('div.blueholder div.cirlbai'+blue[i]).toggleClass('blue');
                    $('div.blueholder div.cirlbai'+blue[i]+' span.numnum').toggleClass('white');
                }
                this.tempred = [];
                this.tempblue = [];
                $('div.macompute input.rednum').val(0);
                $('div.macompute input.bluenum').val(0);
            },
            changeSelectBlue:function () {
                let blueall = [];

                let ta = [];
                if($(event.target ).hasClass('circlebai')) {
                    let bluenum = parseInt($(event.target).find('span').text());
                    if($.inArray(bluenum,this.tempblue) === -1) {
                        this.tempblue.push(bluenum);

                    } else {
                        this.tempblue.remove(bluenum);
                    }
                    console.log('蓝球是：',this.tempblue);
                    $(event.target).toggleClass('blue');
                    $(event.target).find('span').toggleClass('white');
                }
                else if($(event.target).hasClass('numnum')) { //若点击对象为span
                    let bluenum = parseInt($(event.target).text());

                    if($.inArray(bluenum,this.tempblue) === -1) {
                        this.tempblue.push(bluenum);

                    } else {
                        this.tempblue.remove(bluenum);
                    }
                    console.log('蓝球是：',this.tempblue);
                    $(event.target).parent('div').toggleClass('blue');
                    $(event.target).toggleClass('white');
                }


                }







        }
    }
</script>

<style  scoped>
input.rednum,input.bluenum {
    width:25px;
}
</style>