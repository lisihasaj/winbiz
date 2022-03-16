<template>
    <transition name="fade">
        <div class="loading-component d-flex justify-content-center align-items-center" :class="{'modified': trainingSection}">
            <div class="loading-component__wrapper">
                <span class="triangle1"></span>
                <span class="triangle2"></span>
                <span class="triangle3"></span>
                <span class="triangle4"></span>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name: 'LoadingComponent',
    computed: {
        activeSection() {
            return this.$store.getters.getSectionBySlug(this.$route.params.slug1)
        },
        trainingSection() {
            const targetSection = ['formations'];
            return targetSection.includes(this.activeSection.type)
        },
    }
}
</script>