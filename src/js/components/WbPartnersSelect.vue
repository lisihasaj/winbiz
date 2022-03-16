<template>
    <v-select :class="classes" :loading="loading" :options="partners" label="selectLabel" :placeholder="translate('findThePartner')" @input="setSelected">
        <template #no-options>
            {{translate('noResults')}}
        </template>
    </v-select>
</template>

<script>
import vSelect from 'vue-select'

export default {
    name: 'WbPartnersSelect',
    props: ['value', 'classes'],
    components: {
        vSelect
    },
    mounted () {
        if (!this.partners.length) {
            this.loading = true
            axios.get(`/${this.$route.params.locale}/api/v2/winbiz-partners`).then(response => {
                const data = response.data.body.map((partner) => {
                    return {
                        ...partner,
                        selectLabel: `${partner.companyName} - ${partner.postalCode} ${partner.city}`
                    }
                })
                this.$store.commit('setWbLocalPartners', data)
            }, err => {
                console.log(err.response.data)
            }).finally(() => {
                this.loading = false
            })
        }
    },
    data () {
        return {
            loading: false
        }
    },
    methods: {
        setSelected (value) {
            this.$emit('input', value)
        }
    },
    computed: {
        partners () {
            return this.$store.getters.getWbLocalPartners
        }
    }
}
</script>
