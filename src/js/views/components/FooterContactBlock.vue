<template>
    <div class="contact-block">
        <h3 data-aos="fade-up" class="contact-block__title">{{translate('footerTitle')}}</h3>
        <a data-aos="fade-up" data-aos-delay="100" class="contact-block__phone-number" :href="`tel:${footerSection.fields.phone_number.value}`">
            {{footerSection.fields.phone_number.value}}
        </a>
        <p data-aos="fade-up" data-aos-delay="200" class="contact-block__subtitle">{{footerSection.fields.schedules.value}}</p>
        <router-link data-aos="fade-up" data-aos-delay="400" class="cta" :to="{name: 'section', params: {slug1: contactPage.slug}}">
            {{translate('contactFormCta')}}
        </router-link>
    </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
    name: 'FooterContactBlock',
    computed: {
        ...mapState([
            'sections'
        ]),
        footerSection() {
            return this.sections.find(s => s.type === 'footer');
        },
        contactPage() {
            return this.sections.find(s => s.type === 'contact')
        }
    }
}
</script>