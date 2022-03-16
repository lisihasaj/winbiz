import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const _getters = {
    getSections: state => {
        return state.sections
    },
    getPages: state => {
        return state.pages
    },
    getSectionBySlug: (state) => (slug) => {
        return state.sections.find(section => section.slug === slug)
    },
    getSectionByType: (state) => (type) => {
        return state.sections.find(section => section.type === type)
    },
    getPageBySlug: (state) => (slug) => {
        return state.pages.find(page => page.slug === slug)
    },
    homeSection: (state) => {
        return state.sections.find(section => section.type === 'home')
    },
    getNavigationItems: state => {
        const excludedSections = [
            'footer',
            'root', 
            'home', 
            'shared_components', 
            'trainings',
            'contact',
            'terms',
            'free_test',
            'winbiz_local',
            'sms_gatway'
        ]
        return state.sections.filter((s) => !excludedSections.includes(s.type))
    },
    getNavState: state => {
        return state.navOpen;
    },
    getVideo: state => {
        return state.video
    },
    getCities: state => {
        return state.cities
    },
    getWbLocalPartners: state => {
        return state.wb_local_partners
    }
}

const store = new Vuex.Store({
    state: {
        sections: [],
        pages: [],
        navOpen: false,
        video: null,
        cities: [],
        partners: [],
        wb_local_partners: []
    },
    mutations: {
        sections (state, sections) {
            state.sections = sections
        },
        pages (state, pages) {
            state.pages = pages
        },
        setNavOpen: state => {
            return state.navOpen = !state.navOpen
        },
        setNavFalse: state => {
            return state.navOpen = false
        },
        setVideo (state, video) {
            state.video = video
        },
        setCities (state, cities) {
            state.cities = cities
        },
        setPartners (state, partners) {
            state.partners = partners
        },
        setWbLocalPartners (state, partners) {
            state.wb_local_partners = partners
        }
    },
    getters: _getters
})

export default store
