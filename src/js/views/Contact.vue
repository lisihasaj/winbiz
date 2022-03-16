<template>
    <div class="contact">
        <div class="contact__container container--lg d-flex flex-column align-items-center justify-content-start">
            <ContactHeader :section='section' />
            <!-- <div v-if="!showMessage" id="contact" class="contact__etapes d-flex flex-column align-items-center justify-content-start px-0 col-sm-12 col-md-11 col-lg-8 col-xl-7">
                <EtapeOne :section='section' @setShowEtapeTwo='setShowEtapeTwo' :formData.sync="formData" />
                <EtapeTwo :section='section' :etapeOneCardId='etapeOneCardId' :showEtapeTwo='showEtapeTwo' v-if="showEtapeTwo" @setShowEtapeThree='setShowEtapeThree' :formData.sync="formData" />
                <EtapeThree :section='section' :showEtapeThree='showEtapeThree' v-if="showEtapeThree" @setShowContactForm='setShowContactForm' />
                <ContactForm :section='section' :showContactForm='showContactForm' v-if="showContactForm" @setShowMessage='setShowMessage' :formData.sync="formData" />
            </div> -->
            <div v-if="!showMessage" id="contact" class="contact__etapes d-flex flex-column align-items-center justify-content-start px-0 col-sm-12 col-md-11 col-xl-9">
                <TemporaryFormCards :section="section" :cardId="cardId" />
                <span id="target"></span>
                <div class="card-result-wrapper" v-if="cardId" :class="{'card-result-wrapper__wide': cardId === 'temporary_card_three'}">
                    <SupportCards v-if="cardId === 'temporary_card_three'" />
                    <TemporaryForm :cardId="cardId" :formData.sync="formData" />
                </div>
            </div>
            <transition name="fade">
                <div class="message-box" v-if="showMessage">
                    <FormCompletitionMessage :messageContent='messageContent' />
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
import ContactHeader from './Contact/ContactHeader';

export default {
    name: 'Contact',
    props: ['section'],
    components: {
        ContactHeader,
        // EtapeOne: () => import('@/views/Contact/EtapeOne.vue' /*webpackChunkName: "etape-one"*/),
        // EtapeTwo: () => import('@/views/Contact/EtapeTwo.vue' /*webpackChunkName: "etape-two"*/),
        // EtapeThree: () => import('@/views/Contact/EtapeThree.vue' /*webpackChunkName: "etape-three"*/),
        // ContactForm: () => import('@/views/Contact/ContactForm.vue' /*webpackChunkName: "contact-form"*/),
        FormCompletitionMessage: () => import('@/views/components/FormCompletitionMessage.vue' /*webpackChunkName: "form-completition-message"*/),
        TemporaryFormCards: () => import('@/views/Contact/TemporaryFormCards.vue' /*webpackChunkName: "temporary-form-cards"*/),
        TemporaryForm: () => import('@/views/Contact/TemporaryForm.vue' /*webpackChunkName: "temporary-form"*/),
        SupportCards: () => import('@/views/Contact/SupportCards.vue' /*webpackChunkName: "support-cards"*/),
    },
    data() {
        return {
            showMessage: false,
            // showEtapeTwo: false,
            // showEtapeThree: false,
            // showContactForm: false,
            // etapeOneCardId: null,
            // etapeThreeCardId: 2,
            formData: {},
            cardId: null
        }
    },
    methods: {
        // setShowEtapeTwo(id) {
        //     if(id !== this.etapeOneCardId) {
        //         this.etapeOneCardId = id;
        //         this.showEtapeTwo = false;
        //         this.showEtapeThree = false;
        //         this.showContactForm = false;
        //         this.$nextTick(() => {
        //             this.showEtapeTwo = true;
        //         })
        //     }   
        // },
        // setShowEtapeThree() {
        //     this.showEtapeThree = false;
        //     this.showContactForm = false;
        //     this.$nextTick(() => {
        //         this.showEtapeThree = true;
        //     })
        // },
        // setShowContactForm(id) {
        //     if(id === this.etapeThreeCardId)
        //         this.showContactForm = true;
        // },
        setShowMessage() {
            this.showMessage = !this.showMessage;
        }
    },
    updated() {
        if (this.cardId) {
            const target = document.getElementById('target')
            target?.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' });
        }
    },
    computed: {
        ...mapState([
            'sections'
        ]),
        messageContent() {
            const text = this.section.fields.form_completition_message.value;
            const homePage = this.sections.find(s => s.type === 'home');
            let content = {
                message: text,
                home: homePage,
                btnLabel: `${this.translate('returnHome')}`
            };
            return content;
        },
        supportSection() {
            return this.sections.find(s => s.type === 'support');
        },
        getSubsections() {
            const teleAssistance = this.supportSection.children.find(ss => ss.type === 'tele_assistance');
            const filterChildren = this.supportSection.children.filter(item => item !== teleAssistance);
            return filterChildren;
        }
    },
}
</script>