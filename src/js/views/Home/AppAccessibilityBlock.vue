<template>
    <div class="app-accessibility-block">
        <div class="app-accessibility-block__wrapper col-12 d-flex flex-column justify-content-start align-items-center">
            <div class="app-accessibility-block__content" v-html="section.fields.app_accessibility.value" data-aos="fade" data-aos-delay="50"></div>
            <router-link data-aos="fade" data-aos-delay="200" :to="{name: 'section', params: {slug1: freeTestSection.slug}}" class="cta">
                {{translate('testWinbiz')}}
            </router-link>
        </div>
    </div>
</template>

<script>

export default {
    name: 'AppAccessibilityBlock',
    props: ['section'],
    computed: {
        freeTestSection() {
            return this.$store.getters.getSectionByType('free_test');
        }
    }
}
</script>