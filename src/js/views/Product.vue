<template>
    <div class="product">
        <SectionHeader :section='section' :headerContent='headerContent' @goToProductBlock="goToProductBlock" />
        <WhyWinbiz :section='section' />
        <DownloadAppBlock :downloadAppBlockContent='downloadAppBlockContent' />
        <ProductBlock :section='section' :productBlockContent='productBlockContent' id="product-block" />
        <WinbizPlusOptions />
    </div>
</template>

<script>
import { find } from '@/helpers';

export default {
    props: ['section'],
    name: 'Product',
    components: {
        SectionHeader: () => import('@/views/components/SectionHeader.vue' /*webpackChunkName: "section-header"*/),
        WhyWinbiz: () => import('@/views/Product/WhyWinbiz.vue' /*webpackChunkName: "why-winbiz"*/),
        DownloadAppBlock: () => import('@/views/components/DownloadAppBlock.vue' /*webpackChunkName: "download-app-block"*/),
        ProductBlock: () => import('@/views/components/ProductBlock.vue' /*webpackChunkName: "product-block"*/),
        WinbizPlusOptions: () => import('@/views/components/WinbizPlusOptions.vue' /*webpackChunkName: "winbiz-plus-options"*/),
    },
    methods: {
        goToProductBlock() {
            document.getElementById('product-block').scrollIntoView({
                behavior: 'smooth'
            });
        }
    },
    computed: {
        headerContent() {
            const headings = this.section.content;
            const s = this.section.children.find(ss => ss.type === 'product_specs')
            const backgroundColor = `#000`;
            let content = {
                text: headings,
                backgroundCover: {backgroundColor},
                subsection: s,
                subsectionBtn: `${this.translate('headerCta1')}`,
                externalBtn: `${this.translate('orderPackCta')}`,
                externalRoute: `${this.$memberSpaceUrl}/${this.$route.params.locale}/signup/`
            }
            return content
        },
        downloadAppBlockContent() {
            const collection = find(this.section.collections, 'type', 'download_app_block');
            const pageBySlug = collection?.pages.find(p => p.type === 'product_dab')
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
                cardTwo: page.fields.card_2_list.value,
                number: '69.-'
            }
            return content;
        }
    }
}
</script>