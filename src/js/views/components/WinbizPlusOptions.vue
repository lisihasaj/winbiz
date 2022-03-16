<template>
    <div class="winbiz-plus" :class="{'winbiz-plus-modified': modifyComponent}">
        <div ref="container" class="winbiz-plus__header container--lg d-flex justify-content-between align-items-start">
            <div class="heading">
                <h2 data-aos="fade-right" class="heading__title">
                    WINBIZ APP
                </h2>
                <p data-aos="fade-right" data-aos-delay="200" class="headings__subtitle">{{translate('wpoTitle')}}</p>
            </div>
            <a data-aos="fade-left" data-aos-delay="200" class="winbiz-plus__cta" href="https://winbizappstore.ch/fr/2-accueil">{{translate('wpoCta')}}</a>
        </div>
        <swiper class="swiper" :options="swiperOptions" :style="{'width': `calc(100% - ${offsetLeft}px)`}">
            <template>
                <swiper-slide class="swiper__item" v-for="(item, index) in product.pages" :key="index">
                    <a class="option d-flex flex-row align-items-center justify-content-start" v-if="checkField(item, 'link')" :href="item.fields.link.value" target="_blank">
                        <div class="option__blue">
                            <img class="option__image" v-if="checkField(item, 'image')" v-lazy="item.fields.image.value[0].url" />
                        </div>
                        <div class='option__content'>
                            <h4 class="option__content__title">{{item.fields.title.value}}</h4>
                            <p class="option__content__editor-name">{{item.fields.publisher.value}}</p>
                            <p class="option__content__price">{{item.fields.price.value}}</p>
                            <div class="option__content__tags">
                                <span v-for="tag in item.tags" class="tag" :key="tag.id">{{tag.name}}</span>
                            </div>
                        </div>
                    </a>
                </swiper-slide>
            </template>
        </swiper>
        <div class="winbiz-plus__slider-pagination container--lg">
            <span class="swiper-button-prev" slot="button-prev"></span>
            <div class="swiper-pagination swiper-pagination--left" slot="pagination"></div>
            <span class="swiper-button-next" slot="button-next"></span>
        </div>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'vue-awesome-swiper';
import { mapState } from 'vuex';

export default {
    name: 'WinbizPlusOptions',
    components: {
        Swiper,
        SwiperSlide
    },
    data() {
        return {
            offsetLeft: '',
            swiperOptions: {
                slidesPerView: 3.5,
                spaceBetween: 30,
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
                    el: '.winbiz-plus .swiper-pagination',
                    type: 'progressbar',
                    clickable: true
                },
                navigation: {
                    nextEl: '.winbiz-plus .swiper-button-next',
                    prevEl: '.winbiz-plus .swiper-button-prev'
                },
                breakpoints: {
                    320: {
                    slidesPerView: 1.1,
                    spaceBetween: 5
                    },
                    480: {
                    slidesPerView: 1.4,
                    spaceBetween: 5
                    },
                    640: {
                    slidesPerView: 1.9,
                    spaceBetween: 10
                    },
                    850: {
                    slidesPerView: 2,
                    spaceBetween: 10
                    },
                    1024: {
                    slidesPerView: 2.7,
                    spaceBetween: 10
                    },
                    1200: {
                    slidesPerView: 3,
                    spaceBetween: 10
                    },
                    1400: {
                    slidesPerView: 3.1,
                    spaceBetween: 10
                    },
                    1920: {
                    slidesPerView: 3.5,
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
        }
    },
    computed: {
        ...mapState([
            'sections'
        ]),
        activeSection () {
            if(this.$route.name !== 'home') {
                return this.$store.getters.getSectionBySlug(this.$route.params.slug1);
            } else {
                return this.$store.getters.homeSection
            }
        },
        modifyComponent() {
            const targetSection = ['product'];
            return targetSection.includes(this.activeSection.type)
        },
        product() {
            const section = this.sections.find(s => s.type === 'shared_components');
            const collection = section.collections.find(c => c.type === 'winbiz_plus_options');
            return collection;
        }
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.calculateMargin)
    }
}
</script>