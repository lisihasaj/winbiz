<template>
    <div id="form-two" :class="{'form-two__disabled': showFormThree}" class="form-two d-flex flex-column justify-content-start align-items-center px-0 col-sm-12 col-md-10 col-lg-7 col-xl-6">
        <div class="form__disabler d-flex">
            <span @click='setShowFormTwo'>{{translate('modifyForm1')}}</span>
        </div>
        <div class="form__title d-flex flex-column align-items-center">
            <h2>{{translate('form2Title')}}</h2>
            <p>{{translate('form1Subtitle')}}</p>
        </div>
        <ValidationObserver ref="observer" class="form-two__wrapper d-flex" @submit.prevent="onSubmit">
            <ValidationProvider v-for="input in inputData" :key="input.id" :rules="input.required" :name="input.placeholder" class="input form-two__input" v-slot="{errors}">
                <label>{{input.label}}</label>
                <div class="input-box">
                    <input :placeholder="input.placeholder" :type="input.type" v-model="input.value"/>
                </div>
                <span class="input-error">{{errors[0]}}</span>
            </ValidationProvider>
            <div class="input form-two__input">
                <label>{{translate('telephone')}}</label>
                <div class="input-box">
                    <input :placeholder="translate('telephone')" type="number" v-model="teleInput.value" />
                </div>
            </div>
        </ValidationObserver>
        <div class="form__button d-flex flex-row justify-content-end align-items-center">
            <button v-if="!showFormThree" @click="submitForm" class="cta">
                {{translate('next')}}
            </button>
            <div :class="[showFormThree ? 'validation' : 'validation-hidden']">
                <p>{{translate('validated')}}</p>
                <i class='icon-ok-circled2-1 icon-shown'></i>
            </div>
        </div>
    </div>
</template>

<script>
import formMixin from '@/mixins/form';

export default {
    name: 'FormPartTwo',
    props: [
        'showFormTwo',
        'showFormThree',
        'formData'
    ],
    mixins: [formMixin],
    data() {
        return {
            inputData: [
                {
                    id: 1,
                    label: `${this.translate('forename')} *`,
                    placeholder: `${this.translate('forename')}`,
                    value: '',
                    key: 'first_name',
                    type: 'text',
                    required: 'required'
                },
                {
                    id: 2,
                    label: `${this.translate('name')} *`,
                    placeholder: `${this.translate('name')}`,
                    value: '',
                    key: 'last_name',
                    type: 'text',
                    required: 'required'
                },
                {
                    id: 3,
                    label: `${this.translate('mailAddress')} *`,
                    placeholder: `${this.translate('mailAddress')}`,
                    value: '',
                    key: 'email',
                    type: 'email',
                    required: 'required'
                }
            ],
            teleInput: {value: ''}
        }
    },
    mounted() {
        if(this.showFormTwo) {
            let formTwo = document.getElementById('form-two');
            formTwo.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' });
        };
    },
    updated() {
        if (!this.showFormThree) {
            let formTwo = document.getElementById('form-two');
            formTwo.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' });
        }
    },
    methods: {
        setShowFormTwo() {
            this.$emit('setShowFormTwo')
        },
        onSubmit() {
            this.$emit('setShowFormThree');
            this.inputData.map(i => {
                this.setFormData[i.key] = i.value;
                this.setFormData['telephone'] = this.teleInput.value;
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