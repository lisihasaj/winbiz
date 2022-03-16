<template>
    <div class="partnership-form d-flex justify-content-center align-items-start">
        <div class="partnership-form__container container--lg d-flex flex-column justify-content-start align-items-center">
            <template v-if="!showMessage">
                <FormPartOne :showFormTwo='showFormTwo' @setShowFormTwo='setShowFormTwo' :formData.sync="formData" />
                <FormPartTwo v-if="showFormTwo" :showFormTwo='showFormTwo' @setShowFormTwo='setShowFormTwo' :showFormThree='showFormThree' @setShowFormThree='setShowFormThree' :formData.sync='formData' />
                <FormPartThree v-if="showFormThree" :showFormThree='showFormThree' @setShowFormThree='setShowFormThree' @setShowMessage='setShowMessage' :formData.sync='formData' />
            </template>
            <transition name="fade">
                <FormCompletitionMessage :messageContent='messageContent' v-if="showMessage" />
            </transition>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
    name: 'PartnershipForm',
    props: [
        'section',
        'subsection'
    ],
    components: {
        FormPartOne: () => import('@/views/Winbiz/FormPartOne.vue' /*webpackChunkName: "form-part-one"*/),
        FormPartTwo: () => import('@/views/Winbiz/FormPartTwo.vue' /*webpackChunkName: "form-part-two"*/),
        FormPartThree: () => import('@/views/Winbiz/FormPartThree.vue' /*webpackChunkName: "form-part-three"*/),
        FormCompletitionMessage: () => import('@/views/components/FormCompletitionMessage.vue' /*webpackChunkName: "form-completition-message"*/),
    },
    data() {
        return {
            showMessage: false,
            showFormTwo: false,
            showFormThree: false,
            formData: {}
        }
    },
    beforeDestroy() {
        sessionStorage.clear()
    },
    methods: {
        setShowFormTwo() {
            this.showFormTwo = !this.showFormTwo
        },
        setShowFormThree() {
            this.showFormThree = !this.showFormThree
        },
        setShowMessage() {
            this.showMessage = !this.showMessage
        }
    },
    computed: {
        ...mapState([
            'sections'
        ]),
        messageContent() {
            const text = this.subsection.fields.form_completition_message.value;
            const homePage = this.sections.find(s => s.type === 'home');
            let content = {
                message: text,
                home: homePage,
                btnLabel: `${this.translate('returnHome')}`
            };
            return content
        }
    },
}
</script>