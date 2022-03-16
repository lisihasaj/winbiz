<template>
    <div class="home">
        <HomeHeader :section='section' />
        <Statistics :section='section' />
        <ProductBlock :section='section' :productBlockContent='productBlockContent' />
        <AppAccessibilityBlock :section='section' />
        <DownloadAppBlock :downloadAppBlockContent='downloadAppBlockContent' />
        <ProductAdvantages :section='section' />
        <WinbizPlusOptions />
        <!-- <Partners :section='section' />
        <Testimonials :section='section' /> -->
    </div>
</template>

<script>
import { find } from '@/helpers';
import { metaConfig, formatMeta } from '../formatMeta'
export default {
    name: 'Home',
    components: {
        HomeHeader: () => import('@/views/Home/HomeHeader.vue' /*webpackChunkName: "home-header"*/),
        Statistics: () => import('@/views/Home/Statistics.vue' /*webpackChunkName: "statistics"*/),
        ProductBlock: () => import('@/views/components/ProductBlock.vue' /*webpackChunkName: "product-block"*/),
        AppAccessibilityBlock: () => import('@/views/Home/AppAccessibilityBlock.vue' /*webpackChunkName: "app-accessibility-block"*/),
        DownloadAppBlock: () => import('@/views/components/DownloadAppBlock.vue' /*webpackChunkName: "download-app-block"*/),
        ProductAdvantages: () => import('@/views/Home/ProductAdvantages.vue' /*webpackChunkName: "product-advantages"*/),
        WinbizPlusOptions: () => import('@/views/components/WinbizPlusOptions.vue' /*webpackChunkName: "winbiz-plus-options"*/),
        Partners: () => import('@/views/Home/Partners.vue' /*webpackChunkName: "partners"*/),
        Testimonials: () => import('@/views/Home/Testimonials.vue' /*webpackChunkName: "testimonials"*/),
    },
    mixins: [metaConfig],
    created: function () {
      this.setData()
    },
    methods: {
      setData () {
        if (!this.section) {
            this.$router.push({name: 'not-found'})
            return;
        };
        
        this.params = formatMeta(this.section)
        this.$nextTick( () => {
          this.$emit('updateHead')
        })
      }
    },    
    computed: {
        section() {
            return this.$store.getters.getSectionByType('home')
        },
        downloadAppBlockContent() {
            const collection = find(this.section.collections, 'type', 'download_app_block');
            const pageBySlug = collection.pages.find(p => p.type === 'home_dab')
            const content = {
                title: pageBySlug.content,
                coverImage: pageBySlug.fields.cover.value[0].url
            }
            return content
        },
        productBlockContent() {
            const section = this.$store.getters.getSectionByType('shared_components');
            const collection = section.collections.find(c => c.type === 'product_block');
            const page = collection.pages.find(p => p.type === 'product_block');
            let content = {
                header: page.content,
                cardOne: page.fields.card_1.value,
                cardTwo: page.fields.card_2.value,
                number: '69.-'
            }
            return content;
        }
    }
}
</script>