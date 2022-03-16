<template>
    <vue-recaptcha ref="gcaptcha" :sitekey="siteKey" :loadRecaptchaScript="true" @verify="onVerify" @expired="onExpire" :language="locale"></vue-recaptcha>
</template>

<script>
import VueRecaptcha from 'vue-recaptcha';

export default {
    components: { VueRecaptcha },
    data() {
        return {
            invalidCaptcha: true,
            siteKey: this.$recaptchaKey,
            locale: this.$route.params.locale
        }
    },
    methods: {
        onVerify (token) {
            this.invalidCaptcha = false
            this.emitValue(token)
        },
        onExpire () {
            this.invalidCaptcha = true
            this.emitValue(null)
        },
        resetCaptcha () {
            this.$refs.gcaptcha.reset()
        },
        emitValue (token = null) {
            this.$emit('value', token)
        }
    }
};
</script>