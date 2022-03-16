<template>
    <div class="sms-gateway">
        <div class="container--lg">
            <div class="d-flex flex-column align-items-center">
                <SubsectionHeader :headerContent='headerContent' :section='section' :subsection="subsection" @toggleForm="toggleForm" :showForm="showForm" :showMessage="showMessage" />
                <template v-if="!showMessage">
                    <SubsectionBody :subsection='subsection' :section='section' v-if="!showForm" />
                    <ExternalPages :section="supportSection" :subsection="teleAssistance" v-if="!showForm" />
                    <SmsGatewayForm v-if="showForm" />
                </template>
                <FormCompletitionMessage :messageContent='messageContent' v-if="showMessage" />
            </div>
        </div>
    </div>
</template>

<script>
import { metaConfig, formatMeta } from '../../formatMeta';
import SubsectionHeader from '../components/SubsectionHeader.vue';
import ExternalPages from '../Support/ExternalPages.vue';

export default {
    name: 'SmsGateway',
    props: ['subsection', 'section'],
    components: {
        SubsectionHeader,
        SubsectionBody: () => import('@/views/components/SubsectionBody.vue' /*webpackChunkName: "subsection-body"*/),
        ExternalPages,
        SmsGatewayForm: () => import('@/views/Product/SmsGatewayForm.vue' /*webpackChunkName: "sms-gateway-form"*/),
        FormCompletitionMessage: () => import('@/views/components/FormCompletitionMessage.vue' /*webpackChunkName: "form-completition-message"*/),
    },
    data() {
        return {
            showForm: false,
            showMessage: false
        }
    },
    mixins: [metaConfig],
    mounted () {
        if (this.subsection) {
            this.params = formatMeta(this.subsection)
            this.$nextTick(() => {
                this.$emit('updateHead')
            })
        };
    },
    methods: {
        toggleForm() {
            this.showForm = true;
        }
    },
    computed: {
        headerContent() {
            return {
                heading: this.subsection.content,
                ctaLabel: `${this.translate('order')}`
            };
        },
        supportSection() {
            return this.$store.getters.getSectionByType('support');
        },
        teleAssistance() {
            return this.supportSection.children.find(ss => ss.type === 'tele_assistance');
        },
        messageContent() {
            const text = this.subsection.fields.form_completition_message.value;
            const homePage = this.$store.getters.getSectionByType('home');
            return {
                message: text,
                home: homePage,
                btnLabel: this.translate('returnHome')
            };
        }
    }
}
</script>