<template>
    <div class="external-pages d-flex flex-column align-items-start justify-content-center col-md-12 col-lg-11 col-xl-10 px-0">
        <h1 data-aos="fade-right" class="title">{{translate('externalLinksTitle')}}</h1>
        <div class="external-links d-flex align-items-center">
            <a data-aos="fade-up" class="external-links__item" :href="`${$faqUrl}`" target="_blank">
                <img class="icon" src="/images/faq.svg" />
                <div class="d-flex flex-column align-items-start justify-content-between">
                    <h5 class="title">FAQ</h5>
                    <p class="route">{{translate('seeMoreCta')}}</p>
                </div>
            </a>
            <router-link data-aos="fade-up" data-aos-delay="200" v-for="(page, index) in getSubsections" :key="index" class="external-links__item" :to="{ name: 'subsection', params: { slug1: section.slug, slug2: page.slug }}">
                <img class="icon" :src="`${page.fields.page_icon.value[0].url}`" />
                <div class="d-flex flex-column align-items-start justify-content-between">
                    <h5 class="title">{{page.title}}</h5>
                    <p class="route">{{translate('seeMoreCta')}}</p>
                </div>
            </router-link>
            <router-link data-aos="fade-up" data-aos-delay="200" class="external-links__item" :to="{ name: 'section', params: { slug1: community.slug }}">
                <img class="icon" :src="communityContent.icon" />
                <div class="d-flex flex-column align-items-start justify-content-between">
                    <h5 class="title">{{communityContent.title}}</h5>
                    <p class="route">{{translate('seeMoreCta')}}</p>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
    name: 'ExternalPages',
    props: [
        'section',
        'subsection'
    ],
    data() {
        return {
            communityContent: {
                title: `${this.translate('courses')}`,
                icon: '/images/formationIcon.svg'
            }
        }
    },
    computed: {
        ...mapState([
            'sections' 
        ]),
        getSubsections() {
            const assistanceVIP = this.section.children.find(ss => ss.type === 'assistance_vip');
            const smsGateway = this.section.children.find(ss => ss.type === 'sms_gateway');
            const filterChildren = this.section.children.filter(item => item !== this.subsection && item !== assistanceVIP && item !== smsGateway);
            return filterChildren;
        },
        community() {
            return this.sections.find(s => s.type === 'community');
        }
    }
}
</script>