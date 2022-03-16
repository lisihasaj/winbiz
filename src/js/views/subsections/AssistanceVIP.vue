<template>
    <div class="assistance-vip">
        <div class="container--lg">
            <div class="d-flex flex-column align-items-center">
                <SubsectionHeader :headerContent='headerContent' :section='section' :subsection="subsection" />
                <SubsectionBody :subsection='subsection' :section='section' />
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
    name: 'AssistanceVIP',
    props: ['subsection', 'section'],
    components: {
        SubsectionHeader,
        ExternalPages,
        SubsectionBody: () => import('@/views/components/SubsectionBody.vue' /*webpackChunkName: "subsection-body"*/),
    },
    mixins: [metaConfig],
    mounted () {
        if (this.subsection) {
            this.params = formatMeta(this.subsection)
            this.$nextTick(() => {
                this.$emit('updateHead')
            })
        }
    },
    computed: {
        headerContent() {
            return {
                heading: this.subsection.content,
                ctaRoute: 'https://www.islonline.com/downloads/index.htm',
                ctaLabel: this.translate('supportChildCta')
            }
        }
    },
}
</script>