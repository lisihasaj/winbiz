import Vue from 'vue'
import router from './routes'
import store from './store'
import VueRouter from 'vue-router'
import Plugins from './plugins'
import VueAnalytics from 'vue-analytics'
import VueLazyload from 'vue-lazyload'
import VueHead from 'vue-head'
import Constants from './constants'
import AOS from 'aos'
import dayjs from 'dayjs'
import de from 'dayjs/locale/de'
import fr from 'dayjs/locale/fr'
import it from 'dayjs/locale/it'
import SplashPage from './views/components/SplashPage.vue'

import { mapState } from 'vuex';

Vue.use(VueHead)
Vue.use(VueRouter)
Vue.use(Plugins)
Vue.use(Constants)
Vue.use(VueLazyload)
Vue.use(VueAnalytics, {
    id: 'UA-XXXXXXX-XX',
    router
});

window.axios = require('axios')
window.dayjs = dayjs

new Vue({
    el: '#app',
    router,
    store,
    data() {
        return {
            sections: [],
            loading: true
        }
    },
    mounted() {
        if (this.$route.params.locale) {
            dayjs.locale(this.$route.params.locale)
        };

        Vue.prototype.$recaptchaKey = process.env.MIX_RECAPTCHA_V2_KEY;
        Vue.prototype.$memberSpaceUrl = process.env.MIX_MEMBER_URL;
        Vue.prototype.$faqUrl = `https://helpcenter.winbiz.ch/hc/fr`;
    },
    template: `
    <div id="app">
        <SplashPage v-if="loading" />
        <template v-if="sections.length">
            <navigation />
            <cookiesBanner />
            <TroubleshootingMsg />
            <main>
                <div v-show="navOpen" class="backdrop-layer" @click="hideSideDrawer"></div>
                <router-view :key="$route.fullPath"></router-view>
            </main>    
            <footer-component />
        </template>
    </div>`,
    components: {
        SplashPage,
        TroubleshootingMsg: () => import('@/views/components/TroubleshootingMsg.vue' /* webpackChunkName: "troubleshooting-msg" */),
        cmsBar: () => import('@/partials/CmsBar.vue' /* webpackChunkName: "cms-bar" */),
        navigation: () => import('@/partials/Navigation.vue' /* webpackChunkName: "navigation" */),
        footerComponent: () => import('@/partials/Footer.vue' /* webpackChunkName: "footer" */),
        cookiesBanner: () => import('@/views/components/CookiesBanner.vue' /* webpackChunkName: "cookies-banner" */),
    },
    created: function () {
        document.title = 'WINBIZ';
        if (sessionStorage.getItem('loader')) {
            this.loading = false;
        }
        else {
            this.loading = true;
        }

        this.getData();

        AOS.init();
    },
    methods: {
        getData() {
            axios.all([this.getSections(), this.getPages()])
                .then(axios.spread((sections, pages) => {
                    this.sections = sections.data
                    this.$store.commit('sections', sections.data)
                    this.$store.commit('pages', pages.data)
                    this.loading = false
                    sessionStorage.setItem('loader', true)
                }));
        },
        getSections() {
            return axios.get(`/${this.$route.params.locale}/api/v2/sections`)
        },
        getPages() {
            return axios.get(`/${this.$route.params.locale}/api/v2/pages`)
        },
        beforeEnter: function (el) {
            window.scrollTo(0, 0)
        },
        hideSideDrawer() {
            this.$store.commit('setNavFalse');
        },
    },
    computed: {
        ...mapState([
            'navOpen'
        ]),
    }
})