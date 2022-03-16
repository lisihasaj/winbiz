<template>
    <div class="free-test d-flex flex-column align-items-center justify-content-start">
        <LogoMeta />
        <div class="free-test__header container--lg">
            <div class="free-test__content d-flex flex-column justify-content-start align-items-center">
                <h1 data-aos="fade" data-aos-delay="300" class="title">{{section.title}}</h1>
            </div>
        </div>
        <template v-if="!showMessage">
            <div class="free-test__return container--lg d-flex justify-content-center">
                <div class="col-md-12 col-lg-11 col-xl-10 px-0 w-100">
                    <router-link data-aos="fade-left" data-aos-delay="600" class="back-btn" :to="{ name: 'section', params: { slug1: homepage.slug }}">
                        <i class="icon-left-open-big arrow"></i>
                        {{translate('returnHome')}}
                    </router-link>
                </div>
            </div>
            <div class="free-test__main container--lg d-flex align-items-center justify-content-center">
                <div class="free-test__container px-0 col-md-12 col-lg-11 col-xl-10 d-flex flex-column align-items-center justify-content-center">
                    <div class="description" v-html="section.content"></div>
                    <FreeTestForm :section="section" />
                </div>
            </div>
        </template>
        <FormCompletitionMessage :messageContent='messageContent' v-if="showMessage" />
    </div>
</template>

<script>
import { metaConfig, formatMeta } from '../formatMeta';
import LogoMeta from './components/LogoMeta';

export default {
    name: 'FreeTestAppBlock',
    props: [
        'section'
    ],
    components: {
        LogoMeta,
        FreeTestForm: () => import('@/views/components/FreeTestForm.vue' /*webpackChunkName: "free-test-form"*/),
        FormCompletitionMessage: () => import('@/views/components/FormCompletitionMessage.vue' /*webpackChunkName: "form-completition-message"*/),
    },
    data() {
        return {
            showMessage: false
        }
    },
    mixins: [metaConfig],
    mounted () {
        if (this.section) {
            this.params = formatMeta(this.section)
            this.$nextTick( () => {
                this.$emit('updateHead')
            })
        };
    },
    computed: {
        homepage() {
            return this.$store.getters.getSectionByType('home');
        },
        messageContent() {
            const text = this.section.fields.form_completition_message.value;
            const homePage = this.homepage;
            let content = {
                message: text,
                home: homePage,
                btnLabel: `${this.translate('returnHome')}`
            };
            return content;
        }
    }
}
</script>