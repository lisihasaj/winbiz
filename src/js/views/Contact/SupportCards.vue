<template>
    <div id="links" class="support-cards d-flex flex-column align-items-start justify-content-center">
        <div class="support-cards-links d-flex align-items-center">
            <a data-aos="fade-up" data-aos-delay="200" class="support-cards__item" :href="`${$faqUrl}`" target="_blank">
                <div class="image-wrapper">
                    <img class="icon" src="/images/faq.svg" />
                </div>
                <div class="text-wrapper d-flex flex-column align-items-start justify-content-between">
                    <h5 class="title">FAQ</h5>
                    <p class="route">{{translate('seeMoreCta')}}</p>
                </div>
            </a>
            <router-link data-aos="fade-up" data-aos-delay="200" v-for="(page, index) in subsections" :key="index" class="support-cards__item" :to="{ name: 'subsection', params: { slug1: support.slug, slug2: page.slug }}">
                <div class="image-wrapper">
                    <img class="icon" :src="`${page.fields.page_icon.value[0].url}`" />
                </div>
                <div class="text-wrapper d-flex flex-column align-items-start justify-content-between">
                    <h5 class="title">{{page.title}}</h5>
                    <p class="route">{{translate('seeMoreCta')}}</p>
                </div>
            </router-link>
            <router-link data-aos="fade-up" data-aos-delay="200" class="support-cards__item" :to="{ name: 'section', params: { slug1: community.slug }}">
                <div class="image-wrapper">
                    <img class="icon" :src="communityContent.icon" />
                </div>
                <div class="text-wrapper d-flex flex-column align-items-start justify-content-between">
                    <h5 class="title">{{communityContent.title}}</h5>
                    <p class="route">{{translate('seeMoreCta')}}</p>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "SupportCards",
    data() {
        return {
            communityContent: {
                title: `${this.translate('courses')}`,
                icon: '/images/formationIcon.svg'
            }
        }
    },
    computed: {
        support() {
            return this.$store.getters.getSectionByType('support');
        },
        community() {
            return this.$store.getters.getSectionByType('community');
        },
        subsections() {
            const teleAssistance = this.support.children.find(ss => ss.type === 'tele_assistance');
            const downloads = this.support.children.find(ss => ss.type === 'downloads');
            const smsGateway = this.support.children.find(ss => ss.type === 'sms_gateway');
            const filterChildren = this.support.children.filter(item => item !== teleAssistance && item !== downloads && item !== smsGateway);
            return filterChildren;
        }
    }
}
</script>