<template>
    <div class="winbiz-partnership">
        <ChildrenHeader :section='section' :headerContent='headerContent' :label="translate('returnToPartners')" />
        <PartnershipForm :section='section' :subsection='subsection' />
    </div>
</template>

<script>
import { metaConfig, formatMeta } from '../../formatMeta';

export default {
    name: 'WinbizPartnership',
    mixins: [metaConfig],
    props: [
        'section',
        'subsection'
    ],
    components: {
        ChildrenHeader: () => import('@/views/Winbiz/ChildrenHeader.vue' /*webpackChunkName: "children-header"*/),
        PartnershipForm: () => import('@/views/Winbiz/PartnershipForm.vue' /*webpackChunkName: "partnership-form"*/),
    },
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
            const header = this.subsection.content;
            let content = {
                text: header
            };
            return content
        }
    }
}
</script>