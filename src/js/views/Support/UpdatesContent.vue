<template>
    <div class="updates-content d-flex px-0 flex-column justify-content-start align-items-center">
        <div class="updates-wrapper d-flex col-md-12 col-lg-11 col-xl-10 px-0">
            <div class="archives-container d-flex flex-column px-0">
                <p class="archives__instruction">{{translate('selectArchive')}}</p>
                <ul class="archives__list d-flex">
                    <li v-for="(archive, index) in archives" :key='index' @click="showVersions(index)" :class="[collectionId === index ? 'active' : '']">
                        {{archive.name}}
                    </li>
                </ul>
            </div>
            <template v-for="(archive, index) in archives">
                <div class="page-container d-flex" :key='index' v-if="collectionId === index">
                    <div class="versions-container d-flex flex-column">
                        <p class="versions__instruction">{{translate('selectVersion')}}</p>
                        <ul class="versions__list d-flex" :class="[pageId === index ? 'versions__list-active' : 'versions__list']">
                            <li v-for="(version, index) in archive.pages" :key="index" @click="showContent(index)" :class="[pageId === index ? 'active' : '']">
                                {{version.title}}
                            </li>
                        </ul>
                    </div>
                    <template v-for="(page, index) in archive.pages">
                        <div class="text-container" :key="index" v-if="pageId === index">
                            <p class="text__instruction">{{translate('theVersion')}}</p>
                            <div class="text__content" v-html="page.content"></div>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    name: 'UpdatesContent',
    props: [
        'subsection',
        'section'
    ],
    data() {
        return {
            collectionId: null,
            pageId: null
        }
    },
    created() {
        this.archives;
    },
    mounted() {
        this.archives.reverse();
    },
    methods: {
        showVersions(id) {
            if (id !== this.collectionId) {
                this.collectionId = id;
            } 
        },
        showContent(id) {
            if (id !== this.pageId) {
                this.pageId = id;
            } 
        }
    },
    computed: {
        archives() {
            const collections = this.subsection.collections;
            return collections
        }
    },
}
</script>