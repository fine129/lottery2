<template>
    <div class="text-left">

        <h4 class="alert-info" >您的投注方案如下：</h4>
        <div class="list-group numhere" @click="changeBeishu" v-if="type === 'five'">

        </div>
        <div class="list-group fushigroup grouphere" @click="changeBeishu" v-if="type === 'fushi'">

        </div>
        <div class="list-group danshigroup grouphere" v-if="type === 'danshi'">

        </div>
        <div class="list-group-item danshinotice">
            <span class="noticesm">一张订单最多只能有五组单式号码</span>
            <button class="btn btn-outline-success oneagain"  @click="beatagain">再来一注</button>
        </div>


    </div>
</template>



<script>


    export default {
        name: "confirmHao",
        components: {   },
        created: function() {

        },
        props:['type'],
        mounted(){
            $(function () {
                // if(type == 'standard') {
                //     alert(999);
                // }
                // else { alert(1111)}
                let numhere = $('div.numhere');
                let allnum = $('span.valuehere').data('allnum');
                for(let i =0; i<allnum.length;i++) {
                   let rednum = allnum[i].slice(0,allnum[i].length - 1).sort(function (a,b) {
                       return a - b;
                   });
                   let bluenum = allnum[i].slice(allnum[i].length - 1,allnum[i].length - 0);
                   console.log('rednum===',rednum,'bluenum==',bluenum);
                    numhere.append(  '<div class="list-group-item beats">'+
                        '<label class=" label">第'+'<span class="imtitle">'+(i+1)+'</span>注</label>'+
                        '<div class="haonum">'+
                        rednum.join(', ') +
                        ', <span class="blueletter">'+bluenum  +'</span>' +
                            '<span class="glyphicon glyphicon-minus-sign minus icon-minus-sign" ' +
                        '"></span>' +
                        '<input type="text" name="beishu"  value=1   class="beishu" /> ' +
                        '<span class="glyphicon glyphicon-plus-sign plus icon-plus-sign" ' +
                        '"></span>'+
                       ' </div>'+
                       ' </div>')
                }
                console.log('allnum==',allnum);
                //填充第二个选择
                let redblue = $('span.valuehere').data('reds');
                let red = redblue.red;
                let blue = redblue.blue;
                $('div.danshinotice').hide();
                if(!red) {
                    return  null;
                }

                if( red.length>6 || blue.length >1) {
                    $('div.fushigroup').append('' +
                        '<div class="list-group-item">' +
                        '<label class="label">红复</label>' +
                        '<span class="redhere"> '+red.join(", ") +'</span>' +
                        '</div>' +
                        '<div class="list-group-item">' +
                        '<label class="label bluelabel">'+'蓝复'+ '</label> ' +
                        '<span class="bluehere">'+blue.join(", ")+'</span> ' +
                        '<span class="glyphicon glyphicon-minus-sign minus icon-minus-sign" ' +
                        '"></span>' +
                        '<input type="text" name="beishu"  value=1   class="beishufu" /> ' +
                        '<span class="glyphicon glyphicon-plus-sign plus icon-plus-sign" ' +
                        '"></span>'+
                        '</div> ')
                } else {
                    //积累单式五组号码

                    let all = $('span.valuehere').data('reds');
                    let red = all.red.join(', ');
                    let blue = all.blue.join(', ');
                    let jilei15 = $('span.valuehere').data('jilei15');
                    //处理A手选一注号码
                    if(jilei15 && jilei15.length >0) {
                        for(let i =0 ;i <jilei15.length ;i++) {
                            let rr = ''; let bb = '';
                            let rb = jilei15[i];
                            rr = rb.substr(0,5);
                            bb = rb.substr(5,6);

                            console.log('rr==',rr,'bb==',bb,'jilei15[i]==',jilei15[i],'jilei15==',jilei15);
                            $('div.danshigroup').append('' +
                                '<div class="list-group-item" >' +
                                '<label class="label smlabel">第<span class="smnum">'+i+1+'</span>注 </label>' +
                                '<span class="=redpart">'+rr+'</span> - <span class="bluepart">'+bb+'</span>' +
                                '<span class="glyphicon glyphicon-minus-sign minus icon-minus-sign" ' +
                                '"></span>' +
                                '<input type="text" name="beishu"  value=1   class="beishufu" /> ' +
                                '<span class="glyphicon glyphicon-plus-sign plus icon-plus-sign" ' +
                                '"></span>'+
                                '</div>' );
                        }

                    }

                    let num = $('div.danshigroup div.group-list-item').length ;
                    $('div.danshinotice').show();

                    if( num <=4 && num >=1){

                    }
                    if(jilei15.length >=5) {

                        $('button.oneagain').hide();
                    }
                    console.log('dansih,,,,,,,,,,,,,,,',red,blue,'jilei15.length==',jilei15.length);
                }
            });
         },
        data() {
            return {msg:'aaaaaa'}
        },

        methods: {
            beatagain: function () {
                $('span.valuehere').data('reds',{red:[],blue:[]});
                this.$router.push('/');
            },
            xuliehao: function() {
              $('div.numhere').find('div.beats').each(function (i,n) {
                  $(n).find('span.imtitle').text(i+1);
                  // console.log('i,n=',i,n);
              })
            },
            changeBeishu: function (event) {
                console.log(222);
                let tempval = $(event.target).siblings('input').val();
                let reg=/^[1-9]\d*$|^0$/;

                if(!reg.test(tempval) && $(event.target).hasClass('glyphicon')) {
                    alert("请输入整数!");
                    return null;
                }
                let val = parseInt($(event.target).siblings('input').val());

                if($(event.target).hasClass('minus')) {
                    if(val <=1) {
                        $(event.target).parents('div.beats').remove();
                        this.xuliehao();
                        if($('div.numhere').find('button.btn-addbeat').length < 1)
                        $('div.numhere').append('<button class="btn btn-success offset-6 ' +
                            'btn-addbeat" >增加一注</button>');
                        return null;
                    } else
                        $(event.target).siblings('input').val(val-1);
                } else if($(event.target).hasClass('plus')) {
                    $(event.target).siblings('input').val(val+1);
                }else if($(event.target).hasClass('btn-addbeat')) {
                    this.$router.go(-1);
                }

            }
        }
    }
</script>

<style  scoped>


</style>