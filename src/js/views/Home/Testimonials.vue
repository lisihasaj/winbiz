<template>
    <div class="testimonials">
        <swiper class="swiper" :options="swiperOptions">
            <template v-for="(item, index) in testimonialsContent.pages">
                <swiper-slide class="swiper__item" :key="index" :style="{backgroundImage: `url(${item.fields.image.value[0].url})`}">
                    <div class="testimonial container--lg">
                        <div class="testimonial__content d-flex justify-content-between align-items-center p-0">
                            <div class="testimonial__content-wrapper d-flex flex-column align-items-start justify-content-start p-0" v-html="item.fields.person.value"></div>
                            <div class="testimonial__description" v-html="item.content"></div>
                        </div>
                        <div class="testimonial__slider-pagination">
                            <span class="swiper-button-prev" slot="button-prev"></span>
                            <div class="swiper-pagination swiper-pagination--left" slot="pagination"></div>
                            <span class="swiper-button-next" slot="button-next"></span>
                        </div>
                    </div>
                </swiper-slide>
            </template>
        </swiper>
    </div>
</template>

<script>
import { SwiperSlide, Swiper } from 'vue-awesome-swiper';
import { find } from '@/helpers';

export default {
    name: 'Testimonials',
    props: ['section'],
    components: {
        Swiper,
        SwiperSlide
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
                pagination: {
                    el: '.testimonials .swiper-pagination',
                    type: 'progressbar',
                    clickable: true
                },
                navigation: {
                    nextEl: '.testimonials .swiper-button-next',
                    prevEl: '.testimonials .swiper-button-prev'
                }
            }
        }
    },
    computed: {
        testimonialsContent() {
            return find(this.section.collections, 'type', 'testimonials');
        }
    }
}
</script>