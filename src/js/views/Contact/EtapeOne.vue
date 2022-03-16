<template>
    <div class="etape d-flex flex-column align-items-center justify-content-start">
        <div data-aos="fade-right" data-aos-delay="400" class="etape__title" v-html="section.fields.etape_one.value"></div>
        <div class="etape__cards d-flex">
            <label data-aos="fade-up" data-aos-delay="500" v-for="(card, index) in collection.pages" :key="index" class="radio-card">
                <input name="etape1" class="radio-card__input" type="radio" />
                <div v-html="card.content" ref="etapeOneCards" class="radio-card__wrapper" @click="setShowEtapeTwo(index)"></div>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: 'EtapeOne',
    props: [
        'section',
        'formData'
    ],
    methods: {
        setShowEtapeTwo(id) {
            this.$emit('setShowEtapeTwo', id);
            const card = this.$refs.etapeOneCards[id];
            this.formData['stepOne'] = card.innerText;
        }
    },
    computed: {
        collection() {
            return this.section.collections.find(c => c.type === 'tree_etapes');
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