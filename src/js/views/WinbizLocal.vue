<template>
    <div class="winbiz-local">
        <LogoMeta />
        <div class="winbiz-local__header container--lg d-flex flex-column align-items-center" :class="{'winbiz-local__modified': showMessage}">
            <h1 data-aos="fade-up" data-aos-delay="300" class="title">{{section.title}}</h1>
            <div v-if="!showMessage" data-aos="fade-up" data-aos-delay="600" class="description" v-html="section.content"></div>
        </div>
        <template v-if="!showMessage">
            <ProductBlock :section='section' :productBlockContent='productBlockContent' v-if="!showForm" :showForm="showForm" />
            <WinbizLocalForm :section='section' :showMessage="showMessage" v-if="showForm" />
        </template>
        <FormCompletitionMessage :messageContent='messageContent' v-if="showMessage" />
    </div>
</template>

<script>
import LogoMeta from './components/LogoMeta.vue';

export default {
    name: 'WinbizLocal',
    props: [
        'section'
    ],
    components: {
        LogoMeta,
        ProductBlock: () => import('@/views/components/ProductBlock.vue' /*webpackChunkName: "product-block"*/),
        WinbizLocalForm: () => import('@/views/WinbizLocal/WinbizLocalForm.vue' /*webpackChunkName: "winbiz-local-form"*/),
        FormCompletitionMessage: () => import('@/views/components/FormCompletitionMessage.vue' /*webpackChunkName: "form-completition-message"*/),
    },
    data() {
        return {
            showForm: false,
            showMessage: false
        }
    },
    methods: {

    },
    computed: {
        productBlockContent() {
            const section = this.$store.getters.getSectionByType('shared_components');
            const collection = section.collections.find(c => c.type === 'product_block');
            const page = collection.pages.find(p => p.type === 'product_block');
            let content = {
                header: page.content,
                cardOne: page.fields.card_1.value,
                cardTwo: page.fields.card_2_list.value,
                number: '79.-'
            }
            return content;
        },
        messageContent() {
            const text = this.section.fields.form_completition_message.value;
            const homePage = this.$store.getters.getSectionByType('home');
            return {
                message: text,
                home: homePage,
                btnLabel: `${this.translate('returnHome')}`
            };
        }
    }
}
</script>