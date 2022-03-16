<template>
    <header>
        <nav id="navigation" class="navigation pr-0 pl-0 d-flex align-items-start" :class="{'navigation--white': sectionBlackNavItems}">
            <div class="navigation__burger" @click="toggleSideDrawer">
                <button class="hamburger hamburger--collapse" :class="{'is-active': navOpen}" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button> 
            </div>
            <div class="navigation__wrapper container--lg d-flex justify-content-between align-items-start">
                <div class="navigation__inner" :class="{'open': navOpen}">
                    <ul class="navigation__inner__items">
                        <li v-for="(section, index) in navItems" :key="index" @click="hideSideDrawer">
                            <router-link class="navigation__inner__item" :to="{ name: 'section', params: { slug1: section.slug }}" :class="{'featured': section.type === 'product'}">
                                {{section.title}}
                            </router-link>
                        </li>
                    </ul>
                </div>
                <div class="navigation__cta d-flex align-items-center ml-auto">
                    <Locales />
                    <a :href="`${$memberSpaceUrl}/${this.$route.params.locale}/app/`" class="wb-btn--grey">{{translate('userLoginBtn')}}</a>
                    <div class="navigation__logo" @click="scrollToTop">
                        <router-link :to="{ name: 'home'}" class="link">
                            <Logo class="navigation__logo-svg" />
                        </router-link>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
    import { mapGetters, mapState } from 'vuex'
    import _throttle from 'lodash/throttle'
    import Logo from '@/components/Logo'
    import Locales from '@/components/Locales'

    export default {
        name: 'Navigation',
        components: {
            Logo,
            Locales
        },
        watch: {
            $route: function () {
                window.scrollTo(0,0);
            }
        },
        updated() {
            if(this.navOpen)
                document.documentElement.style.overflow = "hidden";
            else
                document.documentElement.style.overflow = "auto";
        },
        methods: {
            scrollToTop() {
                return window.scrollTo({top: 0, behavior: 'smooth'})
            },
            toggleSideDrawer() {
                this.$store.commit('setNavOpen');
            },
            hideSideDrawer() {
                this.$store.commit('setNavFalse');
            },
            activeSubsection(subsectionType) {
                let section;
                if(this.$route.name !== 'home') {
                    section = this.getSectionBySlug(this.$route.params.slug1)
                } else {
                    section = this.homepage
                }
                
                const subsection = section.children.find(ss => ss.slug === this.$route.params.slug2);
                if (subsection?.type === subsectionType)
                    return true
                return false;
            },
        },
        computed: {
            ...mapGetters({
                navItems: 'getNavigationItems',
                getSection: 'getSectionByType',
                getSectionBySlug: 'getSectionBySlug',
                navState: 'getNavState'
            }),
            ...mapState({
                navOpen: 'navOpen'
            }),
            homepage() {
                return this.getSection('home')
            },
            activeSection() {
                if(this.$route.name !== 'home')  {
                    return this.getSectionBySlug(this.$route.params.slug1)
                } else {
                    return this.homepage
                }
            },
            sectionBlackNavItems() {
                const targetSection = ['contact', 'terms', 'free_test', 'winbiz_local']
                if(targetSection.includes(this.activeSection.type))
                    return true;
                else if (this.activeSubsection('product_specs') ||
                    this.activeSubsection('assistance_vip') || 
                    this.activeSubsection('tele_assistance') || 
                    this.activeSubsection('sms_gateway') || 
                    this.activeSubsection('updates') ||
                    this.activeSubsection('downloads') ||
                    this.activeSubsection('subscribe'))
                    return true;

                return false;
            },
        },
    }
</script>