<template>
    <div id="subscribe-form" class="subscribe-form d-flex flex-column justify-content-start align-items-center" :class="{'disabled-form': loading}">
        <div class="subscribe-form__container px-0 col-md-12 col-lg-10 col-xl-9 d-flex flex-column align-items-center justify-content-start">
            <div class="subscribe-form__disabler" v-if="datesAvailable">
                <span @click="showForm">{{translate('modifyPlaceDate')}}</span>
            </div>
            <div class="forms-container d-flex" :class="{'align-items-center flex-column': !datesAvailable}">
                <div class="forms__title d-flex flex-column align-items-start justify-content-start px-0 col-sm-12 col-md-6 col-lg-3 col-xl-4" v-if="datesAvailable">
                    <h3>{{translate('etape2')}}</h3>
                    <p>{{translate('etape2Descr')}}</p>
                </div>
                <span ref="scrollAnchor"></span>
                <template v-if="!datesAvailable && (locale === 'en' || locale === 'it')">
                    <div class="subscribe-form__no-courses" v-html="translate('noCoursesMessage')"></div> 
                </template>
                <ValidationObserver ref="observer" @submit.prevent="onSubmit" class="form-container d-flex flex-column align-items-center justify-content-start px-0 col-md-12 col-lg-8 col-xl-7">
                    <div class="form-wrapper d-flex flex-column justify-content-start">
                        <h5>{{translate('personalInfo')}}</h5>
                        <div class="form-group-inputs d-flex justify-content-between">
                            <ValidationProvider class="input subscribe-input" v-for="input in personalInfo" :name="input.placeholder" :key="input.id" :rules="input.required" v-slot="{errors}">
                                <label>{{input.label}}</label>
                                <div class="input-box">
                                    <input :placeholder="input.placeholder" :name="input.placeholder" :type="input.type" v-model="input.value"/>
                                </div>
                                <span class="input-error">{{errors[0]}}</span>
                            </ValidationProvider>
                            <ValidationProvider rules="required" class="input subscribe-input" v-slot="{errors}" :name="translate('nrOfParticipants')">
                                <label>{{translate('nrOfParticipants')}}*</label>
                                <div class="input-box">
                                    <input :placeholder="translate('nrOfParticipants')" type="number" v-model="nr_of_participants"/>
                                </div>
                                <span class="input-error">{{errors[0]}}</span>
                            </ValidationProvider>
                            <ValidationProvider :rules="name_of_participants_rule" v-slot="{errors}" :name="translate('nameOfParticipants')" class="textarea temporary-form__textarea">
                                <label>{{translate('nameOfParticipants')}}
                                    <template v-if="name_of_participants_rule === 'required'">*</template>
                                </label>
                                <div class="textarea-box">
                                    <textarea :placeholder="translate('nameOfParticipants')" v-model="name_of_participants" type="text" rows="4"></textarea>
                                </div>
                                <span class="textarea-error">{{errors[0]}}</span>
                            </ValidationProvider>
                        </div>
                    </div>

                    <div class="form-wrapper d-flex flex-column align-items-start justify-content-start">
                        <h5>{{translate('billingAddress')}}</h5>
                        <div class="form-group-inputs d-flex">
                            <ValidationProvider rules="required" :name="translate('postalAddress')" class="input subscribe-input" v-slot="{errors}">
                                <label>{{translate('postalAddress')}} *</label>
                                <div class="input-box">
                                    <input :placeholder="translate('postalAddress')" type="text" v-model="address.value"/>
                                </div>
                                <span class="input-error">{{errors[0]}}</span>
                            </ValidationProvider>
                            <ValidationProvider rules="required" :name="translate('zip')" class="input subscribe-input" v-slot="{errors}">
                                <label>{{translate('zip')}} *</label>
                                <div class="input-box">
                                    <WbZipSelect v-model="npa.value" />
                                </div>
                                <span class="input-error">{{errors[0]}}</span>
                            </ValidationProvider>
                            <ValidationProvider rules="required" :name="translate('town')" class="input subscribe-input" v-slot="{errors}">
                                <label>{{translate('town')}} *</label>
                                <div class="input-box">
                                    <WbCitiesSelect :npa="npa.value" v-model="city.value" />
                                </div>
                                <span class="input-error">{{errors[0]}}</span>
                            </ValidationProvider>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <Recaptcha ref="captcha" @value="updateCaptchaToken" />
                            <p class="winbiz-local__form--tc-note">
                                {{translate('trainingTerms1')}}
                                <router-link class="link" :to="{name: 'section', params: {slug1: termsAndConditions.slug}}">{{translate('trainingTerms2')}}</router-link>
                            </p>
                        </div>
                    </div>
                    
                    <div class="form-button-wrapper d-flex">
                        <div class="icon-container">
                            <i class="icon-arrows-ccw icon" v-show="loading"></i>
                        </div>
                        <button class="cta" @click='submitForm' v-show="!loading" :disabled="!captchaToken" :class="{'cta-disabled': !captchaToken}">
                            {{translate('validate')}}
                        </button>
                    </div>
                </ValidationObserver>
                
            </div>
        </div>
    </div>
</template>

<script>
import formMixin from '@/mixins/form';
import Recaptcha from '../../components/Recaptcha';
import WbZipSelect from '@/components/WbZipSelect';
import WbCitiesSelect from '@/components/WbCitiesSelect';

export default {
    name: 'SubscribeForm',
    props: [
        'section',
        'subsection',
        'locationName',
        'trainingGroupId',
        'calendarBlockDisabled',
        'trainingName',
        'defaultGroupId',
        'trainings'
    ],
    components: {
        Recaptcha,
        WbZipSelect,
        WbCitiesSelect
    },
    mixins: [formMixin],
    data() {
        return {
            personalInfo: [
                {
                    id: 1,
                    label: `${this.translate('clientNumber')}`,
                    placeholder: `${this.translate('clientNumber')}`,
                    required: null,
                    value: '',
                    key: 'customer_number',
                    type: 'number'
                },
                {
                    id: 2,
                    label: `${this.translate('socialReason')}`,
                    placeholder: `${this.translate('socialReason')}`,
                    required: null,
                    value: '',
                    key: 'company_name',
                    type: 'text'
                },
                {
                    id: 3,
                    label: `${this.translate('forename')} *`,
                    placeholder: `${this.translate('forename')}`,
                    required: 'required',
                    value: '',
                    key: 'first_name',
                    type: 'text'
                },
                {
                    id: 4,
                    label: `${this.translate('name')} *`,
                    placeholder: `${this.translate('name')}`,
                    required: 'required',
                    value: '',
                    key: 'last_name',
                    type: 'text'
                },
                {
                    id: 5,
                    label: `${this.translate('mailAddress')} *`,
                    placeholder: `${this.translate('mailAddress')}`,
                    required: 'required',
                    value: '',
                    key: 'email',
                    type: 'email'
                },
                {
                    id: 6,
                    label: `${this.translate('telephone')} *`,
                    placeholder: `${this.translate('telephone')}`,
                    required: 'required',
                    value: '',
                    key: 'phone',
                    type: 'number'
                }
            ],
            address: {value: ''},
            npa: {value: ''},
            city: {value: ''},
            nr_of_participants: 1,
            name_of_participants: '',
            formData: {},
            loading: false,
            captchaToken: null,
        }
    },
    mounted() {
        if (this.calendarBlockDisabled) {
            let el;
            if (this.locale === 'en' || this.locale === 'it') {
                el = this.$refs.scrollAnchor;
            } else {
                el = this.$refs.scrollAnchor
            }

            const offset = el.getBoundingClientRect().top;

            window.scrollTo({
                top: offset - 100,
                behavior: 'smooth',
            })
        }
    },
    methods: {
        updateCaptchaToken(data) {
            this.captchaToken = data
        },
        onSubmit() {
            if (this.loading) return;
            this.loading = true;
            
            this.formData['language'] = this.$route.params.locale;
            this.formData['captchaToken'] = this.captchaToken;
            this.personalInfo.map(i => { this.formData[i.key] = i.value });
            this.formData['address'] = this.address.value;
            this.formData['zip_code'] = this.npa.value;
            this.formData['city'] = this.city.value;
            this.formData['nr_of_participants'] = this.nr_of_participants;
            this.formData['participants'] = this.name_of_participants;
            this.formData['training_group_id'] = (!this.datesAvailable) ? this.defaultGroupId : this.trainingGroupId
            this.formData['type'] = (!this.datesAvailable) ? 'default' : 'regular'
            this.formData['training_name'] = this.trainingName
            this.formData['language'] = this.locale

            axios.post(`/${this.$route.params.locale}/api/v2/groups/participants`, this.formData)
                .then(response => {
                    this.$emit('showMessage');
                }, err => {
                    this.$refs.captcha.resetCaptcha();
                    if (err.response?.data?.message) {
                        alert(err.response?.data?.message)
                    } else {
                        alert('an error happened')
                    }
                }).finally(() => {
                    this.loading = false;
                })
        },
        async submitForm () {
            const isValid = await this.validateForm();

            if (isValid) {
                this.onSubmit()
            }
        },
        showForm() {
            this.$emit('showForm')
        },
    },
    computed: {
        locale () {
            return this.$route.params.locale
        },
        datesAvailable () {
            return this.locale === 'fr' && Object.keys(this.trainings).length
        },
        name_of_participants_rule () {
            return (this.nr_of_participants > 1) ? 'required' : ''
        },
        termsAndConditions() {
            return this.$store.getters.getSectionByType('terms');
        }
    }
}
</script>