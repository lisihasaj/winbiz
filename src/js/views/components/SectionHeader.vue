<template>
    <div :style="headerContent.backgroundCover" class="section-header d-flex flex-column align-items-center justify-content-start">
        <LogoMeta />
        <div class="header-container container--lg d-flex justify-content-center align-items-end">
            <div class="header-content d-flex flex-column align-items-center justify-content-start">
                <div data-aos="fade-up" data-aos-delay="300" class="header-content__title d-flex flex-column justify-content-start align-items-center" v-html="section.content">
                </div>
                <div v-if="!communitySection" class="header-content__buttons d-flex flex-row justify-content-around align-items-center">
                    <button v-if="productSection" class="branded-cta" @click="goToProductBlock">
                        {{headerContent.externalBtn}}
                    </button>
                    <router-link v-if="!supportSection && !productSection" class="branded-cta" :to="{name: 'section', params: {slug1: headerContent.externalRoute}}">
                        {{headerContent.externalBtn}}
                    </router-link>
                    <router-link v-if="!winbizSection && !supportSection" class="white-cta" :to="{name: 'subsection', params: {slug1: section.slug, slug2: headerContent.subsection.slug}}">
                        {{headerContent.subsectionBtn}}
                    </router-link>
                    <a class="white-cta" v-if="supportSection" target="_blank" :href="`${$faqUrl}`">
                        faq
                    </a>
                    <button v-if="winbizSection" class="white-cta" @click="goToJobs">
                        {{headerContent.collectionBtn}}
                    </button>
                </div>
                <!-- <div class="header-search p-0 m-0 col-12 d-flex flex-column align-items-center justify-content-start" v-if="searchEnabler">
                    <Search />
                </div> -->
            </div>
            <ScrollDown />
        </div>
    </div>
</template>

<script>
import LogoMeta from '../components/LogoMeta';
import Search from './Search';
import ScrollDown from './ScrollDown';

export default {
    name: 'SectionHeader',
    props: [
        'section',
        'headerContent',
        'subsection'
    ],
    components: {
        LogoMeta,
        Search,
        ScrollDown
    },
    methods: {
        goToProductBlock() {
            this.$emit('goToProductBlock')
        },
        goToJobs() {
            this.$emit('goToJobs')
        }
    },
    computed: {
        // searchEnabler() {
        //     const targetSection = ['support', 'community'];
        //     return targetSection.includes(this.section.type)
        // },
        supportSection() {
            const targetSection = ['support'];
            return targetSection.includes(this.section.type)
        },
        communitySection() {
            const targetSection = ['community'];
            return targetSection.includes(this.section.type)
        },
        productSection() {
            const targetSection = ['product'];
            return targetSection.includes(this.section.type)
        },
        winbizSection() {
            const targetSection = ['winbiz'];
            return targetSection.includes(this.section.type)
        }
    }
}
</script>