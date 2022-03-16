<template>
    <transition name="fade">
        <div class="partnership-modal d-flex flex-column align-items-center justify-content-start">
            <div class="partnership-modal__header d-flex justify-content-end align-items-center">
                <div class="cancel-button" @click='toggleModal'>
                    <div class="cancel-icon"></div>
                </div>
            </div>
            <div class="partnership-modal__body d-flex flex-column align-items-center justify-content-start">
                <h2 class="modal__title">{{translate('modalTitle')}}</h2>
                <p class="modal__subtitle">{{translate('modalSubtitle')}}</p>
                <form class="modal__radios-wrapper d-flex flex-column align-items-start justify-content-between">
                    <p class="modal__radios-title">{{translate('mainLabel')}}</p>
                    <div class="radio" v-for="(radio, index) in radios" :key="index">
                        <input ref="partner" name="training" :value="translate('training1')" :id="radio.id" class="radio__input" type="radio" />
                        <span class="radio__radio"></span>
                        <label :for="radio.id">{{radio.label}}</label>
                    </div>
                </form>
                <router-link class="cta" @click="toggleModal" :to="{name: 'subsection', params: {slug1: section.slug, slug2: subsection.slug}}">
                    {{translate('next')}}
                </router-link>
            </div>
        </div>
    </transition>
</template>

<script>

export default {
    name: 'PartnershipModal',
    props: [
        'section'
    ],
    data() {
        return {
            typeOfPartner: '',
            radios: [
                {
                    id: 0,
                    label: this.translate('training1'),
                },
                {
                    id: 1,
                    label: this.translate('training2'),
                },
                {
                    id: 2,
                    label: this.translate('training3'),
                }
            ],
        }
    },
    mounted() {
        this.$refs.partner[0].checked = true;
        this.typeOfPartner = this.$refs.partner[0].value;
        sessionStorage.setItem("typeOfPartner", this.typeOfPartner);
    },
    methods: {
        toggleModal() {
            this.$emit('toggleModal');
        },
    },
    computed: {
        subsection() {
            return this.section.children.find(ch => ch.type === 'partnership')
        },
    },
}
</script>