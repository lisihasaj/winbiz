<template>
    <div class="support">
        <SectionHeader :section='section' :headerContent='headerContent' />
        <SupportPages :section="section" />
        <FormationsBlock :section='section' />
        <DownloadAppBlock :downloadAppBlockContent='downloadAppBlockContent' />
    </div>
</template>

<script>
import { find } from '@/helpers';

export default {
    name: 'Support',
    props: ['section'],
    components: {
        SectionHeader: () => import('@/views/components/SectionHeader.vue' /*webpackChunkName: "section-header"*/),
        FormationsBlock: () => import('@/views/components/FormationsBlock.vue' /*webpackChunkName: "formations-block"*/),
        DownloadAppBlock: () => import('@/views/components/DownloadAppBlock.vue' /*webpackChunkName: "download-app-block"*/),
        SupportPages: () => import('@/views/Support/SupportPages.vue' /*webpackChunkName: "support-pages"*/),
    },
    computed: {
        headerContent() {
            const headings = this.section.content;
            const s = this.section.children.find(ss => ss.type === 'faq')
            const backgroundColor = `#0000DF`;
            let content = {
                text: headings,
                backgroundCover: {backgroundColor},
                subsection: s,
                subsectionBtn: `${this.translate('goToFAQ')}`
            }
            return content
        },
        downloadAppBlockContent() {
            const collection = find(this.section.collections, 'type', 'download_app_block');
            const pageBySlug = collection?.pages.find(p => p.type === 'support_dab')
            const content = {
                title: pageBySlug.content,
                coverImage: pageBySlug.fields.cover.value[0].url
            }
            return content
        }
    }
}
</script>