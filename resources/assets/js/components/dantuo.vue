<template>
    <div class="text-center">

        <h4 class="alert-info">胆码区，选出一至五个您认为必出的号码</h4>
      <div class="ballholder danholder" @click="changeSelectDan">

      </div>
        <h4 class="alert-info">拖码区，选出至少二个您认为可能出的号码</h4>
        <div class="ballholder tuoholder waitdan" @click="changeSelectTuo">

        </div>
        <h4 class="alert-info">蓝球区，选出至少一个蓝球号码</h4>
        <div class="blueholder" @click="changeSelectBlue">

        </div>
        <div class="btn-block">
            <!--<button class="btn btn-info onebeat" @click="selectOnebeat">机选一注</button>-->
            <!--<button class="btn btn-info fivebeats" @click="selectFiveBeats">机选五注</button>-->

            <div class="d-inline">
               <label class="inputlabel">补充机选胆码红球</label>
                <input class=" dannum" name="dannum" value=""/>个
               <button class="btn btn-info danbeat" title="手选蓝球或者红球后，指定剩余球数目机选"
                        @click="selectDanBuchong">红球机选胆码补充</button>
                <label class="inputlabel">补充机选拖码红球</label>
                <input class=" tuonum" name="tuonum" value=""/>个
                <button class="btn btn-info tuobeat" title="手选蓝球或者红球后，指定剩余球数目机选"
                        @click="selectTuoBuchong">红球机选拖码补充</button>
                <label class="inputlabel">补充机选蓝球</label>
                <input class=" bluenum" name="bluenum" />个
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
        name: "dantuo",
        components: {},
        mounted() {
            $(function () {
                console.log('hhhhhhhhhhhhhhhhhhhhhhjjjjjjj');
                for (let i = 1; i <= 33; i++) {
                    if (i % 7 == 0)
                        $('div.ballholder').append('<div class="circlebai text-center cirlbai' + i + '" ' +
                            '  ><span class="numnum"> ' + i + '</span></div><br/>');
                    else
                        $('div.ballholder').append('<div class="circlebai text-center cirlbai' + i + '" ' +
                            '  ><span class="numnum">' + i + '</span></div>');
                }
                $('div.danholder').append('<br/><button class="btn btn-danger' +
                    ' confirmdan">确认使用</button> ');
                for (let i = 1; i <= 16; i++) {
                    if (i % 7 == 0)
                        $('div.blueholder').append('<div class="circlebai text-center cirlbai' + i + '" ' +
                            '  ><span class="numnumb numnum"> ' + i + '</span></div><br/>');
                    else
                        $('div.blueholder').append('<div class="circlebai text-center cirlbai' + i + '" ' +
                            '  ><span class="numnumb numnum">' + i + '</span></div>');
                }
            });
            console.log('wwwww=' + Math.random());

        },
        data() {
            let reds = [parseInt(Math.random() * 33 + 1)]; //1-33的随机数
            //定义一个数组 用来装蓝色球的随机数
            let blues = [parseInt(Math.random() * 16 + 1)]; //1-16的随机数
            return {
                'reds': reds,
                'blues': blues
            }
        },

        // props: {
        //     reds: this.reds ,
        //     blues:this.blues
        // },
        methods: {
            selectDanBuchong: function () {
                if ($('span.valuehere').data('danusedall') === 'yes') {
                    alert('您已经使用过胆码功能!');
                    return null;
                }
                let reg = /^[1-9]\d*$|^0$/;
                let tempred = [];
                let rednumin = $('input[name=dannum]').val().trim();
                let rednum = parseInt($('input[name=dannum]').val());
                if (rednumin === '' || !reg.test(rednumin) || rednum < 1 || rednum > 5) {
                    alert('请输入补充机选红球胆码数目大于等于一小于等于五');
                    return null;
                }
                for (let k = 1; k <= 33; k++) {
                    if ($('div.danholder div.cirlbai' + k).hasClass('red')) {
                        tempred.push(k);
                    }
                }

                if (tempred.length < 1 || tempred[0].constructor === Number) {
                    for (let i = 1; i <= rednum; i++) {
                        let r = parseInt(Math.random() * 33 + 1);
                        while ($.inArray(r, tempred) > -1) {
                            if (tempred.length < 5) {
                                r = parseInt(Math.random() * 33 + 1);
                            }
                            else if (tempred.length >= 5) {
                                break;
                            }
                        }
                        if (tempred.length < 5) {
                            tempred.push(r);
                            $('div.danholder div.cirlbai' + r).click();
                        } else if (i === rednum) {
                            alert('您已经达到红球胆码数目上限！');
                            return null;
                        }

                        console.log('new reds ===' + tempred);

                    }
                    // this.tempred.concat(temp);

                    $('span.valuehere').data('dannum', tempred);


                    console.log(' final   new dannum =' + $('span.valuehere').data('dannum'));

                }
            },
            selectTuoBuchong: function () {
                if ($('span.valuehere').data('danusedall') !== 'yes') {
                    alert('请先挑选使用胆码功能！');
                    return null;
                }
                let temptuo = [];
                let temptuonum = [];
                let temptuofinal = [];
                let tuotarget = [];
                let reg = /^[1-9]\d*$|^0$/;
                let tuonum = $('input.tuonum').val().trim();
                if (!reg.test(tuonum)) {
                    alert('请输入整数');
                    return null;
                }
                tuonum = parseInt(tuonum);
                let dannum = $('span.valuehere').data('dannum');
                for (let i = 1; i <= 33; i++) { //去除胆码红球号码
                    if ($.inArray(i, dannum) === -1) {
                        temptuo.push(i);
                    }
                }
                for (let i = 0; i < temptuo.length; i++) { // 获得点击后的拖码红球
                    if ($('div.tuoholder  div.cirlbai' + temptuo[i]).hasClass('red')) {
                        temptuonum.push(temptuo[i]);
                    }
                }
                for (let i = 0; i < temptuo.length; i++) { //去除选定点击的拖码红球号码
                    if ($.inArray(temptuo[i], temptuonum) === -1) {
                        temptuofinal.push(temptuo[i]);
                    }
                }
                console.log('去除胆码后红球号码 ====', temptuo, '被点击的红球号码', temptuonum,
                    '去除胆码和被点击红球号码后号码=', temptuofinal, '胆码==', dannum);
                if (tuonum > (33 - temptuofinal.length)) {
                    alert('您设定的机选拖码数量过多,请重新设定拖码数目');
                    console.log('222222tuonu===', tuonum, 'temptuofinal==', temptuofinal);
                    return null;
                }
                console.log('tuonu===', tuonum, 'temptuofinal==', temptuofinal);

                for (let i = 1; i <= tuonum; i++) { //机选拖码红球数目
                    let r = parseInt(Math.random() * 33 + 1);
                    while ($.inArray(r, temptuofinal) === -1 || $.inArray(r, tuotarget) > -1) {
                        r = parseInt(Math.random() * 33 + 1);
                        if (tuotarget.length >= tuonum) break;
                    }
                    if ($.inArray(r, tuotarget) === -1)
                        tuotarget.push(r);
                    else console.log('r=', r, 'in hongqiutuomu=', tuotarget);


                }
                console.log('jixuan hongqiu ====' + tuotarget);
                for (let i = 0; i < tuotarget.length; i++) {
                    $('div.tuoholder div.cirlbai' + tuotarget[i]).click();
                }
            },
            selectBlueBuchong: function () {
                let tempblue = [];
                let bluenum = parseInt($('input[name=bluenum]').val());
                let reg = /^[1-9]\d*$|^0$/;   // 注意：故意限制了 0321 这种格式，如不需要，直接reg=/^\d+$/;

                let bluenumin = $('input[name=bluenum]').val().trim();

                if (bluenumin === '' || !reg.test(bluenumin) || bluenum < 1) {
                    alert('请至少输入机选补充的蓝球数目大于等于1');
                }
                //处理蓝球逻辑
                for (let k = 1; k <= 16; k++) {
                    if ($('div.blueholder div.cirlbai' + k).hasClass('blue')) {
                        tempblue.push(k);
                    }
                }
                if (tempblue.length < 1 || tempblue[0].constructor === Number) {
                    for (let j = 1; j <= bluenum; j++) {
                        let m = parseInt(Math.random() * 16 + 1);
                        while ($.inArray(m, tempblue) > -1) {
                            if (tempblue.length < 16) {
                                m = parseInt(Math.random() * 16 + 1);
                            }
                            else if (tempblue.length >= 16) {
                                break;
                            }
                        }
                        if (tempblue.length < 16) {
                            tempblue.push(m);
                            $('div.blueholder div.cirlbai' + m).click();
                        } else if (j >= bluenum) {
                            alert('您已经达到蓝球数目上限！');
                        }

                        console.log('new blues ===' + tempblue);

                    }
                }
                $('span.valuehere').data('blues', tempblue);
                console.log(' final   new blues =' + $('span.valuehere').data('blues'));
            },
            changeSelectDan: function () {
                /**
                 * 点击胆球，首先是第一次点击，都是空白球，思路比较简单
                 * 第二次可能再次点击同一个球，取消点击，比较复杂。
                 * 第三次可能多次点击同一个球，更加复杂
                 *
                 * **/

                if ($(event.target).hasClass('confirmdan')) {  //胆球确认键
                    $('span.valuehere').data('danusedall', 'yes');
                    $('div.danholder').addClass('danusedall');
                    $('div.tuoholder').removeClass('waitdan');
                    return null;
                }
                if ($('span.valuehere').data('danusedall') === 'yes') { //是否使用过胆球功能
                    alert('您已经使用过胆码功能!');
                    return null;
                }
                let tempdan = $('span.valuehere').data('tempdan'); //获得tempdan数组
                if (tempdan.constructor !== Array) {
                    console.log('heeeeeeeee');
                    tempdan = [];
                    $('span.valuehere').data('tempdan', tempdan);
                }
                if (tempdan.length >= 5) {
                    if ($(event.target).hasClass('red') || $(event.target).find('span').hasClass('white') ||
                        $(event.target).parent('div').hasClass('red') || $(event.target).hasClass('white')
                    ) { //如果素组长度超过五个，再次点击已被点击过的球,这里不处理

                    } else {
                        alert('您最多只能选择五个胆码!');
                        return null;
                    }

                }
                let o = $('span.valuehere').data('danqiu')?$('span.valuehere').data('danqiu'):(new Array(40));
                //找出O.


                console.log('');
                if ($(event.target).hasClass('circlebai')) {  // 直接点击到div
                   let b = parseInt($(event.target).find('span.numnum').text());
                    if($(event.target).hasClass('red')) {
                        o[b] = 'yes'; //有色，属于第二次后
                    } else {
                        o[b] = 'no';//初次点击，无色开始。
                    }
                    $(event.target).toggleClass('red');
                    $(event.target).find('span').toggleClass('white');
                }
                if ($(event.target).hasClass('numnum')) {
                    let a = parseInt($(event.target).text());
                    if( $(event.target).hasClass('white')) {
                        o[a] = 'yes'; //同上
                    } else {
                        o[a] = 'no';
                    }
                    $(event.target).parent('div').toggleClass('red');
                    $(event.target).toggleClass('white');

                }




                    if ($(event.target).hasClass('red') || $(event.target).find('span').hasClass('white') ||
                        $(event.target).parent('div').hasClass('red') || $(event.target).hasClass('white')
                    ) { // 点击刚刚被点击变色的元素，第一次或者以后多次 o[b] = no

                        let a = parseInt($(event.target).text());
                        let b = parseInt($(event.target).find('span.numnum').text());//获得数字
                        if (a.constructor === Number) {
                            if ($.inArray(a, tempdan) === -1) //如果数字原来不存在 ，第一次或者以后多次2,刚刚被点击元素
                                tempdan.push(a);
                            // else {   //如果已经存在于数组中 二次点击，删除此元素--此段无用
                            //     let ta = [];
                            //     for (let i = 0; i < tempdan.length; i++) {
                            //         if (tempdan[i] !== a) {
                            //             ta.push(tempdan[i]);
                            //         }
                            //     }
                            //     tempdan = ta; //删除此元素
                            // }
                        } else if (b.constructor === Number) {
                            if ($.inArray(b, tempdan) === -1)

                                tempdan.push(b);
                            // else {
                            //     let ta = [];
                            //     for (let i = 0; i < tempdan.length; i++) {
                            //         if (tempdan[i] !== b) {
                            //             ta.push(tempdan[i]);
                            //         }
                            //     }
                            //     tempdan = ta;
                            // }
                        } else {
                            console.log('失败这次没找到');
                        }


                     // for(let i =0 ;i<tempdan.length; i++) {
                     //        o[tempdan[i]] = 'no';

                     // }
                        console.log('a=', a, 'b==', b, 'tempdan==', tempdan);
                    }
                    else { //,点击刚刚消色的元素 第二次或者以后多次o[a] = yes,或者空白元素
                        let a = parseInt($(event.target).text());
                        let b = parseInt($(event.target).find('span.numnum').text());
                        if(a.constructor === Number) {
                            o.splice(a,1);//从o中删除此元素
                            let ta = [];
                            for (let i = 0; i < tempdan.length; i++) {
                                if (tempdan[i] !== a) {
                                    ta.push(tempdan[i]);
                                }
                            }
                            tempdan = ta; //删除此元素
                            $('div.tuoholder div.cirlbai' + a).removeClass('danused')
                        }
                        if(b.constructor === Number) {
                            o.splice(b,1);
                            let ta = [];
                            for (let i = 0; i < tempdan.length; i++) {
                                if (tempdan[i] !== b) {
                                    ta.push(tempdan[i]);
                                }
                            }
                            tempdan = ta; //删除此元素
                            $('div.tuoholder div.cirlbai' + b).removeClass('danused')
                        }
                    }



                for (let i = 0; i < tempdan.length; i++) {
                    // if(o[tempdan[i]] === 'yes') {
                    //     $('div.tuoholder div.cirlbai' + tempdan[i]).removeClass('danused');
                    //     o[tempdan[i]] = 'no';
                    // }
                    // if(o[tempdan[i]] === 'no') {
                        $('div.tuoholder div.cirlbai' + tempdan[i]).addClass('danused');
                        //第一次或者以后多次添加此类
                        // o[tempdan[i]] = 'yes';
                    // }
                    // if ($('div.tuoholder div.cirlbai' + tempdan[i]).hasClass('danused')) {
                    //     if ($(event.target).hasClass('red') || $(event.target).find('span').hasClass('white') ||
                    //         $(event.target).parent('div').hasClass('red') || $(event.target).hasClass('white')) {
                    //         $('div.tuoholder div.cirlbai' + tempdan[i]).removeClass('danused');
                    //         console.log('remove,,target=', $(event.target).html(), 'tempdan[i]==', tempdan[i]);
                    //     }
                    // }
                    // else
                    //     $('div.tuoholder div.cirlbai' + tempdan[i]).addClass('danused');
                }

                $('span.valuehere').data('danqiu',o);



                $('span.valuehere').data('tempdan', tempdan);
                $('span.valuehere').data('dannum', tempdan);


                console.log('temp=', tempdan);
            } ,

        changeSelectTuo: function () {
            if ($('span.valuehere').data('danusedall') !== 'yes') {
                alert('请先挑选使用胆码功能！');
                return null;
            }
            if ($(event.target).hasClass('danused') || $(event.target).parent('div').hasClass('danused')) {
                alert('胆码已经使用此号');
                return null;
            }
            if ($(event.target).hasClass('circlebai')) {
                $(event.target).toggleClass('red');
                $(event.target).find('span').toggleClass('white');
            }
            if ($(event.target).hasClass('numnum')) {
                $(event.target).parent('div').toggleClass('red');
                $(event.target).toggleClass('white');
            }
        },
        changeSelectBlue: function () {
            if ($(event.target).hasClass('circlebai')) {
                $(event.target).toggleClass('blue');
                $(event.target).find('span').toggleClass('white');
            }
            if ($(event.target).hasClass('numnum')) {
                $(event.target).parent('div').toggleClass('blue');
                $(event.target).toggleClass('white');
            }
        },
        handleUploaded(resp) {
            this.userAvatar = resp.relative_url;
        },


        confirmSelect: function () {
            this.$router.push('confirm', onComplete => {
                console.log('completeeeeeeeeeeee');
            }, onAbort => {
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

        }
    }

    }
</script>

<style  scoped>
input.rednum,input[name=bluenum] ,input.dannum,input.tuonum{
    width:30px ;
    height:30px;
}
</style>