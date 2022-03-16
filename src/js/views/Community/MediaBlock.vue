<template>
    <div class="media-block">
        <h1 data-aos="fade-right" ref="container" class="media-block__title container--lg">{{translate('mediaTitle')}}</h1>
        <swiper class="swiper" :options="swiperOptions" :style="{'width': `calc(100% - ${offsetLeft}px)`}">
            <template>
                <swiper-slide class="swiper__item" v-for="(video, index) in videos" :key='index' @click.native="openVideo(video)">
                    <div class="video-container">
                        <img class="video-image" :src="`${video.fields.thumbnail.value[0].url}`" v-if="checkField(video, 'thumbnail')" />
                        <p class="video-title">{{video.title}}</p> 
                    </div>
                </swiper-slide>
            </template>
        </swiper>
        <div class="media-block__slider-pagination container--lg">
            <span class="swiper-button-prev" slot="button-prev"></span>
            <div class="swiper-pagination swiper-pagination--left" slot="pagination"></div>
            <span class="swiper-button-next" slot="button-next"></span>
        </div>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'vue-awesome-swiper';

export default {
    name: 'MediaBlock',
    props: ['section'],
    components: {
        Swiper,
        SwiperSlide
    },
    data() {
        return {
            offsetLeft: '',
            swiperOptions: {
                slidesPerView: 'auto',
                spaceBetween: 15,
                loop: false,
                freeMode: false,
                slideToClickedSlide: false,
                freeModeMomentumBounce: true,
                preventClicks: true,
                preventClicksPropagation: true,
                mousewheel: {
                    forceToAxis: true
                },
                pagination: {
                    el: '.media-block .swiper-pagination',
                    type: 'progressbar',
                    clickable: true
                },
                navigation: {
                    nextEl: '.media-block .swiper-button-next',
                    prevEl: '.media-block .swiper-button-prev'
                },
                breakpoints: {
                    320: {
                    slidesPerView: 1,
                    spaceBetween: 5
                    },
                    480: {
                    slidesPerView: 1,
                    spaceBetween: 5
                    },
                    540: {
                    slidesPerView: 1.1,
                    spaceBetween: 5
                    },
                    640: {
                    slidesPerView: 1.4,
                    spaceBetween: 10
                    },
                    680: {
                    slidesPerView: 1.5,
                    spaceBetween: 10
                    },
                    850: {
                    slidesPerView: 1.9,
                    spaceBetween: 10
                    },
                    1024: {
                    slidesPerView: 2.3,
                    spaceBetween: 10
                    },
                    1200: {
                    slidesPerView: 2.7,
                    spaceBetween: 10
                    },
                    1400: {
                    slidesPerView: 3.2,
                    spaceBetween: 10
                    },
                    1920: {
                    slidesPerView: 3.7,
                    spaceBetween: 10
                    }
                }
            }
        }
    },
    mounted() {
        this.calculateMargin()
        window.addEventListener('resize', this.calculateMargin)
    },
    methods: {
        calculateMargin() {
            const container = this.$refs.container.offsetLeft;
            this.offsetLeft = container
        },
        openVideo (video) {
            this.$store.commit('setVideo', video);
        }
    },
    computed: {
        videoPages () {
            return this.section.collections.find(c => c.type === 'videos').pages
        },
        videos () {
            return this.videoPages.filter((video) => video.fields.featured.value === '1')
        }
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.calculateMargin)
    }
}
</script>