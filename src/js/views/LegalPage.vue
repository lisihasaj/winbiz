<template>
    <div class="terms d-flex flex-column align-items-center justify-content-start">
        <LogoMeta />
        <div class="terms__header container--lg">
            <div class="terms__content d-flex flex-column justify-content-start align-items-center">
                <div data-aos="fade" data-aos-delay="300" class="title" v-html="section.content"></div>
            </div>
            <div class="terms__return col-md-12 col-lg-11 col-xl-10 p-0">
                <router-link data-aos="fade-left" data-aos-delay="600" class="back-btn" :to="{ name: 'home' }">
                    <i class="icon-left-open-big arrow"></i>
                    {{translate('returnHome')}}
                </router-link>
            </div>
        </div>
        <div class="terms-article container--lg">
            <div class="terms-article__pages p-0 d-flex flex-column justify-content-start align-items-center col-md-12 col-lg-11 col-xl-10">
                <div class="page" v-for="page in articles" :key="page.id">
                    <div class="page__header d-flex flex-row justify-content-between align-items-center p-0" @click="expandPage(page.id)">
                        <div :id="page.id" class="page__header-content d-flex flex-column justify-content-center align-items-start p-0">
                            <h3 class="title">{{page.title}}</h3>
                        </div>
                        <span class="page__header-expand">
                            <i class="icon-up-open-big page__header-expand__button" :class="{'arrow-down':expandedPageId === page.id}">
                            </i>
                        </span>
                    </div>
                    <transition name="terms">
                        <div class="page__content-wrapper" v-show="expandedPageId === page.id">
                            <div class="page__content d-flex" v-html="page.content">
                            </div>
                        </div>
                    </transition>
                </div>
                <div class="page">
                    <div class="page__header d-flex flex-row justify-content-between align-items-center p-0">
                        <div class="page__header-content d-flex flex-column justify-content-center align-items-start p-0">
                            <h3 class="last-title">{{section.fields.last_article.value}}</h3>
                            <a class="cta" target="_blank" :href="section.fields.pdf.value[0].url">{{translate('downloadPDF')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { metaConfig, formatMeta } from '../formatMeta';
import LogoMeta from './components/LogoMeta';

export default {
    name: 'LegalPage',
    props: ['section'],
    components: {
        LogoMeta
    },
    data() {
        return {
            expandedPageId: null,
        }
    },
    mixins: [metaConfig],
    mounted () {
        if (this.section) {
            this.params = formatMeta(this.section)
            this.$nextTick( () => {
                this.$emit('updateHead')
            })
        };
    },
    computed: {
        homepage() {
            return this.$store.getters.getSectionByType('home')
        },
        articles() {
            return this.section.collections.find(c => c.type === 'terms').pages;
        }
    },
    methods: {
        expandPage(id) {
            const activePage = document.getElementById(id);
            if (id !== this.expandedPageId) {
                this.expandedPageId = id;
            } else {
                this.expandedPageId = null
            };

            setTimeout(() => {
                activePage.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' });
            }, 140)
        }
    }
}
</script>