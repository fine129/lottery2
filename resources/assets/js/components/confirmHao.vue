<template>
    <div class="text-center">

        <h4 class="alert-info">您选择的号码如下：</h4>
        <div class="list-group">
            <div class="list-group-item">
                <label class="imtitle label">第一注</label>
                <div class="haonum">

                </div>
            </div>
        </div>


    </div>
</template>



<script>


    export default {
        name: "confirmHao",
        components: {   },
        mounted(){
            $(function () {
                console.log('reds===='+ $('span.valuehere').data('reds') +'====blues='
                    + $('span.valuehere').data('blues'));
            });
         },
        data() {
            return {msg:'aaaaaa'}
        },

        methods: {
        }
    }
</script>

<style  scoped>

</style>