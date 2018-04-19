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
            <button class="btn btn-info confirm btn-block btn-danger"
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
                console.log(' final   new blues ='+  $('span.valuehere').data('blues'));
            },
            selectRedBuchong: function () {
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

                  $('span.valuehere').data('reds',tempred);
                   console.log(' final   new reds ='+  $('span.valuehere').data('reds'));

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
                this.blues.push(b);

                    console.log(this.reds,b);
                    for(let i =0 ;i < this.reds.length;i++) {
                        $('div.ballholder div.cirlbai'+this.reds[i]).click();
                    }
                    $('span.valuehere').data('reds',this.reds) ;
                    $('span.valuehere').data('blues',this.blues) ;


                    console.log('spanblues==='+ $('span.valuehere').data('reds'));

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
                this.$router.push('/confirm');

                }


                ,

            confirmSelect:function() {
                this.$router.push('confirm',onComplete=>{
                    console.log('completeeeeeeeeeeee');
                },onAbort => {
                    console.log('aborttttttttttttt');
                });
                console.log('pusheeeeeeeeeeee')
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
                if($(event.target ).hasClass('circlebai')) {
                    $(event.target).toggleClass('red');
                    $(event.target).find('span').toggleClass('white');
                }
                if($(event.target).hasClass('numnum')) {
                    $(event.target).parent('div').toggleClass('red');
                    $(event.target).toggleClass('white');
                }
            },
            changeSelectBlue:function () {
                if($(event.target ).hasClass('circlebai')) {
                    $(event.target).toggleClass('blue');
                    $(event.target).find('span').toggleClass('white');
                }
                if($(event.target).hasClass('numnum')) {
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