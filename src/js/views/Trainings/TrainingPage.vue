<template>
    <div class="training-page">
        <LogoMeta />
        <div :style="{backgroundImage: `url(${pageCover})`}" class="training-page__header d-flex justify-content-center">

            <div class="header__container container--lg d-flex flex-column align-items-center justify-content-end">
                <div class="header__content d-flex flex-column align-items-center justify-content-between px-0 col-md-12 col-lg-11 col-xl-10">
                    <div class="header__text" v-html="section.content"></div>
                    <ul class="header__formations-nav">
                        <li ref="collectionNavLink" v-for="collection in section.collections" :key="collection.id" :class="{'active-collection': collection.slug === activeCollection.slug}">
                            <router-link class="link" :to="{name: 'page', params: { slug1: section.slug, slug2: collection.slug, slug3: collection.pages[0].slug } }">
                                {{collection.name}}
                            </router-link>
                        </li>
                    </ul>
                    <div class="header__custom-dropdown" :class="{'open': open}">
                        <span class="selected-option" @click="open = !open">
                            {{activeCollection.name}}
                        </span>
                        <div @click="open = false" class="list">
                            <router-link class="option" v-for="collection in section.collections" :key="collection.id" :to="{name: 'page', params: { slug1: section.slug, slug2: collection.slug, slug3: collection.pages[0].slug }}" v-show="collection.slug !== activeCollection.slug">
                                {{collection.name}}
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="header__return">
                    <router-link class="back-btn" :to="{ name: 'section', params: { slug1: community.slug }}">
                        {{translate('returnToCommunity')}}
                    </router-link>
                </div>
            </div>

        </div>
        <div class="training-page__collections px-0">
            <div class="training-page__pages d-flex flex-column align-items-center justify-content-start">

                <ul class="page__nav d-flex px-0 col-md-12 col-lg-10 col-xl-9">
                    <router-link class="page__nav-links" v-for="page in activeCollection.pages" :key='page.d' :to="{ name: 'page', params: { slug1: section.slug, slug2: activeCollection.slug, slug3: page.slug } }">
                        {{page.title}}
                    </router-link>
                </ul>

                <div class="page__body d-flex flex-column align-items-center justify-content-start">

                    <div class="page__content px-0 col-11 col-md-11 col-lg-9 col-xl-8" v-html="activePage.content" :class="{'se-content': activeCollection.type === 'support_training'}"></div>

                    <template v-if="activePage.type === 'personalized_course'">
                        <MapBlock :content="courseMapContent" :section="section" />
                        <div class="page__personalized-content px-0 col-11 col-md-11 col-lg-10 col-xl-9" v-html="personalizedCourse.fields.content2.value"></div>
                    </template>

                    <div v-if="activePage.type !== 'personalized_course' && activeCollection.type !== 'support_training'" class="extra-routes d-flex flex-column align-items-center justify-content-center">
                        <div class="subscribe-wrapper px-0 col-11 col-md-11 col-lg-10 col-xl-9">
                            <p class="subscribe__title">{{translate('subscribeBtnTitle')}}</p>
                            <router-link class="cta" :to="{name: 'subscribe', params: { slug1: $route.params.slug1, slug2: $route.params.slug2, slug3: $route.params.slug3, trainingId: activePage.id }}">
                                {{subscribe.title}}
                            </router-link>
                        </div>
                    </div>

                    <div class="trainings-wrapper px-0 col-11 col-md-11 col-lg-10 col-xl-9">
                        <p class="trainings__title">{{translate('extraRoutesTitle')}}</p>
                        <div class="trainings__cards d-flex">
                            <router-link class="trainings__card d-flex align-items-center justify-content-center" v-for="(card, index) in cardsContent" :key="index" :to="{name: 'page', params: { slug1: section.slug, slug2: card.parentSlug, slug3: card.slug }}">
                                <div class="trainings__card-labels d-flex flex-column align-items-start justify-content-center">
                                    <h5 class="page">{{card.title}}</h5>
                                    <p class="collection">{{card.parentName}}</p>
                                </div>
                                <div class="route">
                                    <img class="route__image" :src="`${card.fields.theme_images.value[0].url}`" />
                                </div>
                            </router-link>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LogoMeta from '../components/LogoMeta';
import { metaConfig, formatMeta } from '../../formatMeta'

export default {
    name: 'TrainingPage',
    props: ['section'],
    mixins: [metaConfig],
    components: {
        LogoMeta,
        MapBlock: () => import('@/views/components/MapBlock.vue' /*webpackChunkName: "map-block"*/),
    },
    data() {
        return {
            open: false
        }
    },
    mounted () {     

        if (!this.activePage) {
            this.$router.push({name: 'home'})
            return;
        }


        this.params = formatMeta(this.activePage)
        this.$nextTick( () => {
            this.$emit('updateHead')
        })


        
    },
    watch: {
        'activePage': function (value) {
            console.log(value)
        }
    },
    computed: {
        community() {
            return this.$store.getters.getSectionByType('community');
        },
        subscribe() {
            return this.section.children.find(ch => ch.type === 'subscribe')
        },
        activePage () {
            return this.$store.getters.getPageBySlug(this.$route.params.slug3);
        },
        activeCollection() {
            return this.section.collections.find(c => c.slug === this.$route.params.slug2);
        },
        pageCover () {
            return this.activePage.fields.theme_images.value[0].url;
        },
        cardsContent() {
            let collection = this.section.collections[0];
            collection.pages.map(p => {
                p.parentName = collection.name
                p.parentId = collection.id
                p.parentSlug = collection.slug
            })
            const pages = collection.pages.slice(0, 4)
            return pages
        },
        personalizedCourse() {
            return this.section.collections[0].pages.find(p => p.type === 'personalized_course');
        },
        courseMapContent() {
            const content = {
                title: this.personalizedCourse.fields.map_title.value,
                subtitle: this.personalizedCourse.fields.map_subtitle.value,
                partnerTypes: [
                    {
                        id: 0,
                        label: this.translate('training3'),
                        name: 'Winbiz Specialist',
                        description: this.personalizedCourse.fields.winbiz_specialist.value,
                        type: 'specialist'
                    }
                ],
            };
            return content;
        }
    }
}
</script>