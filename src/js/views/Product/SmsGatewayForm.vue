<template>
    <div data-aos="fade-up" class="sms-gateway-form">
        <div class="sms-gateway-form__card d-flex">
            <ValidationObserver ref="observer" class="sms-gateway-form__form-wrapper d-flex" :class="{'disabled-form': loading}">
                <ValidationProvider rules="required" :name="translate('clientCode')" class="input sms-gateway-form__form-input" v-slot="{errors}">
                    <label>{{translate('clientCode')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('clientCode')" type="text" v-model="customerNumber.value" />
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required" :name="translate('socialReason')" class="input sms-gateway-form__form-input" v-slot="{errors}">
                    <label>{{translate('socialReason')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('socialReason')" type="text" v-model="companyName.value" />
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required" :name="translate('forename')" class="input sms-gateway-form__form-input" v-slot="{errors}">
                    <label>{{translate('forename')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('forename')" type="text" v-model="firstName.value" />
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required" :name="translate('name')" class="input sms-gateway-form__form-input" v-slot="{errors}">
                    <label>{{translate('name')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('name')" type="text" v-model="lastName.value" />
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required" :name="translate('mailAddress')" class="input sms-gateway-form__form-input" v-slot="{errors}">
                    <label>{{translate('mailAddress')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('mailAddress')" type="email" v-model="email.value" />
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required" :name="translate('telephone')" class="input sms-gateway-form__form-input" v-slot="{errors}">
                    <label>{{translate('telephone')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('telephone')" type="text" v-model="phone.value" />
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider :name="translate('unitsNumber')" rules="required" v-slot="{errors}" class='form-select__container winbiz-local__form-sorter'>
                    <label class='form-select__label'>{{translate('unitsNumber')}} *</label>
                    <div class='form-select__box d-flex flex-row justify-content-between'>
                        <select v-model="units.value" type="select">
                            <option value="">
                                {{translate('chooseUnitAmmount')}}
                            </option>
                            <option v-for="(option, index) in units.options" :key="index" :value="option">
                                {{option}}
                            </option>
                        </select>
                    </div>
                    <span class="form-select__error">{{errors[0]}}</span>
                </ValidationProvider>
                <div class="d-flex flex-column justify-content-center align-items-center" style="width: 100%">
                    <Recaptcha ref="captcha" @value="updateCaptchaToken" />
                    <p class="sms-gateway-form__form--tc-note">
                        {{translate('testFormNote1')}}
                        <router-link class="link" :to="{name: 'section', params: {slug1: termsAndConditions.slug}}">{{translate('testFormNote2')}}</router-link>
                    </p>
                    <div class="icon-container">
                        <i class="icon-arrows-ccw icon" v-show="loading"></i>
                    </div>
                    <button class="cta" @click="submitForm" v-show="!loading" :disabled="!captchaToken" :class="{'cta-disabled': !captchaToken}">
                        {{translate('send')}}
                    </button>
                </div>
            </ValidationObserver>
        </div>
    </div>
</template>

<script>
import formMixin from '@/mixins/form';
import Recaptcha from '../components/Recaptcha.vue';

export default {
    name: 'SmsGatewayForm',
    props: [],
    components: {
        Recaptcha
    },
    data() {
        return {
            captchaToken: null,
            loading: false,
            formData: {},
            //Form data
            customerNumber: {value: ''},
            companyName: {value: ''},
            firstName: {value: ''},
            lastName: {value: ''},
            email: {value: ''},
            phone: {value: ''},
            units: {
                value: '',
                options: [
                    `1000 ${this.translate('units')}`,
                    `10000 ${this.translate('units')}`,
                ]
            },
        }
    },
    mixins: [formMixin],
    methods: {
        updateCaptchaToken(data) {
            this.captchaToken = data
        },
        onSubmit() {
            if (this.loading) return;
            this.loading = true;

            this.formData['customer_number'] = this.customerNumber.value;
            this.formData['company_name'] = this.companyName.value;
            this.formData['first_name'] = this.firstName.value;
            this.formData['last_name'] = this.lastName.value;
            this.formData['email'] = this.email.value;
            this.formData['phone'] = this.phone.value;
            this.formData['units'] = this.units.value;
            this.formData['captchaToken'] = this.captchaToken;

            axios.post(`/${this.$route.params.locale}/api/v2/contact/sms-gateway`, this.formData)
                .then(response => {
                    this.$parent.showMessage = true;
                    this.loading = false;
                    this.$refs.captcha.resetCaptcha()
                })
                .catch(error => {
                    console.log(error.response.data);
                    alert('Error')
                    this.loading = false;
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