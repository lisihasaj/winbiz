<template>
    <div class="trainings-wrapper px-0 col-md-12 col-xl-10">
        <p class="trainings__title">{{translate('extraRoutesTitle')}}</p>
        <div class="trainings__cards d-flex">
            <router-link class="trainings__card d-flex align-items-center justify-content-center" v-for="(card, index) in cardsContent" :key="index" :to="{name: 'page', params: { slug1: section.slug, slug2: card.parentSlug, slug3: card.slug }}">
                <div class="trainings__card-labels d-flex flex-column align-items-start justify-content-center">
                    <h5 class="page">{{card.title}}</h5>
                    <p class="collection">{{card.parentName}}</p>
                </div>
                <!-- <p class="path-text">voir le contenu de la formation</p> -->
                <div class="route">
                    <img class="route__image" :src="`${card.fields.theme_images.value[0].url}`" />
                </div>
            </router-link>
        </div>
        <div class="d-flex justify-content-end align-items-center trainings__return">
            <router-link v-if="!collection" class="back-btn" :to="{ name: 'page', params: { slug1: section.slug, slug2: section.collections[0].slug, slug3: section.collections[0].pages[0].slug }}">
                {{translate('backToAllTrainings')}}
            </router-link>
        </div>
    </div>
</template>

<script>

export default {
    name: 'SharedRoutesBlock',
    props: [
        'cardsContent', 
        'section',
        'collection'
    ]
}
</script>