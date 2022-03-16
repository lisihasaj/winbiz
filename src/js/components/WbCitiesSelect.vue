<template>
    <v-select :class="classes" :options="options" :value="value" :label="translate('town')" @input="setSelected" :placeholder="translate('town')" ref="cities">
        <template #no-options>
            {{translate('noResults')}}
        </template>
    </v-select>
</template>

<script>
import vSelect from 'vue-select'

export default {
    name: 'WbCitiesSelect',
    components: {
        vSelect
    },
    props: ['value', 'npa', 'classes'],
    watch: {
        npa: function (value) {
            if (value === null) {
                this.setSelected(null)
            }

            this.checkSelected()
        }
    },
    methods: {
        setSelected (value) {
            this.$emit('input', value)
        },
        checkSelected () {
            if (!this.city) {
                this.setSelected(null)
            }
            if (this.npa) {
                // if only one city available for selected postal code, autoselect
                // else multiple options, autoopen cities dropdown
                if (this.options.length === 1) {
                    this.setSelected(this.options[0])
                } else {
                    this.$refs.cities.$refs.search.focus()
                    this.$refs.cities.open = true;
                }
            }
        }
    },
    computed: {
        cities () {
            return this.$store.getters.getCities
        },
        options () {
            return this.cities.filter((c) => c.npa == this.npa).map((c) => c.city)
        },
        city () {
            return this.cities.find((c) => c.npa == this.npa && c.city == this.value)
        }
    }
}
</script>