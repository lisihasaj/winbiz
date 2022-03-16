<template>
	<transition-group name="fade" mode="out-in" tag="div" appear>
        <ProductDetails v-if="subsection && subsection.type == 'product_specs'" :section='section' :subsection="subsection" key="1" />
        <AssistanceVIP v-else-if="subsection && subsection.type == 'assistance_vip'" :section='section' :subsection="subsection" key="2" />
        <Updates v-else-if="subsection && subsection.type == 'updates'" :section='section' :subsection="subsection" key="3" />
        <Downloads v-else-if="subsection && subsection.type == 'downloads'" :section='section' :subsection="subsection" key="4" />
        <WinbizPartnership v-else-if="subsection && subsection.type == 'partnership'" :section='section' :subsection="subsection" key="6" />
        <TeleAssistance v-else-if="subsection && subsection.type == 'tele_assistance'" :section='section' :subsection="subsection" key="7" />
        <JobOffer v-else-if="section.type == 'winbiz'" :section='section' :subsection="subsection" key="8" />
        <SmsGateway v-else-if="subsection.type == 'sms_gateway'" :section='section' :subsection="subsection" key="9" />
	</transition-group>
</template>

<script>
    import { metaConfig, formatMeta } from '../formatMeta'

    export default {
        name: 'SubsectionComponent',
		components: {
            ProductDetails: () => import('@/views/subsections/ProductDetails.vue' /* webpackChunkName: "product-details" */),
            AssistanceVIP: () => import('@/views/subsections/AssistanceVIP.vue' /* webpackChunkName: "assistance-vip" */),
            Updates: () => import('@/views/subsections/Updates.vue' /* webpackChunkName: "updates" */),
            Downloads: () => import('@/views/subsections/Downloads.vue' /* webpackChunkName: "downloads" */),
            WinbizPartnership: () => import('@/views/subsections/WinbizPartnership.vue' /* webpackChunkName: "winbiz-partnership" */),
            TeleAssistance: () => import('@/views/subsections/TeleAssistance.vue' /* webpackChunkName: "tele-assistance" */),
            JobOffer: () => import('@/views/subsections/JobOffers.vue' /* webpackChunkName: "jon-offer" */),
            SmsGateway: () => import('@/views/subsections/SmsGateway.vue' /* webpackChunkName: "sms-gateway" */)
        },
        created: function () {
            this.fetchData()
        },
        watch: {
            $route: function () {
                this.fetchData()
            }
        },
        data() {
            return {
                section: {},
                subsection: {}
            }
        },
        mixins: [metaConfig],
        methods: {
            fetchData() {
                const section = this.$store.getters.getSectionBySlug(this.$route.params.slug1);
                const subsection = section.children.find(ss => ss.slug === this.$route.params.slug2);
                this.section = section;
                this.subsection = subsection;
            }
        }
    }
</script>


