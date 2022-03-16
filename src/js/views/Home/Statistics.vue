<template>
    <div class="statistics">
        <div class="container-lg d-flex justify-content-start flex-column align-items-center">
            <div v-html="section.fields.statistics.value" class="statistics-wrapper col-sm-12 col-md-11 col-xl-10 p-0 d-flex" data-aos="fade">
            </div>
            <router-link data-aos="fade" data-aos-delay="200" class="cta" :to="{name: 'section', params: {slug1: product.slug}}">
                {{translate('seeMoreCta')}}
            </router-link>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Statistics',
    props: ['section'],
    computed: {
        product() {
            return this.$store.getters.getSectionByType('product')
        }
    }
}
</script>