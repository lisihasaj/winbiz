<template>
    <div class="formations-block">
        <div class="container--lg d-flex flex-column justify-content-center align-items-start">
            <h1 class="formations-block__title">{{translate('fbTitle')}}</h1>
            <div class='formations-block__collections d-flex flex-column align-items-start justify-content-start'>
                <ul class="formations-block__navigation">
                    <li v-for="(collection, index) in trainings.collections" :key="index" @click="showCollection(index, collection.name)" :class="[collectionId === index ? 'active' : '']">
                        {{collection.name}}
                    </li>
                </ul>
                <div class="formations-block__custom-dropdown" :class="{'open': open}">
                    <span class="selected-option" @click="open = !open">
                        {{collectionName}}
                    </span>
                    <ul @click="open = false" class="list">
                        <li class="option" v-for="(collection, index) in trainings.collections" :key="index" @click="showCollection(index, collection.name)" v-show="index !== collectionId">
                            {{collection.name}}
                        </li>
                    </ul>
                </div>
                <div class="formations-block__pages">
                    <template v-for="(collection, index) in trainings.collections">
                        <div :key="index" class="formations-block__pages-container d-flex" v-if="collectionId === index">
                            <router-link class="item-wrapper" v-for="(page, index) in collection.pages" :key="index" :to="{ name: 'page', params: { slug1: trainings.slug, slug2: collection.slug, slug3: page.slug } }">
                                <div class="item-card d-flex justify-content-start align-items-end">
                                    <img v-if="checkField(page, 'theme_images')" class="item-card__image" v-lazy="`${page.fields.theme_images.value[0].url}`" />
                                </div>
                                <h5 class="item__title">{{page.title}}</h5>
                            </router-link>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { find } from '@/helpers';
import { mapState } from 'vuex';

export default {
    name: 'Formations',
    props: ['section'],
    data() {
        return {
            collectionId: 0,
            collectionName: '',
            open: false,
        }
    },
    mounted() {
        this.collectionName = this.trainings.collections[0].name;
    },
    methods: {
        showCollection(id, name) {
            if (id !== this.collectionId) {
                this.collectionId = id;
                this.collectionName = name;
            };
        },
    },
    computed: {
        ...mapState([
            'sections'
        ]),
        trainings() {
            return find(this.sections, 'type', 'trainings');
        }
    },
}
</script>