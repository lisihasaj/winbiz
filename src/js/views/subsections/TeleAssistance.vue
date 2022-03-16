<template>
    <div class="tele-assistance">
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
    name: 'TeleAssistance',
    props: ['subsection', 'section'],
    components: {
        SubsectionHeader,
        SubsectionBody: () => import('@/views/components/SubsectionBody.vue' /*webpackChunkName: "subsection-body"*/),
        ExternalPages
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
            const content = {
                heading: this.subsection.content,
                ctaRoute: 'https://www.islonline.net/start/ISLLightClient',
                ctaLabel: this.translate('downloadTool')
            }
            return content
        }
    },
}
</script>