<template>
    <div class="product-details d-flex flex-column align-items-center justify-content-start">
        <LogoMeta />
        <div class="product-details__header container--lg">
            <div class="product-details__content d-flex flex-column justify-content-start align-items-center">
                <h1 data-aos="fade-up" data-aos-delay="300" class="title">{{ collection.description }}</h1>
                <a data-aos="fade-up" data-aos-delay="400" class="cta" :href="`${$memberSpaceUrl}/${this.$route.params.locale}/signup/`">
                    {{translate('orderPackCta')}}
                </a>
            </div>
            <div class="product-details__return col-md-12 col-lg-11 col-xl-10 p-0">
                <router-link data-aos="fade-left" data-aos-delay="600" class="back-btn" :to="{ name: 'section', params: { slug1: section.slug }}">
                    <i class="icon-left-open-big arrow"></i>
                    {{translate('productReturn')}}
                </router-link>
            </div>
        </div>
        <ProductSpecifications :specs='specs' />
        <DownloadAppBlock :downloadAppBlockContent='downloadAppBlockContent' />
    </div>
</template>

<script>
import { find } from '@/helpers'
import { metaConfig, formatMeta } from '../../formatMeta';
import LogoMeta from '../components/LogoMeta';

export default {
    name: 'ProductDetails',
    props: ['subsection', 'section'],
    components: {
        LogoMeta,
        ProductSpecifications: () => import('@/views/Product/ProductSpecifications.vue' /*webpackChunkName: "product-specifications"*/),
        DownloadAppBlock: () => import('@/views/components/DownloadAppBlock.vue' /*webpackChunkName: "download-app-block"*/),
    },
    mixins: [metaConfig],
    mounted () {
        if (this.subsection) {
            this.params = formatMeta(this.subsection)
            this.$nextTick( () => {
                this.$emit('updateHead')
            })
        };
    },
    computed: {
        collection () {
            return find(this.subsection.collections, 'type', 'product_specifications')
        },
        specs () {
            return this.collection.pages
        },
        downloadAppBlockContent() {
            const collection = find(this.section.collections, 'type', 'download_app_block');
            const pageBySlug = collection?.pages.find(p => p.type === 'product_details_dab')
            const content = {
                title: pageBySlug.content,
                coverImage: pageBySlug.fields.cover.value[0].url
            }
            return content
        },
    }
}
</script>