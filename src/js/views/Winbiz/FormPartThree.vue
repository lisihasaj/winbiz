<template>
    <div id="form-three" class="form-three d-flex flex-column justify-content-start align-items-center px-0 col-sm-12 col-md-10 col-lg-7 col-xl-6" :class="{'disabled-form': loading}">
        <div class="form__disabler d-flex">
            <span @click='setShowFormThree'>{{translate('modifyForm1')}}</span>
        </div>
        <div class="form__title d-flex flex-column align-items-center">
            <h2>{{translate('form3Title')}}</h2>
            <p>{{translate('form1Subtitle')}}</p>
        </div>
        <ValidationObserver ref="observer" @submit.prevent="onSubmit" class="form-three__wrapper d-flex">
            <ValidationProvider :name="translate('companySize')" rules="required" v-slot="{errors}" class="input form-three__input">
                <label>{{translate('companySize')}} *</label>
                <div class="input-box">
                    <input :placeholder="translate('companySize')" type="text" v-model="textInput.value"/>
                </div>
                <span class="input-error">{{errors[0]}}</span>
            </ValidationProvider>
            <ValidationProvider :name="translate('typeOfBusiness')" rules="required" v-slot="{errors}" class='form-select__container form-three__sorter'>
                <label class='form-select__label'>{{translate('typeOfBusiness')}} *</label>
                <div class='form-select__box d-flex flex-row justify-content-between'>
                    <select v-model="selectInput.value" type="select">
                        <option value="" disabled selected>
                            {{translate('proposals')}}
                        </option>
                        <option v-for="(option, index) in selectInput.options" :key="index" :value="option">
                            {{option}}
                        </option>
                    </select>
                </div>
                <span class="form-select__error">{{errors[0]}}</span>
            </ValidationProvider>
            <ValidationProvider rules="required|min:12|max:900" :name="translate('whyPartnerPlaceholder')" class="textarea form-three__textarea" v-slot="{errors}">
                <label>{{translate('whyPartner')}} *</label>
                <div class="textarea-box">
                    <textarea :placeholder="translate('whyPartnerPlaceholder')" v-model="textarea.value" rows="3">
                    </textarea>
                </div>
                <span class="textarea-error">{{errors[0]}}</span>
            </ValidationProvider>
            <div v-for="(group, index) in radioGoups" :key="index" class="form-three__radios d-flex flex-column align-items-start justify-content-start">
                <div class="form-three__radios-title" v-html="group.title"></div>
                <div class="form-three__radios-wrapper d-flex">
                    <label v-for="(item, index) in group.radios" :key="index" class="radio form-three__radios-item" ref="formThreeRadios">
                        <input :name="group.name" class="radio__input form-three__radios-item__input" type="radio" :value="item" v-model="group.value" />
                        <span class="radio__radio form-three__radios-item__radio"></span>
                        {{item}}
                    </label>
                    <div class="form-three__radios-others d-flex">
                        <input type="text" v-model="group.othersInput.value" :placeholder="group.othersInput.placeholder" :id="group.othersInput.id" />
                    </div>
                </div>
            </div>
        </ValidationObserver>
        <div class="form-three-captcha d-flex justify-content-start align-items-center w-100">
            <Recaptcha ref="captcha" @value="updateCaptchaToken" />
        </div>
        <div class="form__button d-flex flex-row justify-content-end align-items-center">
            <div class="icon-container">
                <i class="icon-arrows-ccw icon" v-show="loading"></i>
            </div>
            <button class="cta" @click='submitForm' v-show="!loading" :disabled="!captchaToken" :class="{'cta-disabled': !captchaToken}">
                {{translate('next')}}
            </button>
        </div>
    </div>
</template>

<script>
import formMixin from '@/mixins/form';
import Recaptcha from '../components/Recaptcha';

export default {
    name: 'FormPartThree',
    props: [
        'showFormThree',
        'formData'
    ],
    components: {
        Recaptcha
    },
    mixins: [formMixin],
    data() {
        return {
            loading: false,
            captchaToken: null,
            textInput: {
                value: '',
            },
            selectInput: {
                value: '',
                options: [
                    this.translate('trustees'),
                    this.translate('computerScience'),
                    this.translate('development'),
                    this.translate('management')
                ]
            },
            textarea: {
                value: ''
            },
            radioGoups: [
                {
                    name: 'First Options',
                    key: 'packageType',
                    title: `<p>${this.translate('partnerRadioPart1')}</p>`,
                    radios: [
                        this.translate('winbiz'),
                        this.translate('croesus'),
                        this.translate('abacus'),
                        this.translate('wise'),
                        this.translate('other')
                    ],
                    value: '',
                    othersInput: {
                        id: 1,
                        placeholder: this.translate('partnerRadioOther'),
                        key: 'otherPackage',
                        value: ''
                    }
                },
                {
                    name: 'Second Options',
                    key: 'solutionType',
                    title: `<p>${this.translate('partnerRadio2Part1')}</p>`,
                    radios: [
                        this.translate('croesus'),
                        this.translate('abacus'),
                        this.translate('wise'),
                        this.translate('other')
                    ],
                    value: '',
                    othersInput: {
                        id: 2,
                        placeholder: this.translate('partnerRadioOther'),
                        key: 'otherSolution',
                        value: ''
                    }
                },
            ]
        }
    },
    mounted() {
        if(this.showFormThree) {
            let formThree = document.getElementById('form-three');
            formThree.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' });
        };

        this.initiateRadios(0, 0)
        this.initiateRadios(5, 1)
    },
    updated() {
        if(this.radioGoups[0].othersInput.value !== '') {
            this.initiateRadios(4, 0)
        };
        
        if(this.radioGoups[1].othersInput.value !== '') {
            this.initiateRadios(8, 1)
        }
    },
    methods: {
        setShowFormThree() {
            this.$emit('setShowFormThree')
        },
        updateCaptchaToken(data) {
            this.captchaToken = data;
        },
        initiateRadios(r, v) {
            this.$refs.formThreeRadios[r].control.checked = true;
            this.radioGoups[v].value = this.$refs.formThreeRadios[r].innerText;
        },
        onSubmit() {
            this.loading = true;

            const typeOfPartner = sessionStorage.getItem('typeOfPartner')
            this.radioGoups.map(g => {
                this.setFormData['language'] = this.$route.params.locale;
                this.setFormData['captchaToken'] = this.captchaToken;
                this.setFormData['typeOfPartner'] = typeOfPartner;
                this.setFormData['companySize'] = this.textInput.value;
                this.setFormData['typeOfBusiness'] = this.selectInput.value;
                this.setFormData['reasonsMessage'] = this.textarea.value;
                this.setFormData[g.key] = g.value;
                this.setFormData[g.othersInput.key] = g.othersInput.value;
            })

            axios.post(`/${this.$route.params.locale}/api/v2/contact/partnership`, this.formData)
                .then(response => {
                    this.$emit('setShowMessage');
                    this.loading = false;
                    this.$refs.captcha.resetCaptcha()
                })
                .catch(error => {
                    alert('Error. Check form data and try again')
                    this.loading = false
                    this.$refs.captcha.resetCaptcha()
                })
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