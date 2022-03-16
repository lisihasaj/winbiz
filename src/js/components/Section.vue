<template>
	<transition-group name="fade" mode="out-in" tag="div" appear>
		<Community v-if="section.type == 'community'" :section="section" key="1" />
		<Product v-if="section.type == 'product'" :section="section" key="2" />
		<Support v-if="section.type == 'support'" :section="section" key="3" />
		<AboutWinbiz v-if="section.type == 'winbiz'" :section="section" key="4" />
		<Trainings v-if="section.type == 'trainings'" :section='section' key="5" />
		<Contact v-if="section.type == 'contact'" :section='section' key="6" />
		<LegalPage v-if="section.type == 'terms'" :section='section' key="7" />
		<FreeTestAppBlock v-if="section.type == 'free_test'" :section='section' key="8" />
		<WinbizLocal v-if="section.type == 'winbiz_local'" :section='section' key="9" />
	</transition-group>
</template>

<script>
	import { metaConfig, formatMeta } from '../formatMeta'
	export default {
		name: 'SectionComponent',
		components: {
			Community: () => import('@/views/Community.vue' /* webpackChunkName: "community" */),
			Product: () => import('@/views/Product.vue' /* webpackChunkName: "product" */),
			Support: () => import('@/views/Support.vue' /* webpackChunkName: "support" */),
			AboutWinbiz: () => import('@/views/AboutWinbiz.vue' /* webpackChunkName: "about-winbiz" */),
			Trainings: () => import('@/views/Trainings.vue' /* webpackChunkName: "trainings" */),
			Contact: () => import('@/views/Contact.vue' /* webpackChunkName: "contact" */),
			LegalPage: () => import('@/views/LegalPage.vue' /* webpackChunkName: "legal-page" */),
			FreeTestAppBlock: () => import('@/views/FreeTestAppBlock.vue' /* webpackChunkName: "free-test-app-block" */),
			WinbizLocal: () => import('@/views/WinbizLocal.vue' /* webpackChunkName: "winbiz-local" */),
		},
		created: function () {
			this.fetchData()
		},
		watch: {
			$route: function () {
				this.fetchData()
			}
		},
		data() {
			return {
				section: {},
			}
		},
		mixins: [metaConfig],
		methods: {
			fetchData() {
				const section = this.$store.getters.getSectionBySlug(this.$route.params.slug1)

				if (!section) {
					this.$router.push({name: 'not-found'})
					return;
				} else {
					this.setData(section)
				}
			},
			setData (section) {
				this.section = section;            

				this.params = formatMeta(this.section)
				this.$nextTick( () => {
					this.$emit('updateHead')
				})
			}
		}
	}
</script>


