<template>
    <div class="locales" :class="{'open': open}">
        <span class="wb-btn--grey" @click="open = !open">{{$route.params.locale}}</span>
        <ul @click="open = false">
            <li v-for="l in locales" :key="l.key">
                <a :href="`/${l.key}/${l.root_slug}`" :class="{'active': $route.params.locale == l.key}" @click.prevent="changeLanguage(l.key)">
                    {{l.key}}
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'LocalesDropdown',
    data() {
        return {
            open: false,
            locales: []
        }
    },
    mounted () {
        if (window_locales) {
            let locales = JSON.parse(window_locales)
            this.locales = locales
        }
    },
    methods: {
        changeLanguage (l) {
            if (l == this.$route.params.locale) return;
            document.querySelector('body').style.opacity = 0
            let routeName = this.$route.name

            switch (routeName) {
                case 'home': {
                    window.location.href = `${window.location.origin}/${l}`
                    break;
                }
                case 'section': {
                    window.location.href = `${window.location.origin}/${l}/${this.activeSection.slugs[l]}`
                    break;
                }
                case 'subsection': {

                    if (this.activeSection.type === 'winbiz' && this.activeJobPost) {
                        window.location.href = `${window.location.origin}/${l}/${this.activeSection.slugs[l]}/${this.activeJobPost.slugs[l]}`
                    } else {
                        window.location.href = `${window.location.origin}/${l}/${this.activeSection.slugs[l]}/${this.activeSubsection.slugs[l]}`
                    }
                    break;
                }
                case 'page': {
                    window.location.href = `${window.location.origin}/${l}/${this.activeSection.slugs[l]}/${this.activeCollection.slugs[l]}/${this.activePage.slugs[l]}`
                    break;
                }
                case 'subscribe': {
                    window.location.href = `${window.location.origin}/${l}/${this.activeSection.slugs[l]}/${this.activeCollection.slugs[l]}/${this.activePage.slugs[l]}/${this.$route.params.trainingId}`
                    break;
                }
            }
        },
    },
    computed: {
        activeSection() {
            return this.$store.getters.getSectionBySlug(this.$route.params.slug1)
        },
        activeSubsection() {
            return this.activeSection.children.find(ss => ss.slug === this.$route.params.slug2);
        },
        activeCollection() {
            return this.activeSection.collections.find(c => c.slug === this.$route.params.slug2);
        },
        activeJobPost () {
            return this.$store.getters.getPageBySlug(this.$route.params.slug2)
        },
        activePage() {
            return this.$store.getters.getPageBySlug(this.$route.params.slug3)
        }
    }
}
</script>