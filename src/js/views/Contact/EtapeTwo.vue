<template>
    <div id="etape-two" class="etape d-flex flex-column align-items-center justify-content-start">
        <div data-aos="fade-right" class="etape__title" v-html="this.section.fields.etape_two.value"></div>
        <div data-aos="fade-up" data-aos-delay="100" class="etape__cards d-flex">
            <label v-for="(card, index) in cards" :key="index" class="radio-card">
                <input name="etape2" class="radio-card__input" type="radio">
                <div v-html="card" ref="etapeTwoCards" @click="setShowEtapeThree(index)" class="radio-card__wrapper"></div>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: 'EtapeTwo',
    props: [
        'section',
        'etapeOneCardId',
        'showEtapeTwo',
        'formData'
    ],
    mounted() {
        if(this.showEtapeTwo) {
            return document.getElementById('etape-two').scrollIntoView({
                behavior: 'smooth'
            })
        }
    },
    methods: {
        setShowEtapeThree(id) {
            this.$emit('setShowEtapeThree');
            const card = this.$refs.etapeTwoCards[id];
            this.formData['stepTwo'] = card.innerText;
        }
    },
    computed: {
        cards() {
            const collection = this.section.collections.find(c => c.type === 'tree_etapes');
            const activeEtapeOneCard = collection.pages[this.etapeOneCardId];
            let content = [
                activeEtapeOneCard.fields.card_1.value,
                activeEtapeOneCard.fields.card_2.value,
                activeEtapeOneCard.fields.card_3.value,
                activeEtapeOneCard.fields.card_4.value,
                activeEtapeOneCard.fields.card_5.value,
                activeEtapeOneCard.fields.card_6.value,
            ]
            return content
        },
        setFormData: {
            get() { return this.formData },
            set(value) {
                this.$emit('update:formData', value)
            }
        }
    },
}
</script>