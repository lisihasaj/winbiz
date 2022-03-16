<template>
    <div class="job-offers d-flex flex-column align-items-center" v-if="page">
        <ChildrenHeader :section='section' :headerContent='headerContent' :label="translate('returnToJobOffers')" />
        <div class="job-offers__content d-flex flex-column align-items-center">
            <div class="job-offers__content-container container--lg d-flex justify-content-center">
                <div class="job-offers__content-wrapper d-flex flex-column align-items-center justify-content-start px-0 col-sm-12 col-md-10 col-lg-7 col-xl-6">
                    <span class="date">Date {{page.fields.application_date.value}}</span>
                    <div class="text" v-html="page.content"></div>
                    <div class="confirmation d-flex flex-column align-items-center">
                        <p>{{translate('areYouInterested')}}</p>
                        <div class="confirmation__buttons d-flex">
                            <a :href="page.fields.apply_button_link ? page.fields.apply_button_link.value : '#'" class="cta jobs-cta" target="_blank">
                                {{translate('jobsCta1')}}
                            </a>
                            <router-link :to="{name: 'section', hash: '#jobs', params: {slug1: section.slug}}" class="branded-outline jobs-cta">
                                {{translate('jobsCta2')}}
                            </router-link>
                        </div>
                    </div>
                    <div class="social-media d-flex flex-column align-items-center">
                        <p>{{translate('shareOffer')}}</p>
                        <div class="social-media__links d-flex">
                            <template v-for="(social, index) in sharePlatforms">
                                <ShareNetwork
                                    class="social-media__links-icon"
                                    :key="index"
                                    :network="social"
                                    :url="params.linkCanonical"
                                    :title="page.title"
                                    :media="(page.fields.seo_image && page.fields.seo_image.value) ? hostName+'/uploads/'+page.fields.seo_image.value[0] : undefined"
                                    :quote="page.content.replace( /(<([^>]+)>)/ig, '')"
                                    :description="page.content.replace( /(<([^>]+)>)/ig, '')"
                                    >
                                    <i :class="`icon-${social}`"></i>
                                </ShareNetwork>
                            </template>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="job-offers__end-note d-flex justify-content-center align-items-center">
            <div class="job-offers__end-note-wrapper container--lg d-flex justify-content-center align-items-center">
                <div data-aos="fade" data-aos-delay="100" v-html="page.fields.application_end_note.value" class="blue-text d-flex flex-column align-items-center justify-content-start">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import VueSocialSharing from 'vue-social-sharing'
Vue.use(VueSocialSharing);
import { metaConfig, formatMeta } from '../../formatMeta'

export default {
    name: 'JobOffers',
    mixins: [metaConfig],
    components: {
        ChildrenHeader: () => import('@/views/Winbiz/ChildrenHeader.vue' /*webpackChunkName: "children-header"*/),
    },
    data() {
        return {
            sharePlatforms: [
                'facebook',
                'linkedin',
                'twitter'
            ],            
        }
    },
    mounted () {     
        this.params = formatMeta(this.page)
        this.$nextTick( () => {
            this.$emit('updateHead')
        })
    },
    computed: {
        section () {
            return this.$store.getters.getSectionByType('winbiz')
        },
        page () {
            return this.$store.getters.getPageBySlug(this.$route.params.slug2)
        },
        headerContent() {
            const header = this.section.fields.job_application_block.value;
            let content = {
                text: header
            };
            return content
        },
    }
}
</script>