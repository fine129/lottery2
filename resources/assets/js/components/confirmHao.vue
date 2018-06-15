<template>
    <div class="text-left">

        <h4 class="alert-info" >您的投注方案如下：</h4>
        <div class="list-group numhere" @click="changeBeishu" v-if="type === 'five'">

        </div>
        <div class="list-group fushigroup grouphere" @click="changeBeishu" v-if="type === 'fushi'">

        </div>
        <div class="list-group danshigroup grouphere"  @click="changeBeishu" v-if="type === 'danshi'">

        </div>
        <div class="list-group dantuogroup grouphere"  @click="changeBeishu" v-if="type === 'dantuo'">

        </div>
        <div class="testaxios">
            <button class="btn btn-success" @click="senddata">确认支付</button>
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
                    if(allnum[i].length <8) {
                        allnum[i].push(1);
                    }
                    $('span.valuehere').data('allnum',allnum);
                   let rednum = allnum[i].slice(0,allnum[i].length - 2).map(Number).sort(function (a,b) {
                       return a - b;

                   });
                   let bluenum = allnum[i].slice(allnum[i].length - 2,allnum[i].length - 1);
                   let beishu = allnum[i][allnum[i].length-1];
                   console.log('rednum===',rednum,'bluenum==',bluenum);
                    numhere.append(  '<div class="list-group-item beats">'+
                        '<label class="smlabel label" data-valarr="'+allnum[i]+'"   >第'+'<span class="imtitle">'+(i+1)+'</span>注</label>'+
                        '<div class="haonum">'+
                        rednum.join(', ') +
                        ', <span class="blueletter">'+bluenum  +'</span>' +
                            '<span class="glyphicon glyphicon-minus-sign minus icon-minus-sign" ' +
                        '"></span>' +
                        '<input type="text" name="beishu"    value='+1+'  data-beishu='+beishu+'    class="beishu" /> ' +
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
                if( red&& blue&&(red.length>6 || blue.length >1)) {
                    $('div.fushigroup').append('' +
                        '<div class="list-group-item">' +
                        '<label class="label">红复</label>' +
                        '<span class="redhere" data-redblue="'+redblue+'"> '+red.join(", ") +'</span>' +
                        '</div>' +
                        '<div class="list-group-item">' +
                        '<label class="label bluelabel">'+'蓝复'+ '</label> ' +
                        '<span class="bluehere">'+blue.join(", ")+'</span> ' +
                        '<span class="glyphicon glyphicon-minus-sign minus icon-minus-sign" ' +
                        '"></span>' +
                        '<input type="text" name="beishu"  value=1   class="beishufushi" /> ' +
                        '<span class="glyphicon glyphicon-plus-sign plus icon-plus-sign" ' +
                        '"></span>'+
                        '</div> ')
                } else if($('span.valuehere').data('jilei15')){
                    //积累单式五组号码

                    let all = $('span.valuehere').data('reds');
                    let red = all.red.join(', ');
                    let blue = all.blue.join(', ');

                    let jilei15 = $('span.valuehere').data('jilei15');
                    console.log('in confirm jilei15====',jilei15);
                    //处理A手选一注号码
                    if(jilei15 && jilei15.length >0) {
                        for(let i =0 ;i <jilei15.length ;i++) {
                            let rr = ''; let bb = '';
                            if(jilei15[i].length <8) {
                                jilei15[i].push(1);
                            }
                            $('span.valuehere').data('jilei15',jilei15);
                            let rb = jilei15[i];
                            console.log('rb[rb.length-1]=',rb[rb.length-1]);
                            bb = rb[rb.length-2];
                            rr = rb.slice(0,6).sort(function (a,b) {
                                return a -b;
                            });
                            let beishu = rb[rb.length -1];
                            let j = i + 1;
                            console.log('rr==',rr,'bb==',bb,'jilei15[i]==',jilei15[i],'jilei15==',jilei15);
                            $('div.danshigroup').append('' +
                                '<div class="list-group-item beats" >' +
                                '<label class="label smlabel" data-valarr="'+rb+'">第<span class="smnum">'+j+'</span>注 </label>' +
                                '<span class="redpart">'+rr+'</span> - <span class="bluepart">'+bb+'</span>' +
                                '<span class="glyphicon glyphicon-minus-sign minus icon-minus-sign" ' +
                                '"></span>' +
                                '<input type="text" name="beishu"  value='+1+'  data-beishu='+beishu+'  class="beishufu" /> ' +
                                '<span class="glyphicon glyphicon-plus-sign plus icon-plus-sign" ' +
                                '"></span>'+
                                '</div>' );
                            $('div.beats input.beishufu').each(function(i,n){
                                $(n).val($(n).data('beishu'));
                            })
                        }

                    }

                    let num = $('div.danshigroup div.group-list-item').length ;


                    if( num <=4 && num >=0){
                        $('div.danshinotice').show();
                    }
                    if(!jilei15) {
                        jilei15 = $('span.valuehere').data('allnum');
                    }

                    if(jilei15.length >=5) {

                        $('button.oneagain').hide();
                    }
                    console.log('dansih,,,,,,,,,,,,,,,',red,blue,'jilei15.length==',jilei15.length);
                } else if($('span.valuehere').data('tempdan')){
                    let tempdan = $('span.valuehere').data('tempdan');
                    let temptuo = $('span.valuehere').data('temptuo');
                    let tempblue = $('span.valuehere').data('tempblue');
                    let beishu = $('span.valuehere').data('dantuobeishu')?$('span.valuehere').data('dantuobeishu'):1;
                    $('div.danshinotice').hide();
                    console.log('tempdan==1111=',tempdan);
                    if(tempdan) {

                        $('div.dantuogroup').append('<label class="nametitle">胆号:</label><span class="haoma"> ' +
                            tempdan.sort(function (a,b) {
                                return a -b;
                            }).join(',') +'</span>' +
                            '<label class="nametitle label">拖号:</label><span class="haoma">' +
                            temptuo.sort(function(a,b,) {
                                return a -b ;
                            }).join(',')+'</span>' +
                            '<label class="nametitle label">蓝球</label><span class="haoma">' +
                            tempblue.sort(function(a,b){
                                return a-b;
                            }).join(',')+'</span>' +
                            '<div class="beishuholder"><span class="glyphicon glyphicon-minus-sign minus icon-minus-sign" ' +
                            '"></span>' +
                            '<input type="text" name="beishu"  value='+1+'  data-beishu='+beishu+'  class="beishu beishudantuo" /> ' +
                            '<span class="glyphicon glyphicon-plus-sign plus icon-plus-sign" ' +
                            '"></span> </div>');
                    }
                } else {
                    alert('没有内容，请重试！');
                }
                // alert($('span.valuehere').data('tempdan'));
            });
         },

        data() {
            return {
                msg:'aaaaaa',
                'red':[1,2,3],
                'blue':[2,3],
                'beishu':3
            }
        },

        methods: {
            senddata: function() {
                let self= this;
                axios.post('/api/confirmhao', {
                    'red':this.red,
                    'blue':this.blue,
                    'beishu':this.beishu
                }).then(function(response){
                    // this.ok = response.data.ok;
                    self.beishu =response.data;
                    console.log('self.beishu==',self.beishu);
                });
            },
            beatagain: function () {
                $('span.valuehere').data('reds',{red:[],blue:[]});
                let url = window.location.href;
                if(url.indexOf('dantuo') !== -1)
                this.$router.push('/dantuo');
                else
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
                // Warn if overriding existing method
                if(Array.prototype.equals)
                    console.warn("Overriding existing Array.prototype.equals. Possible causes: New API defines the method, there's a framework conflict or you've got double inclusions in your code.");
// attach the .equals method to Array's prototype to call it on any array
                Array.prototype.equal = function (array) {
                    // if the other array is a falsy value, return
                    if (!array)
                        return false;

                    // compare lengths - can save a lot of time
                    if (this.length != array.length)
                        return false;

                    for (var i = 0, l = this.length; i < l; i++) {
                        // Check if we have nested arrays
                        if (this[i] instanceof Array && array[i] instanceof Array) {
                            // recurse into the nested arrays
                            if (!this[i].equal(array[i]))
                                return false;
                        }
                        else if (this[i] != array[i]) {
                            // Warning - two different object instances will never be equal: {x:20} != {x:20}
                            return false;
                        }
                    }
                    return true;
                }
// Hide method from for-in loops
                Object.defineProperty(Array.prototype, "equal", {enumerable: false});
                Array.prototype.indexOf = function(val) {

                    for (var i = 0; i < this.length; i++) {
                        if(this[i] instanceof  Array && val instanceof  Array) {
                            if(this[i].equal(val)) return i ;
                        }
                        if (this[i] == val) return i;
                    }
                    return -1;
                };
                Array.prototype.remove = function(val) {

                    var index = this.indexOf(val);
                    if (index > -1) {
                        this.splice(index, 1);
                    }
                };
                let tempval = $(event.target).siblings('input').val();
                let reg=/^[1-9]\d*$|^0$/;

                if(!reg.test(tempval) && $(event.target).hasClass('glyphicon')) {
                    alert("请输入整数!");
                    return null;
                }
                let val = parseInt($(event.target).siblings('input').val());
                let jilei15 =   $('span.valuehere').data('jilei15');
                if(!jilei15) {
                    jilei15 =   $('span.valuehere').data('allnum');
                }
                let valarr = $(event.target).parents('div.beats').find('label.smlabel').data('valarr');
                let index = jilei15.indexOf(valarr);
                if($(event.target).hasClass('minus')) {

                    if(val <=1) {
                        if($(event.target).siblings('input').hasClass('beishudantuo')) {
                            $(event.target).parents('div.dantuogroup').html('');
                            $('button.oneagain').show();
                            $('span.noticesm').hide();
                            $('div.danshinotice').show();
                        } else {
                            $(event.target).parents('div.beats').remove();
                            this.xuliehao();
                            console.log('hereeeeeeeee  jilei15====',jilei15);
                            jilei15.remove(valarr);
                            $('span.valuehere').data('allnum',jilei15);
                            console.log('hereeeeeeeee  jilei15====',jilei15);
                            $('div.danshinotice').show();
                            $('button.oneagain').show();
                            console.log('$(button.oneagain==',$('button.oneagain').length);
                            console.log('$(\'div.numhere\').find(\'button.btn-addbeat\').length==='
                                ,$('div.numhere').find('button.btn-addbeat').length);
                            if($(event.target).siblings('input').hasClass('beishufushi')) {
                                $('div.fushigroup').html('');
                            }
                            return null;
                        }

                    } else {
                        $(event.target).siblings('input').val(val-1);

                        if($('div.fushigroup span.redhere').length > 0) {

                        } else {
                            if($(event.target).siblings('input').hasClass('beishudantuo')) {
                                $('span.valuehere').data('dantuobeishu',val-1);
                            } else {
                                let arr = $(event.target).siblings('label.smlabel').data('valarr');
                                if(!arr) {
                                    arr = $(event.target).parents('div.beats').find('label.smlabel').data('valarr');

                                }
                                console.log('arr==== in confirm',arr);
                                let arra = arr.split(',');
                                let i = jilei15.indexOf(arra);

                                arra.splice(7,1,(val-1));
                                console.log('arra==============',arra);
                                jilei15.splice(i,1,arra);
                                $('span.valuehere').data('jilei15',jilei15);
                            }

                        }

                    }

                } else if($(event.target).hasClass('plus')) {
                    $(event.target).siblings('input').val(val+1);
                    if($('div.fushigroup span.redhere').length > 0) {

                    } else {
                        if($(event.target).siblings('input').hasClass('beishudantuo')) {
                            $('span.valuehere').data('dantuobeishu',val+1);
                        } else {
                            let arr = $(event.target).siblings('label.smlabel').data('valarr');
                            if(!arr) {
                                arr = $(event.target).parents('div.beats').find('label.smlabel').data('valarr');
                            }
                            let arra = arr.split(',').map(Number);

                            let i = jilei15.indexOf(arra);
                            console.log('arra==============',arra,'i=',i,'jilei15====',jilei15);
                            arra.splice(7,1,(val+1));
                            jilei15.splice(i,1,arra);
                            $(event.target).siblings('label.smlabel').data('valarr',arra.toString());
                            $('span.valuehere').data('jilei15',jilei15);
                        }

                    }


                }else if($(event.target).hasClass('btn-addbeat')) {
                    this.$router.go(-1);
                }

            }
        }
    }
</script>

<style  scoped>


</style>