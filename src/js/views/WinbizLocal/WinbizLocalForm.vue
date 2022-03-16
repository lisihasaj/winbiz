<template>
    <div class="winbiz-local__form container--lg" :class="{'disabled-form': loading}">

        <div data-aos="fade-up" class="winbiz-local__form-card d-flex flex-column align-items-center justify-content-start">
            <h1>{{translate('orderSummary')}}</h1>
            <form class="d-flex flex-row align-items-start justify-content-start">
                <p>{{translate('options')}}</p>
                <label class="radio winbiz-local-radio" for="vip_subscription">
                    <input ref="radio" name="training" :value="translate('telephoneSupport')" v-model="form.vip_subscription" id="vip_subscription" class="radio__input" type="checkbox" />
                    <span class="radio__radio"></span>
                    <div class="label" for="price-check">
                        <p>{{translate('telephoneSupport')}} </p>
                        <p>{{section.fields.radio_label.value}}</p>
                    </div>
                </label>
                <router-link class="see-more-link" :to="{name: 'subsection', params: {slug1: supportSection.slug, slug2: vipSupport.slug}}">{{translate('seeMoreCta')}}</router-link>
            </form>
            <div class="grid-box">
                <div class="grid-box__row">
                    <p>{{translate('subtotal')}}</p>
                    <p>Winbiz Local</p>
                    <p>CHF 79.00 {{translate('priceFigure')}}</p>
                </div>
                <div v-show="form.vip_subscription" class="grid-box__row">
                    <p></p>
                    <p>{{translate('vipSubscription')}}</p>
                    <p>CHF 15.00 {{translate('priceFigure')}}</p>
                </div>
                <div class="grid-box__row">
                    <p></p>
                    <p></p>
                    <p></p>
                </div>
                <div class="grid-box__row">
                    <p>{{translate('totalNoTax')}}</p>
                    <p></p>
                    <p>CHF {{totalWithoutTax}} {{translate('priceFigure')}}</p>
                </div>
                <div class="grid-box__row">
                    <p>{{translate('totalTTC')}}</p>
                    <p></p>
                    <p>CHF {{totalWithTax}} {{translate('priceFigure')}}</p>
                </div>
            </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="100" class="winbiz-local__form-card d-flex flex-column align-items-center justify-content-start">
            <ValidationObserver ref="observer" class="winbiz-local__form-wrapper d-flex">
                <ValidationProvider rules="required" :name="translate('socialReason')" class="input winbiz-local__form-input" v-slot="{errors}">
                    <label>{{translate('socialReason')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('socialReason')" type="text" v-model="form.socialReason"/>
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required" :name="translate('forename')" class="input winbiz-local__form-input" v-slot="{errors}">
                    <label>{{translate('forename')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('forename')" type="text" v-model="form.first_name"/>
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required" :name="translate('name')" class="input winbiz-local__form-input" v-slot="{errors}">
                    <label>{{translate('name')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('name')" type="text" v-model="form.last_name"/>
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required" :name="translate('street')" class="input winbiz-local__form-input" v-slot="{errors}">
                    <label>{{translate('street')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('street')" type="text" v-model="form.street"/>
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <div :name="translate('number')" class="input winbiz-local__form-input">
                    <label>{{translate('number')}}</label>
                    <div class="input-box">
                        <input :placeholder="translate('number')" type="text" v-model="form.streetNumber"/>
                    </div>
                </div>
                <div :name="translate('additionalAddress')" class="input winbiz-local__form-input">
                    <label>{{translate('additionalAddress')}}</label>
                    <div class="input-box">
                        <input :placeholder="translate('additionalAddress')" type="text" v-model="form.additionalAddress"/>
                    </div>
                </div>
                <ValidationProvider rules="required" :name="translate('zip')" class="input winbiz-local__form-input" v-slot="{errors}">
                    <label>{{translate('zip')}} *</label>
                    <div class="input-box">
                        <WbZipSelect v-model="form.npa" />
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required" :name="translate('town')" class="input form-one__input" v-slot="{errors}">
                    <label>{{translate('town')}} *</label>
                    <div class="input-box">
                        <WbCitiesSelect :npa="form.npa" v-model="form.city" />
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required" :name="translate('mailAddress')" class="input winbiz-local__form-input" v-slot="{errors}">
                    <label>{{translate('mailAddress')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('mailAddress')" type="email" v-model="form.email"/>
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <ValidationProvider rules="required:numeric" :name="translate('telephone')" class="input winbiz-local__form-input" v-slot="{errors}">
                    <label>{{translate('telephone')}} *</label>
                    <div class="input-box">
                        <input :placeholder="translate('telephone')" type="number" v-model="form.telephone"/>
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <div :name="translate('secondaryTelephone')" class="input winbiz-local__form-input">
                    <label>{{translate('secondaryTelephone')}}</label>
                    <div class="input-box">
                        <input :placeholder="translate('secondaryTelephone')" type="number" v-model="form.secondTelephone"/>
                    </div>
                </div>
                <p class="note">{{translate('form1Subtitle')}}</p>
                <div :name="translate('sellingPartner')" class='form-select__container winbiz-local__form-sorter'>
                    <label class='form-select__label'>{{translate('sellingPartner')}}</label>
                    <div class="input-box">
                        <WbPartnersSelect :npa="form.sellingPartner" v-model="form.sellingPartner" />
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <Recaptcha ref="captcha" @value="updateCaptchaToken" />
                    <p class="winbiz-local__form--tc-note">
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
import WbZipSelect from '@/components/WbZipSelect';
import WbCitiesSelect from '@/components/WbCitiesSelect';
import WbPartnersSelect from '@/components/WbPartnersSelect';

export default {
    name: "WinbizLocalForm",
    props: [
        'section',
        'showMessage'
    ],
    components: {
        Recaptcha,
        WbZipSelect,
        WbCitiesSelect,
        WbPartnersSelect
    },
    data() {
        return {
            form: {
                vip_subscription: false,
                socialReason: '',
                first_name: '',
                last_name: '',
                street: '',
                streetNumber: '',
                additionalAddress: '',
                npa: '',
                city: '',
                email: '',
                telephone: '',
                secondTelephone: '',
                sellingPartner: '',
            },
            //Form values
            captchaToken: null,
            //Loading UI
            loading: false
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

            const data = {
                'socialReason': this.form.socialReason,
                'first_name': this.form.first_name,
                'last_name': this.form.last_name,
                'street': this.form.street,
                'streetNumber': this.form.streetNumber,
                'additionalAddress': this.form.additionalAddress,
                'npa': this.form.npa,
                'locality': this.form.city,
                'email': this.form.email,
                'telephone': this.form.telephone,
                'secondTelephone': this.form.secondTelephone,
                'vipSubscription': this.form.vip_subscription,
                'sellingPartner': (this.form.sellingPartner) ? this.form.sellingPartner.companyName : '',
                'captchaToken': this.captchaToken,
                'language': this.$route.params.locale
            }

            axios.post(`/${this.$route.params.locale}/api/v2/contact/local`, data)
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
        },
        supportSection () {
            return this.$store.getters.getSectionByType('support');
        },
        vipSupport () {
            return this.supportSection?.children.find(ss => ss.type === 'assistance_vip');
        },
        totalWithoutTax () {
            if (this.form.vip_subscription) {
                return '94.00'
            }

            return '79.00'
        },
        totalWithTax () {
            if (this.form.vip_subscription) {
                return '101.25'
            }

            return '85.10'
        }
    }
}
</script>