<template>
    <div class="partners">
        <div class="partners__wrapper container--lg">
            <h1 class="partners__title">{{translate('hpTitle')}}</h1>
            <div class="partners__logos col-md-12 col-xl-10 d-flex justify-content-between align-items-center">
                <div class="partners__logos-wrapper" v-for="(logo, index) in partnerLogos" :key="index">
                    <img class="logo" :src="logo.url" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Partners',
    props: ['section'],
    computed: {
        partnerLogos() {
            return this.section.fields.partners.value;
        }
    }
}
</script>