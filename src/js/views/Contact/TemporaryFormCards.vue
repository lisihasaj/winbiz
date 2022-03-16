<template>
    <div class="temporary-cards d-flex flex-column align-items-center justify-content-start">
        <div class="temporary-cards__container d-flex">
            <label data-aos="fade-up" data-aos-delay="100" v-for="(card, index) in cards" :key="index" class="card">
                <input name="etape3" class="card__input" type="radio" >
                <div @click="setShowContactForm(card.type)" :class="{'card__wrapper active' : cardId === card.type}" class="card__wrapper d-flex flex-column align-items-center justify-content-between">
                    <h6>{{card.title}}</h6>
                    <div v-html="card.content" class="card__description d-flex justify-content-center align-items-center"></div>
                    <span class="card__link">{{card.fields.link.value}}</span>
                </div>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TemporaryFormCards',
    props: [
        'section',
        'cardId'
    ],
    methods: {
        setShowContactForm(query) {
            if(query !== this.cardId)
                this.$parent.cardId = query;
        }
    },
    computed: {
        cards() {
            const collection = this.section.collections.find(c => c.type === 'temporary_cards').pages;
            return collection;
        }
    },
}
</script>