<template>
    <div class="audio-block">
        <div ref="container" class="audio-block-container container--lg d-flex flex-column align-items-center justify-content-start">
            <h1 class="audio-block__title">écouter nos podcasts</h1>
            <ActiveAudio :section='section' :selectedAudio='selectedAudio' />
            <h4 class="audio-block__items-title">
                écouter aussi
            </h4>
        </div>
        <swiper class="swiper" :options="swiperOptions" :style="{'width': `calc(100% - ${offsetLeft}px)`}">
            <template>
                <swiper-slide 
                    class="swiper__item" 
                    v-for="(audio, index) in audioslistForUse" 
                    :key="index"
                    >
                    <div class="audio-container" @click="selectAudio(audio.id)">
                        <div class="image-wrapper d-flex align-items-center justify-content-center">
                            <img class="icon" src="/images/w.svg" />
                            <img class="image" :src="`${audio.fields.image.value[0].url}`" />
                        </div>
                        <div class="elements-wrapper d-flex flex-column aling-items-start justify-content-center">
                            <span class="duration">00:12:30</span>
                            <div class="title" v-html="audio.content"></div>
                            <span class="date">{{audio.fields.date.value}}</span>
                        </div>
                    </div>
                </swiper-slide>
            </template>
        </swiper>
        <div class="audio-block__slider-pagination container--lg">
            <span class="swiper-button-prev" slot="button-prev"></span>
            <div class="swiper-pagination swiper-pagination--left" slot="pagination"></div>
            <span class="swiper-button-next" slot="button-next"></span>
        </div>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'vue-awesome-swiper';
import ActiveAudio from './ActiveAudio';

export default {
    name: 'AudioBlock',
    props: ['section'],
    components: {
        Swiper,
        SwiperSlide,
        ActiveAudio
    },
    data() {
        return {
            offsetLeft: '',
            selectedAudio: this.section.collections.find(c => c.type === 'audio_block').pages[0],
            swiperOptions: {
                slidesPerView: 3.5,
                spaceBetween: 15,
                loop: false,
                freeMode: false,
                slideToClickedSlide: true,
                freeModeMomentumBounce: true,
                preventClicks: true,
                preventClicksPropagation: true,
                mousewheel: {
                    forceToAxis: true
                },
                pagination: {
                    el: '.audio-block .swiper-pagination',
                    type: 'progressbar',
                    clickable: true
                },
                navigation: {
                    nextEl: '.audio-block .swiper-button-next',
                    prevEl: '.audio-block .swiper-button-prev'
                },
                breakpoints: {
                    320: {
                    slidesPerView: 1,
                    spaceBetween: 5
                    },
                    480: {
                    slidesPerView: 1.2,
                    spaceBetween: 5
                    },
                    640: {
                    slidesPerView: 1.4,
                    spaceBetween: 10
                    },
                    850: {
                    slidesPerView: 2,
                    spaceBetween: 10
                    },
                    1024: {
                    slidesPerView: 2.6,
                    spaceBetween: 10
                    },
                    1200: {
                    slidesPerView: 3.1,
                    spaceBetween: 10
                    },
                    1400: {
                    slidesPerView: 3.5,
                    spaceBetween: 10
                    },
                }
            }
        }
    },
    computed: {
        allAudios() {
            return this.section.collections.find(c => c.type === 'audio_block').pages;
        },
        audioslistForUse() {
            let audiosList = this.allAudios.filter(a => a !== this.selectedAudio)
            return audiosList
        }
    },
    methods: {
        calculateMargin() {
            const container = this.$refs.container.offsetLeft;
            this.offsetLeft = container
        },
        selectAudio(id) {
            const selectedAudioId = this.allAudios.findIndex(c => c.id === id);
            this.selectedAudio = this.allAudios[selectedAudioId];
            return this.selectedAudio;
        }
    },
    mounted() {
        this.calculateMargin();
        window.addEventListener('resize', this.calculateMargin);
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.calculateMargin);
    }
}
</script>