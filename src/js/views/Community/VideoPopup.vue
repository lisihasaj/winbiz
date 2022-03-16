<template>
    <div class="video-popup">
        <div class="video-popup__inner">
            <button class="video-popup__close" @click="close">close</button>
            <iframe class="video-popup__video" :src="`https://www.youtube.com/embed/${video.fields.youtube_video_id.value}`" v-if="checkField(video, 'youtube_video_id')"></iframe>
        </div>
    </div>
</template>

<script>
export default {
    name: "VideoPopup",
    mounted () {
        document.body.classList.add('no-scroll');
        document.body.appendChild(this.$el);
        document.addEventListener('keydown', this.escapeHandler);
    },
    methods: {
        escapeHandler (e) {
            if (e.key === 'Escape') {
                this.close();
            }
        },
        close () {
            this.$store.commit('setVideo', null)
        }
    },
    computed: {
        video () {
            return this.$store.getters.getVideo
        }
    },
    beforeDestroy () {
        document.body.classList.remove('no-scroll');
        document.removeEventListener('keydown', this.escapeHandler);
    }
}
</script>