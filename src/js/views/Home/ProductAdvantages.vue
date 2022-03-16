<template>
    <div class="product-advantages">
        <div class="wrapper container--lg">
            <h1 data-aos="fade" class="product-advantages__title">
                {{translate('paTitle')}}
            </h1>
            <div data-aos="fade" data-aos-delay="300" class="product-advantages__container d-flex p-0 col-lg-12 col-xl-10" v-html="section.fields.product_advantages.value">
            </div>
            <router-link data-aos="fade" data-aos-delay="200" :to="{name: 'section', params: {slug1: contact.slug}}" class="cta">
                {{translate('paCta')}}
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductAdvantages',
    props: ['section'],
    computed: {
        contact() {
            return this.$store.getters.getSectionByType('contact');
        }
    }
}
</script>