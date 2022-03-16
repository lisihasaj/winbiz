<template>
    <div class="videos-block">
        <div class="videos-block-container container--lg d-flex flex-column align-items-center justify-content-start">
            <div class="videos-block-heading d-flex px-0 flex-column align-items-center justify-content-start">
                <h1 data-aos="fade-right" class="videos-block-heading__title">{{translate('videoTitle')}}</h1>
                <span class="videos-block-heading__results d-flex justify-content-end px-0">{{totalResults}}</span>
                <VideoFilters @handleSearch="handleSearch" @handleSort="handleSort" ref="sorters" :tags="tags" />
            </div>
            <div class="videos-block__content d-flex">
                <div data-aos="fade-up" data-aos-delay="200" v-for="(item, index) in showedVideos" :key="index" class="item-wrapper d-flex flex-column align-items-center justify-content-start" @click="openVideo(item)">
                    <div class="item-video d-flex justify-content-center align-items-center">
                        <img class="icon" src="/images/w.svg" />
                        <!-- <span class="duration">00:05:45</span> -->
                        <img class="image" :src="`${item.fields.thumbnail.value[0].url}`"  v-if="checkField(item, 'thumbnail')" />
                    </div>
                    <div class="item-elements d-flex px-0 m-0 flex-column align-items-start justify-content-start">
                        <span class="item-date">{{item.fields.date.value}}</span>
                        <h5 class="item-title">{{item.title}}</h5>
                        <div class="item-tags d-flex">
                            <span class="item-tag" v-for="(tag, index) in item.tags" :key="index">
                                {{tag.name}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <button data-aos="fade-up" data-aos-delay="400" v-show="visibleVideos < videos.length" class="videos-block__show-more" @click='showMoreVideos'>
                {{translate('showMoreBtn')}}
            </button>
        </div>
    </div>
</template>

<script>
import VideoFilters from './VideoFilters';
import videoFilters from '@/mixins/videoFilters';
import _uniqBy from 'lodash/uniqBy'

export default {
    name: 'VideosBlock',
    props: ['section'],
    components: {
        VideoFilters
    },
    data() {
        return {
            videos: [],
            visibleVideos: 4,
            totalResults: ''
        }
    },
    mixins: [videoFilters],
    mounted() {
        this.videos = this.fetchedVideos;
    },
    updated() {
        this.totalResults = this.videos.length + ` ${this.translate('totalVideos')}`;
    },
    methods: {
        showMoreVideos() {
            if (this.visibleVideos < this.videos.length)
                this.visibleVideos += 4;
            else
                return
        },
        openVideo (video) {
            this.$store.commit('setVideo', video);
        }
    },
    computed: {
        fetchedVideos() {
            return this.section.collections.find(c => c.type === 'videos').pages;
        },
        showedVideos() {
            return this.videos.slice(0, this.visibleVideos);
        },
        tags () {
            let _tags = [];
            for (let video of this.fetchedVideos) {
                _tags.push(...video.tags)
            }

            return _uniqBy(_tags, 'id').map((tag) => tag.name)
        }
    },
}
</script>