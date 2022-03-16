<template>
    <v-select :class="classes" :options="options" :value="value" :label="translate('zip')" :placeholder="translate('zip')" @input="setSelected">
        <template #no-options>
            {{translate('noResults')}}
        </template>
    </v-select>
</template>

<script>
import _uniq from 'lodash/uniq'
import vSelect from 'vue-select'

export default {
    name: 'WbZipSelect',
    components: {
        vSelect
    },
    props: ['value', 'classes'],
    mounted () {
        if (!this.cities.length) {
            axios.get(`/${this.$route.params.locale}/api/v2/cities`).then(response => {
                this.$store.commit('setCities', response.data)
            })
        }
    },
    data () {
        return {
            selected: this.value
        }
    },
    methods: {
        setSelected (value) {
            this.$emit('input', value)
        }
    },
    computed: {
        cities () {
            return this.$store.getters.getCities
        },
        options () {
            let zips = this.cities.map((c) => Number(c.npa)).sort()
            return _uniq(zips)
        }
    }
}
</script>