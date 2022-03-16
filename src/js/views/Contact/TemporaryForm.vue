<template>
    <div data-aos="fade-up" class="temporary-form d-flex flex-column px-0 col-sm-12 col-md-11 col-xl-8" v-if="cardId">
        <ValidationObserver ref="observer" class="temporary-form__container d-flex flex-column align-items-center" :class="{'disabled-form': loading}">
            <ValidationProvider data-aos="fade-up" rules="required" v-slot="{errors}" :name="translate('clientNumber')" class="input temporary-form__customer-id" v-if="cardId === 'temporary_card_two' || cardId === 'temporary_card_three'">
                <label>{{translate('customerId')}} *</label>
                <div class="input-box">
                    <input :placeholder="translate('customerId')" v-model="clientId.value"/>
                </div>
                <span class="radio-error">{{errors[0]}}</span>
            </ValidationProvider>
            <ValidationProvider rules="required" v-slot="{errors}" :name="translate('gender')" class="temporary-form__radios d-flex">
                <p class="temporary-form__radios-title">{{translate('genderRadioLabel')}} *</p>
                <div class="temporary-form__radios-wrapper d-flex">
                    <label class="radio temporary-form__radios-item">
                        <input name="gender" id="female" :value="translate('female')" class="radio__input temporary-form__radios-item__input" type="radio" v-model="radios.value" />
                        <span class="radio__radio temporary-form__radios-item__radio"></span>
                        <label for="female">{{translate('female')}}</label>
                    </label>
                    <label class="radio temporary-form__radios-item">
                        <input name="gender" id="male" :value="translate('male')" class="radio__input temporary-form__radios-item__input" type="radio" v-model="radios.value" />
                        <span class="radio__radio temporary-form__radios-item__radio"></span>
                        <label for="male">{{translate('male')}}</label>
                    </label>
                </div>
                <span class="radio-error">{{errors[0]}}</span>
            </ValidationProvider>
            <div class="temporary-form__inputs-wrapper d-flex">
                <ValidationProvider rules="required" v-slot="{errors}" v-for="(textInput, index) in textInputs" :name="textInput.placeholder" :key="index" class="input temporary-form__inputs-item">
                    <label>{{textInput.label}}</label>
                    <div class="input-box">
                        <input :placeholder="textInput.placeholder" :type="textInput.type" v-model="textInput.value"/>
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <div class="input temporary-form__inputs-item">
                    <label>{{translate('telephone')}}</label>
                    <div class="input-box">
                        <input :placeholder="translate('telephone')" type="number" v-model="teleInput.value" />
                    </div>
                </div>
                <ValidationProvider rules="required|min:20" v-slot="{errors}" :name="translate('messagePlaceholder')" class="textarea temporary-form__textarea">
                    <label>{{translate('messageLabel')}} *</label>
                    <div class="textarea-box">
                        <textarea :placeholder="translate('messagePlaceholder')" v-model="textarea.value" type="text" rows="4"></textarea>
                    </div>
                    <span class="textarea-error">{{errors[0]}}</span>
                </ValidationProvider>
            </div>
        </ValidationObserver>
        <Recaptcha ref="captcha" @value="updateCaptchaToken" />
        <div class="temporary-form__button d-flex flex-row align-items-center">
            <div class="icon-container">
                <i class="icon-arrows-ccw icon" v-show="loading"></i>
            </div>
            <button @click="submitForm" class="cta" v-show="!loading" :disabled="!captchaToken" :class="{'cta-disabled': !captchaToken}">
                {{translate('send')}}
            </button>
        </div>
    </div>
</template>

<script>
import formMixin from '@/mixins/form';
import Recaptcha from '../components/Recaptcha';

export default {
    name: 'TemporaryForm',
    props: [
        'cardId',
        'formData'
    ],
    mixins: [formMixin],
    components: {
        Recaptcha
    },
    data() {
        return {
            clientId: {value: ''},
            radios: {value: ''},
            textInputs: [
                {
                    id: 0,
                    label: `${this.translate('forename')} *`,
                    placeholder: `${this.translate('forename')}`,
                    type: 'text',
                    key: 'first_name',
                    value: ''
                },
                {
                    id: 1,
                    label: `${this.translate('name')} *`,
                    placeholder: `${this.translate('name')}`,
                    type: 'text',
                    key: 'last_name',
                    value: ''
                },
                {
                    id: 2,
                    label: `${this.translate('mailAddress')} *`,
                    placeholder: `${this.translate('mailAddress')}`,
                    type: 'email',
                    key: 'email',
                    value: ''
                },
            ],
            teleInput: {value: ''},
            textarea: {value: ''},
            loading: false,
            captchaToken: null,
        }
    },
    methods: {
        updateCaptchaToken(data) {
            this.captchaToken = data
        },
        onSubmit() {
            this.loading = true;
            
            this.formData['language'] = this.$route.params.locale;
            this.setFormData['captchaToken'] = this.captchaToken;
            this.setFormData['gender'] = this.radios.value;
            this.setFormData['clientId'] = this.clientId.value;
            this.setFormData['telephone'] = this.teleInput.value;
            this.setFormData['message'] = this.textarea.value;
            this.setFormData['cardId'] = this.cardId;

            this.textInputs.map(i => {
                this.setFormData[i.key] = i.value;
            });

            axios.post(`/${this.$route.params.locale}/api/v2/contact`, this.formData)
                .then(response => {
                    this.$parent.showMessage = true;
                    this.loading = false;
                    this.$refs.captcha.resetCaptcha()
                })
                .catch(error => {
                    alert('Error. Please check fields and try again');
                    this.loading = false;
                    this.$refs.captcha.resetCaptcha()
                })
        },
        async submitForm () {
            const isValid = await this.validateForm();

            if (isValid) {
                this.onSubmit();
            }
        },
    },
    computed: {
        setFormData: {
            get() { return this.formData },
            set(value) {
                this.$emit('update:formData', value);
            }
        }
    }
}
</script>