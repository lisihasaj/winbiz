<template>
    <div class="product-block" :class="{'product-block-white': activeProduct}" :id="[activeWinbizLocal ? 'winbiz-local-block' : '']">
        <div class="product-block__container container--lg d-flex">
            <div class="heading-wrapper col-lg-12 col-xl-4 p-0">
                <div class="heading-container" v-html="productBlockContent.header" data-aos="fade-right"></div>
                <div v-if="section.type !== 'winbiz_local'" class="button-wrapper d-flex">
                    <template v-if="activeHome">
                        <router-link data-aos="fade" data-aos-delay="200" class="cta" :to="{name: 'section', params: {slug1: productSection.slug}}">
                            {{translate('orderCloude')}}
                        </router-link>
                        <router-link data-aos="fade" data-aos-delay="300" class="outlined-cta" :class="{'outlined-cta__branded': activeProduct}" :to="{name: 'section', params: {slug1: winbizLocalSection.slug}}">
                            {{translate('localWinbiz')}}
                        </router-link>
                    </template>
                    <template v-if="activeProduct">
                        <a data-aos="fade" data-aos-delay="200" class="cta" :href="`${$memberSpaceUrl}/${this.$route.params.locale}/signup/`">
                            {{translate('orderCloude')}}
                        </a>
                        <router-link data-aos="fade" data-aos-delay="300" class="outlined-cta__branded" :to="{name: 'section', params: {slug1: winbizLocalSection.slug}}">
                            {{translate('localWinbiz')}}
                        </router-link>
                    </template>
                </div>
                <button v-if="section.type === 'winbiz_local'" data-aos="fade" data-aos-delay="200" class="cta" @click="setShowForm">
                    {{translate('orderNow')}}
                </button>
            </div>
            <div class="card-wrapper col-lg-12 col-xl-8 px-0 d-flex justify-content-between align-items-center">
                <div class="card1" data-aos="fade">
                    <div class="card1__offers-list" v-html="productBlockContent.cardOne"></div>
                    <h1 class="card1__number">{{productBlockContent.number}}</h1>
                    <p class="card1__footer-text">{{translate('card1Footer')}}</p>
                </div>
                <img class="plus" src="/images/plusIcon.svg">
                <div class="card2" data-aos="fade" data-aos-delay="100">
                    <div class="card2__options-list" v-html="productBlockContent.cardTwo"></div>
                    <router-link v-if="activeHome || activeWinbizLocal" class="card2__footer-text" :to="{name: 'subsection', params: {slug1: productSection.slug, slug2: productSection.children[0].slug}}">
                        <img v-show="activeHome" class="small-plus" src="/images/whitePlus.svg">
                        <img v-show="activeWinbizLocal" class="small-plus" src="/images/blackPlus.svg">
                        {{translate('card2Footer')}}
                    </router-link>
                    <router-link v-if="activeProduct" :to="{name: 'subsection', params: {slug1: productSection.slug, slug2: productSection.children[0].slug}}" class="card2__footer-link">
                        <i class="icon-right-open-big arrow"></i>
                        {{translate('card2FooterLink')}}
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'ProductBlock',
    props: [
        'section',
        'productBlockContent',
        'showForm'
    ],
    methods: {
        setShowForm() {
            this.$parent.showForm = true;
            window.scrollTo(0,0)
        }
    },
    computed: {
        activeProduct() {
            const targetSection = ['product'];
            return targetSection.includes(this.section.type)
        },
        activeHome() {
            const targetSection = ['home'];
            return targetSection.includes(this.section.type)
        },
        activeWinbizLocal() {
            const targetSection = ['winbiz_local'];
            return targetSection.includes(this.section.type)
        },
        productSection() {
            return this.$store.getters.getSectionByType('product');
        },
        winbizLocalSection() {
            return this.$store.getters.getSectionByType('winbiz_local');
        }
    }
}
</script>