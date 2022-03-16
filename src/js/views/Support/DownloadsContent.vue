<template>
    <div class="downloads-content d-flex px-0">
        <div class="downloads-wrapper col-md-12 col-lg-11 col-xl-10 px-0" v-for="(obj, index) in collections" :key="index">
            <h1 class="downloads-wrapper__title">
                {{obj.title}}
            </h1>
            <ul class="downloads-options px-0">
                <li class="downloads-option d-flex flex-column align-items-center justify-content-center" v-for="item in obj.collection.pages" :key="item.id" @click="showInstructions(item.id)" :class="[cardId === item.id ? 'downloads-active' : 'downloads-option']">
                    <div v-html="item.content" class="d-flex flex-column align-items-center"></div>
                </li>
            </ul>
            <template v-for="item in obj.collection.pages">
                <div class="downloads-text" :key="item.id" v-if="cardId === item.id">
                    <div v-html="item.fields.page_text.value" class="wrapper d-flex flex-row">
                    </div>
                    <a data-aos="fade-up" :href="`${$faqUrl}`" class="downloads-text__faq d-flex flex-row align-items-center justify-content-center">
                        <img class="icon" src="/images/faq.svg" />
                        <span class="d-flex flex-column align-items-start justify-content-center">
                            <p class="title">{{translate('needHelp')}}<br>{{translate('needHelp2')}}</p>
                            <span class="route">{{translate('seeMoreCta')}}</span>
                        </span>
                    </a>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    name: 'DownloadsContent',
    props: ['subsection', 'section'],
    data() {
        return {
            cardId: null
        }
    },
    methods: {
        showInstructions(id) {
            if (id !== this.cardId) {
                this.cardId = id;
            } else {
                this.cardId = null;
            }
        }
    },
    computed: {
        collections() {
            return [
                {
                    title: 'Winbiz Cloud',
                    collection: this.subsection.collections.find(c => c.type === 'downloads_content-cloud')
                },
                {
                    title: 'Winbiz Local',
                    collection: this.subsection.collections.find(c => c.type === 'downloads_content-local')
                }
            ]
        },
        faq() {
            return this.section.children.find(ss => ss.type === 'faq');
        }
    },
}
</script>