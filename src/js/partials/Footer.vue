<template>
    <footer id="footer" class="footer d-flex align-items-center justify-content-center">
        <div class="footer__wrapper container--lg d-flex flex-column align-items-center justify-content-start">
            <FooterContactBlock />
            <div class="footer__content col-md-12 col-xl-10 px-0 d-flex align-items-start justify-content-between">
                <div class="text-details col-10 p-0 d-flex flex-column justify-content-start align-items-start">
                    <div class="text-details__address col-12 p-0 d-flex flex-column justify-content-start align-items-start">
                        <h4 class="text-details__address-title">{{translate('footerTitle')}}</h4>
                        <div class="text-details__address-wrapper col-12 pl-0 d-flex justify-content-between align-items-start" v-html="footerSection.content">
                        </div>
                    </div>
                    <div class="text-details__link col-12 p-0 d-flex flex-column justify-content-start align-items-start">
                        <h4 class="text-details__link-title">{{translate('linksTitle')}}</h4>
                        <div class="col-12 p-0 d-flex flex-column justify-content-start align-items-start">
                            <ul class="text-details__link-section col-12 p-0 d-flex flex-row justify-content-between align-items-center">
                                <router-link class="text-details__link-section__item" v-for="(item, index) in allSections" :key="index" :to="{name: 'section', params: {slug1: item.slug}}">
                                    {{item.title}}
                                </router-link>
                            </ul>
                            <div class="col-12 p-0 d-flex flex-row justify-content-between align-items-start">
                                <div class="text-details__link-group d-flex flex-column align-items-start" v-for="(group, index) in allLinks" :key="index">
                                    <a v-for="(page, index) in group.pages" :key="index" class="route" :href="page.link" :target="page.target">
                                        {{page.name}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="logo col-2 p-0" @click="scrollToTop">
                    <router-link :to="{ name: 'home' }" class="link">
                        <Logo class="logo-svg" />
                    </router-link>
                    <div class="logo-meta">
                        <p>{{translate('logoWord1')}}</p>
                        <p>{{translate('logoWord2')}}</p>
                        <p>{{translate('logoWord3')}}</p>
                    </div>
                </div>
            </div>
            <div class="footer__endnotes col-md-12 col-xl-10 px-0">
                <p class="endnote p-0">©copyrights Winbiz {{new Date().getFullYear()}}</p>
                <router-link class="endnote p-0" :to="{name: 'section', params: {slug1: termsAndConditions.slug}}">{{translate('endNoteBtn1')}}</router-link>
                <!-- <p class="endnote p-0">{{translate('endNoteBtn2')}}</p> -->
            </div>
        </div>
    </footer>
</template>

<script>
import FooterContactBlock from '../views/components/FooterContactBlock';
import Logo from '../components/Logo';
import footerLinks from '@/mixins/footerLinks';
import { mapGetters } from 'vuex';

export default {
    name: 'Footer',
    props: ['section'],
    components: {
        FooterContactBlock,
        Logo
    },
    mixins: [footerLinks],
    computed: {
        ...mapGetters({
            allSections: 'getNavigationItems'
        }),
        termsAndConditions() {
            return this.$store.getters.getSectionByType('terms');
        }
    }
}
</script>