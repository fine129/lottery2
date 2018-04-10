<template>
    <div class="text-center">
        <img v-if="userAvatar" :src="userAvatar">
        <button id="pick-avatar">Select an image</button>
        <avatar-cropper
                @uploaded="handleUploaded"
                trigger="#pick-avatar"
                upload-url="/files/upload" />
    </div>
</template>



<script>
    import AvatarCropper from "vue-avatar-cropper"
    export default {
        name: "avatarhere",
        components: { AvatarCropper },
        mounted(){
            $.ready(function () {
                console.log('  (Croppic);=');
            });

            console.log(2333333333);

        },
        data() {
            return {
                userAvatar: undefined,
            }
        },
        methods: {
            handleUploaded(resp) {
                this.userAvatar = resp.relative_url;
            }
        }
    }
</script>

<style scoped>

</style>