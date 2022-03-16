<template>
    <div class="home-header">
        <swiper class="swiper" :options="swiperOptions">
            <template v-for="(item, index) in homeHeaderContent.pages">
                <swiper-slide class="swiper__item" :key="index" :style="{backgroundImage: `url(${item.fields.image.value[0].url})`}">
                    <LogoMeta />
                    <div class="content container--lg">
                        <div class="content__left">
                            <div data-aos="fade-right" data-aos-delay="300" class="content__left-title" v-html="section.content"></div>
                            <div class="content__slider-pagination">
                                <span class="swiper-button-prev" slot="button-prev"></span>
                                <div class="swiper-pagination swiper-pagination--left" slot="pagination"></div>
                                <span class="swiper-button-next" slot="button-next"></span>
                            </div>
                            <p data-aos="fade-right" data-aos-delay="500" class="content__left-subtitle">
                                {{section.fields.subtitle.value}}
                            </p>
                            <router-link class="cta" :to="{name: 'section', params: {slug1: productSection.slug}}">
                                {{translate('seeMoreCta')}}
                            </router-link>
                        </div>
                        <div class="content__right">
                            <div data-aos="fade" data-aos-delay="600" class="content__right-title" v-html="item.content"></div>
                            <img src="/images/badge.svg" class="content__right-badge" />
                        </div>
                    </div>
                    <ScrollDown />
                </swiper-slide>
            </template>
        </swiper>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'vue-awesome-swiper';
import { find } from '@/helpers';
import LogoMeta from '../components/LogoMeta';
import ScrollDown from '../components/ScrollDown';

export default {
    name: 'HomeHeader',
    props: ['section'],
    components: {
        Swiper,
        SwiperSlide,
        LogoMeta,
        ScrollDown
    },
    data() {
        return {
            swiperOptions: {
                slidesPerView: 1,
                loop: true,
                spaceBetween: 0,
                freeMode: false,
                preventClicks: true,
                preventClicksPropagation: true,
                effect: 'fade',
                autoplay: {
                    delay: 4000,
                },
                pagination: {
                    el: '.home-header .swiper-pagination',
                    type: 'progressbar',
                    clickable: true
                },
                navigation: {
                    nextEl: '.home-header .swiper-button-next',
                    prevEl: '.home-header .swiper-button-prev'
                }
            }
        }
    },
    computed: {
        homeHeaderContent() {
            return find(this.section.collections, 'type', 'home_header');
        },
        productSection() {
            return this.$store.getters.getSectionByType('product');
        }
    }
}
</script>