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
            <button class="btn btn-info confirm">确认选择</button>
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
            return {
                userAvatar: undefined,
            }
        },
        methods: {
            handleUploaded(resp) {
                this.userAvatar = resp.relative_url;
            },
            selectOnebeat:function() {
                
            },
            selectFiveBeats: function() {

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

</style>