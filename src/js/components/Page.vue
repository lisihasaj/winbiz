<template>
    <transition-group name="fade" mode="out-in" tag="div" appear>
        <TrainingPage :section='activeSection' :page="activePage" key="1" />
	</transition-group>
</template>

<script>
    export default {
        name: 'PageComponent',
        components: {
            TrainingPage: () => import('@/views/Trainings/TrainingPage.vue' /* webpackChunkName: "training-page" */),
        },
        data () {
            return {
                page: {},
                section: {}
            }
        },
        computed: {
            activeSection () {
                return this.$store.getters.getSectionBySlug(this.$route.params.slug1)
            },
            activePage () {
                return this.$store.getters.getPageBySlug(this.$route.params.slug3)
            }
        }
    }
</script>
