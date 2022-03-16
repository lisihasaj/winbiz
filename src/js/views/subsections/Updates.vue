<template>
    <div class="updates">
        <div class="container--lg">
            <div class="d-flex flex-column align-items-center">
                <SubsectionHeader :headerContent='headerContent' :section='section' :subsection="subsection" />
                <UpdatesContent :section='section' :subsection='subsection' />
                <ExternalPages :section='section' :subsection='subsection' />
            </div>
        </div>
    </div>
</template>

<script>
import { find } from '@/helpers'
import { metaConfig, formatMeta } from '../../formatMeta';
import SubsectionHeader from '../components/SubsectionHeader';
import ExternalPages from '../Support/ExternalPages';

export default {
    name: 'Updates',
    props: ['subsection', 'section'],
    mixins: [metaConfig],
    components: {
        SubsectionHeader,
        ExternalPages,
        UpdatesContent: () => import('@/views/Support/UpdatesContent.vue' /*webpackChunkName: "updates-content"*/),
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
            return {
                heading: this.subsection.content,
            }
        }
    },
}
</script>