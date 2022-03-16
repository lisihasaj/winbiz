<template>
    <div data-aos="fade-up" data-aos-delay="100" class="free-test__form-box d-flex flex-column align-items-center justify-content-center">
        <p class="title">{{section.fields.form_title.value}}</p>
        <ValidationObserver ref="observer" class="test-form d-flex flex-column align-items-center justify-content-start" :class="{'disabled-form': loading}">

            <ValidationProvider rules="required" v-slot="{errors}" name="gender" class="test-form__radios d-flex">
                <p class="test-form__radios-title">{{translate('genderRadioLabel')}} *</p>
                <div class="test-form__radios-wrapper d-flex">
                    <label class="radio test-form__radios-item">
                        <input name="gender" id="female" :value="translate('female')" class="radio__input test-form__radios-item__input" type="radio" v-model="radios.value" />
                        <span class="radio__radio test-form__radios-item__radio"></span>
                        <label class="label" for="female">{{translate('female')}}</label>
                    </label>
                    <label class="radio test-form__radios-item">
                        <input name="gender" id="male" :value="translate('male')" class="radio__input test-form__radios-item__input" type="radio" v-model="radios.value" />
                        <span class="radio__radio test-form__radios-item__radio"></span>
                        <label class="label" for="male">{{translate('male')}}</label>
                    </label>
                </div>
                <span class="radio-error">{{errors[0]}}</span>
            </ValidationProvider>

            <div class="test-form__inputs-wrapper d-flex">
                <ValidationProvider rules="required" :name="translate('forename')" class="input test-form__inputs-item" v-slot="{errors}">
                    <label>{{translate('forename')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('forename')" type="text" v-model="first_name.value"/>
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required" :name="translate('name')" class="input test-form__inputs-item" v-slot="{errors}">
                    <label>{{translate('name')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('name')" type="text" v-model="last_name.value"/>
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required" :name="translate('mailAddress')" class="input test-form__inputs-item" v-slot="{errors}">
                    <label>{{translate('mailAddress')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('mailAddress')" type="email" v-model="email.value"/>
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required" :name="translate('zip')" class="input test-form__inputs-item" v-slot="{errors}">
                    <label>{{translate('zip')}} *</label>
                    <div class="input-box">
                        <WbZipSelect v-model="npa.value" />
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required" :name="translate('town')" class="input test-form__inputs-item" v-slot="{errors}">
                    <label>{{translate('town')}} *</label>
                    <div class="input-box">
                        <WbCitiesSelect :npa="npa.value" v-model="city.value" />
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required:numeric" :name="translate('telephone')" class="input test-form__inputs-item" v-slot="{errors}">
                    <label>{{translate('telephone')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('telephone')" type="number" v-model="telephone.value"/>
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <div :name="translate('secondaryTelephone')" class="input test-form__inputs-item">
                    <label>{{translate('secondaryTelephone')}}</label>
                    <div class="input-box">
                        <input :placeholder="translate('secondaryTelephone')" type="number" v-model="secondTelephone.value"/>
                    </div>
                </div>
            </div>

            <Recaptcha ref="captcha" @value="updateCaptchaToken" />
            <p class="test-form__tc-note">
                {{translate('testFormNote1')}}
                <router-link class="link" :to="{name: 'section', params: {slug1: termsAndConditions.slug}}">{{translate('testFormNote2')}}</router-link>
            </p>
            <div class="icon-container">
                <i class="icon-arrows-ccw icon" v-show="loading"></i>
            </div>
            <button class="cta" @click="submitForm" v-show="!loading" :disabled="!captchaToken" :class="{'cta-disabled': !captchaToken}">
                {{translate('send')}}
            </button>
        </ValidationObserver>
    </div>
</template>

<script>
import formMixin from '@/mixins/form';
import Recaptcha from './Recaptcha';
import WbZipSelect from '@/components/WbZipSelect';
import WbCitiesSelect from '@/components/WbCitiesSelect';

export default {
    name: 'FreeTestForm',
    props: [
        'section'
    ],
    components: {
        Recaptcha,
        WbZipSelect,
        WbCitiesSelect
    },
    data() {
        return {
            formData: {},
            //Form values
            radios: {value: ''},
            first_name: {value: ''},
            last_name: {value: ''},
            email: {value: ''},
            npa: {value: ''},
            city: {value: ''},
            telephone: {value: ''},
            secondTelephone: {value: ''},
            captchaToken: null,
            //Loading UI
            loading: false
        }
    },
    mixins: [formMixin],
    methods: {
        updateCaptchaToken(data) {
            this.captchaToken = data;
        },
        onSubmit() {
            this.loading = true;

            this.formData['language'] = this.$route.params.locale;
            this.formData['gender'] = this.radios.value;
            this.formData['first_name'] = this.first_name.value;
            this.formData['last_name'] = this.last_name.value;
            this.formData['email'] = this.email.value;
            this.formData['npa'] = this.npa.value;
            this.formData['city'] = this.city.value;
            this.formData['telephone'] = this.telephone.value;
            this.formData['secondTelephone'] = this.secondTelephone.value;
            this.formData['captchaToken'] = this.captchaToken;

            axios.post(`/${this.$route.params.locale}/api/v2/contact/trial`, this.formData)
                .then(response => {
                    this.$parent.showMessage = true;
                    this.loading = false;
                    this.$refs.captcha.resetCaptcha()
                })
                .catch(error => {
                    alert('Error. Check data and try again')
                    this.loading = false
                    this.$refs.captcha.resetCaptcha()
                })
        },
        async submitForm() {
            const isValid = await this.validateForm();

            if(isValid) {
                this.onSubmit();
            }
        },
    },
    computed: {
        termsAndConditions() {
            return this.$store.getters.getSectionByType('terms');
        }
    }
}
</script>