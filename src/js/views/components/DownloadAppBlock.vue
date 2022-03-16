<template>
    <div class="download-app-block d-flex justify-content-start align-items-end" v-lazy:background-image="downloadAppBlockContent.coverImage" :class="{'product-section': productPageModifier, 'support-section': supportPageModifier}">
        <div class="container--lg">
            <div class='download-app-block__content d-flex flex-column justify-content-start align-items-start'>
                <div data-aos="fade-right" class="download-app-block__title" v-html="downloadAppBlockContent.title"></div>
                <DownloadAppButtons />
                <!-- <router-link data-aos="fade" data-aos-delay="200" class="cta" :to="{name: 'section', params: {slug1: freeTestSection.slug}}">
                    {{translate('testWinbiz')}}
                </router-link> -->
            </div>
        </div>
    </div>
</template>

<script>
import DownloadAppButtons from '@/views/components/DownloadAppButtons.vue';
export default {
    name: 'DownloadAppBlock',
    props: {
        downloadAppBlockContent: {
            type: Object
        }
    },
    components: {
        DownloadAppButtons
    },
    computed: {
        activeSection () {
            if(this.$route.name !== 'home') {
                return this.$store.getters.getSectionBySlug(this.$route.params.slug1);
            } else {
                return this.$store.getters.homeSection
            }
        },
        productPageModifier() {
            const targetSection = ['product'];
            return targetSection.includes(this.activeSection.type);
        },
        supportPageModifier() {
            const targetSection = ['support', 'winbiz'];
            return targetSection.includes(this.activeSection.type);
        },
        freeTestSection() {
            return this.$store.getters.getSectionByType('free_test');
        }
    }
}
</script>