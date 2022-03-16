<template>
    <div class="contact-form">
        <ValidationObserver ref="observer" class="contact-form__container d-flex flex-column align-items-center" :class="{'disabled-form': loading}">
            <ValidationProvider rules="required" v-slot="{errors}" :name="translate('gender')" class="contact-form__radios d-flex">
                <p class="contact-form__radios-title">{{translate('genderRadioLabel')}} *</p>
                <div class="contact-form__radios-wrapper d-flex">
                    <div class="radio contact-form__radios-item">
                        <input name="gender" id="female" :value="translate('female')" class="radio__input contact-form__radios-item__input" type="radio" v-model="radios.value" />
                        <span class="radio__radio contact-form__radios-item__radio"></span>
                        <label for="female">{{translate('female')}}</label>
                    </div>
                    <div class="radio contact-form__radios-item">
                        <input name="gender" id="male" :value="translate('male')" class="radio__input contact-form__radios-item__input" type="radio" v-model="radios.value" />
                        <span class="radio__radio contact-form__radios-item__radio"></span>
                        <label for="male">{{translate('male')}}</label>
                    </div>
                </div>
                <span class="radio-error">{{errors[0]}}</span>
            </ValidationProvider>
            <div class="contact-form__inputs-wrapper d-flex">
                <ValidationProvider rules="required" v-slot="{errors}" v-for="(textInput, index) in textInputs" :name="textInput.placeholder" :key="index" class="input contact-form__inputs-item">
                    <label>{{textInput.label}}</label>
                    <div class="input-box">
                        <input :placeholder="textInput.placeholder" :type="textInput.type" v-model="textInput.value"/>
                    </div>
                    <span class="input-error">{{errors[0]}}</span>
                </ValidationProvider>
                <div class="input contact-form__inputs-item">
                    <label>{{translate('customerId')}}</label>
                    <div class="input-box">
                        <input :placeholder="translate('customerId')" v-model="clientId.value"/>
                    </div>
                </div>
                <div class="input contact-form__inputs-item">
                    <label>{{translate('telephone')}}</label>
                    <div class="input-box">
                        <input :placeholder="translate('telephone')" type="number" v-model="teleInput.value" />
                    </div>
                </div>
                <ValidationProvider rules="required|min:20" v-slot="{errors}" :name="translate('messagePlaceholder')" class="textarea contact-form__textarea">
                    <label>{{translate('messageLabel')}} *</label>
                    <div class="textarea-box">
                        <textarea :placeholder="translate('messagePlaceholder')" v-model="textarea.value" type="text" rows="4"></textarea>
                    </div>
                    <span class="textarea-error">{{errors[0]}}</span>
                </ValidationProvider>
                <div class="file-input">
                    <p class="label">{{translate('uploadFile')}}</p>
                    <label class="file-input-box">
                        <input type="file" name="file" id="file" ref="fileUploader" @change="onFileChange" />
                        <i class="icon-upload-cloud file-input-icon"></i>
                        <p class="file-input-expression" ref="fileUploaderExpression">
                            <template v-if="!file">{{translate('noFile')}}</template>
                            <template v-else>{{translate('oneFile')}}</template>
                        </p>
                    </label>
                </div>
                <Recaptcha ref="captcha" @value="updateCaptchaToken" />
            </div>
        </ValidationObserver>
        <div class="contact-form__button d-flex flex-row align-items-center">
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
    name: 'ContactForm',
    props: [
        'section',
        'showContactForm',
        'formData'
    ],
    mixins: [formMixin],
    components: {
        Recaptcha
    },
    data() {
        return {
            radios: {value: ''},
            textInputs: [
                {
                    id: 0,
                    label: `${this.translate('forename')} *`,
                    placeholder: `${this.translate('forename')}`,
                    type: 'text',
                    key: 'forename',
                    value: ''
                },
                {
                    id: 1,
                    label: `${this.translate('name')} *`,
                    placeholder: `${this.translate('name')}`,
                    type: 'text',
                    key: 'name',
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
                {
                    id: 3,
                    label: `${this.translate('companyName')} *`,
                    placeholder: `${this.translate('companyName')}`,
                    type: 'text',
                    key: 'companyName',
                    value: ''
                },
            ],
            teleInput: {value: ''},
            clientId: {value: ''},
            textarea: {value: ''},
            file: null,
            loading: false,
            captchaToken: null,
        }
    },
    methods: {
        updateCaptchaToken(data) {
            this.captchaToken = data
        },
        onSubmit() {
            let formData = new FormData();

            this.loading = true;

            formData.append('language', this.$route.params.locale);
            formData.append('stepOne', this.formData.stepOne);
            formData.append('stepTwo', this.formData.stepTwo);
            formData.append('gender', this.radios.value);
            formData.append('clientId', this.clientId.value)
            formData.append('telephone', this.teleInput.value);
            formData.append('message', this.textarea.value);
            formData.append('captchaToken', this.captchaToken);

            this.textInputs.map(i => {
                formData.append(`${i.key}`, i.value);
            });

            if (this.file) {
                formData.append('attachment', this.file);
            }

            axios.post(`/${this.$route.params.locale}/api/v2/contact/send`, formData)
                .then(response => {
                    setTimeout(() => {
                        this.$emit('setShowMessage');
                        this.loading = false;
                        this.$refs.captcha.resetCaptcha()
                        console.log(this.formData);
                    }, 3000)
                })
                .catch(error => {
                    console.log(error.response.data);
                    this.$refs.captcha.resetCaptcha()
                })
        },
        async submitForm () {
            const isValid = await this.validateForm();

            if (isValid) {
                this.onSubmit();
            }
        },
        onFileChange () {
            const file = this.$refs.fileUploader.files[0];
            this.file = file;
        }
    },
    // computed: {
    //     setFormData: {
    //         get() { return this.formData },
    //         set(value) {
    //             this.$emit('update:formData', value);
    //         }
    //     }
    // },
}
</script>