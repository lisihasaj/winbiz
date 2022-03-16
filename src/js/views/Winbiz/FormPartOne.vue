<template>
    <div :class="{'form-one__disabled': showFormTwo}" class="form-one d-flex flex-column justify-content-start align-items-center px-0 col-sm-12 col-md-10 col-lg-7 col-xl-6">
        <div class="form__title d-flex flex-column align-items-center">
            <h2>{{translate('form1Title')}}</h2>
            <p>{{translate('form1Subtitle')}}</p>
        </div>
        <ValidationObserver id="form-one" ref="observer" class="form-one__wrapper d-flex" @submit.prevent="onSubmit">
            <ValidationProvider rules="required" :name="translate('socialReason')" class="input form-one__input" v-slot="{errors}">
                <label>{{translate('socialReason')}} *</label>
                <div class="input-box">
                    <input :placeholder="translate('socialReason')" type="text" v-model="socialReason.value" />
                </div>
                <span class="input-error">{{errors[0]}}</span>
            </ValidationProvider>
            <ValidationProvider rules="company_vat_validation" name="N° IDE" class="input form-one__input" v-slot="{errors}">
                <label>N° IDE</label>
                <div class="input-box">
                    <input :placeholder="`CHE-123.456.789`" type="text" v-mask="'CHE-###.###.###'" v-model="che.value" />
                </div>
                <span class="input-error">{{errors[0]}}</span>
            </ValidationProvider>
            <ValidationProvider v-for="input in inputData" :rules="input.required" :key="input.id" :name="input.name" class="input form-one__input" v-slot="{errors}">
                <label>{{input.label}}</label>
                <div class="input-box">
                    <input :placeholder="input.placeholder" :type="input.type" v-model="input.value" />
                </div>
                <span class="input-error">{{errors[0]}}</span>
            </ValidationProvider>
            <ValidationProvider rules="required" name="Zip" class="input form-one__input" v-slot="{errors}">
                <label>{{translate('zip')}} *</label>
                <div class="input-box">
                    <WbZipSelect v-model="npa.value" />
                </div>
                <span class="input-error">{{errors[0]}}</span>
            </ValidationProvider>
            <ValidationProvider rules="required" :name="translate('town')" class="input form-one__input" v-slot="{errors}">
                <label>{{translate('town')}} *</label>
                <div class="input-box">
                    <WbCitiesSelect :npa="npa.value" v-model="city.value" />
                </div>
                <span class="input-error">{{errors[0]}}</span>
            </ValidationProvider>
        </ValidationObserver>
        <div class="form__button d-flex flex-row justify-content-end align-items-center">
            <button v-if="!showFormTwo" @click="submitForm" class="cta">
                {{translate('next')}}
            </button>
            <div :class="[showFormTwo ? 'validation' : 'validation-hidden']">
                <p>{{translate('validated')}}</p>
                <i class='icon-ok-circled2-1 icon-shown'></i>
            </div>
        </div>
    </div>
</template>

<script>
import formMixin from '@/mixins/form';
import WbZipSelect from '@/components/WbZipSelect';
import WbCitiesSelect from '@/components/WbCitiesSelect';

export default {
    name: 'FormPartOne',
    components: {
        WbZipSelect,
        WbCitiesSelect
    },
    props: [
        'showFormTwo',
        'formData'
    ],
    mixins: [formMixin],
    data() {
        return {
            socialReason: {
                value: ''
            },
            che: {
                value: ''
            },
            npa: {
                value: ''
            },
            city: {
                value: ''
            },
            inputData: [
                {
                    id: 1,
                    label: `${this.translate('website')} *`,
                    placeholder: `${this.translate('website')}`,
                    value: '',
                    key: 'website',
                    required: 'required',
                    type: 'text',
                    name: `${this.translate('website')}`
                },
                {
                    id: 2,
                    label: `${this.translate('residingAddress')} *`,
                    placeholder: `${this.translate('residingAddress')}`,
                    value: '',
                    key: 'address',
                    required: 'required',
                    type: 'text',
                    name: `${this.translate('residingAddress')}`
                },
            ]
        }
    },
    updated() {
        if (!this.showFormTwo) {
            let formOne = document.getElementById('form-one');
            formOne.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' });
        }
    },
    methods: {
        onSubmit() {
            this.$emit('setShowFormTwo');
            this.inputData.map(i => { 
                this.setFormData[i.key] = i.value;
                this.setFormData['socialReason'] = this.socialReason.value;
                this.setFormData['ideNumber'] = this.che.value;
                this.setFormData['npa'] = this.npa.value;
                this.setFormData['city'] = this.city.value;
            });
        },
        async submitForm () {
            const isValid = await this.validateForm();

            if (isValid) {
                this.onSubmit()
            }
        },
    },
    computed: {
        setFormData: {
            get() { return this.formData},
            set(value) {
                this.$emit('update:formData', value)
            }
        }
    },
}
</script>