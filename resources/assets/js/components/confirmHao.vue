<template>
    <div class="text-left">

        <h4 class="alert-info">您选择的号码如下：</h4>
        <div class="list-group numhere" @click="changeBeishu">

        </div>


    </div>
</template>



<script>


    export default {
        name: "confirmHao",
        components: {   },
        mounted(){
            $(function () {
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
            });
         },
        data() {
            return {msg:'aaaaaa'}
        },

        methods: {
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