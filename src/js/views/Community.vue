<template>
    <div class="community">
        <SectionHeader :section='section' :headerContent='headerContent' />
        <MediaBlock :section='section' />
        <FormationsBlock />
        <!-- <AudioBlock :section='section' /> -->
        <TwitterFeed :section='section' />
        <VideosBlock :section='section' />
        <template v-if="video">
            <VideoPopup />
        </template>
    </div>
</template>

<script>

export default {
    name: 'Community',
    props: ['section'],
    components: {
        SectionHeader: () => import('@/views/components/SectionHeader.vue' /*webpackChunkName: "section-header"*/),
        MediaBlock: () => import('@/views/Community/MediaBlock.vue' /*webpackChunkName: "media-block"*/),
        FormationsBlock: () => import('@/views/components/FormationsBlock.vue' /*webpackChunkName: "formations-block"*/),
        // AudioBlock: () => import('@/views/Community/AudioBlock.vue' /*webpackChunkName: "audio-block"*/),
        TwitterFeed: () => import('@/views/Community/TwitterFeed.vue' /*webpackChunkName: "twitter-feed"*/),
        VideosBlock: () => import('@/views/Community/VideosBlock.vue' /*webpackChunkName: "videos-block"*/),
        VideoPopup: () => import('@/views/Community/VideoPopup.vue' /*webpackChunkName: "video-popup"*/),
    },
    computed: {
        headerContent() {
            const headings = this.section.content;
            const backgroundColor = `#000`;
            let content = {
                text: headings,
                backgroundCover: {backgroundColor},
            }
            return content
        },
        video () {
            return this.$store.getters.getVideo
        }
    }
}
</script>