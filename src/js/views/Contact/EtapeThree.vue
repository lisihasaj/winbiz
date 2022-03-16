<template>
    <div id="etape-three" class="etape three d-flex flex-column align-items-center justify-content-start">
        <div data-aos="fade-right" class="etape__title" v-html="this.section.fields.etape_three.value"></div>
        <div class="etape__cards d-flex">
            <label data-aos="fade-up" data-aos-delay="100" v-for="(card, index) in cards" :key="index" class="etape-three-card">
                <input name="etape3" class="etape-three-card__input" type="radio" >
                <a :href="card.link">
                    <div @click="setShowContactForm(index)" :class="{'etape-three-card__wrapper active' : cardId === index}" class="etape-three-card__wrapper d-flex flex-column align-items-center justify-content-between">
                        <div ref="etapeThreeCards" v-html="card.contents" class="etape-three-card__upper d-flex flex-row justify-content-between align-items-center"></div>
                        <span class="etape-three-card__link">{{card.whereTo}}</span>
                    </div>
                </a>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: 'EtapeThree',
    props: [
        'section',
        'showEtapeThree'
    ],
    data() {
        return {
            cardId: null
        }
    },
    mounted() {
        if(this.showEtapeThree) {
            return document.getElementById('etape-three').scrollIntoView({
                behavior: 'smooth'
            })
        };
    },
    methods: {
        setShowContactForm(id) {
            this.$emit('setShowContactForm', id);
            if(id !== this.cardId)
                this.cardId = id;
            else
                this.cardId = null;
        }
    },
    computed: {
        cards() {
            const collection = this.section.collections.find(c => c.type === 'etape_three');
            const card1 = collection.pages.find(p => p.type === 'faq');
            const card2 = collection.pages.find(p => p.type === 'telephone');
            const card3 = collection.pages.find(p => p.type === 'message');
            let content = [
                {
                    link: 'javascript:;',
                    contents: card1.content,
                    whereTo: card1.fields.where_to.value
                },
                {
                    link: 'tel:058 200 25 00',
                    contents: card2.content,
                    whereTo: card2.fields.where_to.value
                },
                {
                    link: 'javascript:;',
                    contents: card3.content,
                    whereTo: card3.fields.where_to.value
                }
            ]
            return content
        }
    },
}
</script>

