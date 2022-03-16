<template>
    <div class="downloads">
        <div class="container--lg">
            <div class="d-flex flex-column align-items-center">
                <SubsectionHeader :headerContent='headerContent' :section='section' :subsection="subsection" />
                <DownloadsContent :section='section' :subsection='subsection' />
                <ExternalPages :section='section' :subsection='subsection' />
            </div>
        </div>
    </div>
</template>

<script>
import { metaConfig, formatMeta } from '../../formatMeta';
import SubsectionHeader from '../components/SubsectionHeader';
import ExternalPages from '../Support/ExternalPages';

export default {
    name: 'Downloads',
    props: ['subsection', 'section'],
    mixins: [metaConfig],
    components: {
        SubsectionHeader,
        ExternalPages,
        DownloadsContent: () => import('@/views/Support/DownloadsContent.vue' /*webpackChunkName: "downloads-content"*/),
    },
    mounted () {
        if (this.subsection) {
            this.params = formatMeta(this.subsection)
            this.$nextTick(() => {
                this.$emit('updateHead')
            })
        } else return
    },
    computed: {
        headerContent() {
            const targetSectionRoute = null;
            const content = {
                heading: this.subsection.content,
                ctaRoute: '',
                ctaLabel: this.translate('downloadWinbiz')
            }
            return content
        }
    },
}
</script>