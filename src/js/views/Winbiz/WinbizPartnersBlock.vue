<template>
    <div class="partners-block">
        <div class="partners-block__container container--lg d-flex flex-column align-items-center justify-content-center">
            <div data-aos="fade-up" class="partners-block__content d-flex flex-column align-items-center justify-content-start" v-html="section.fields.partners_block.value">
            </div>
            <button data-aos="fade-up" @click='goToPartnersMap' class="cta">
                {{translate('next')}}
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'WinbizPartnersBlock',
    props: [
        'section'
    ],
    methods: {
        goToPartnersMap() {
            this.$emit('goToPartnersMap');
        } 
    }
}
</script>