<template>
    <div class="header d-flex justify-content-center align-items-end">
        <LogoMeta />
        <div class="header-content d-flex flex-column justify-content-start align-items-center col-md-12 col-lg-11 col-xl-10 p-0" :class="{'modified': showForm || showMessage}">
            <div data-aos="fade-up" data-aos-delay="300" class="header-intro" v-html="headerContent.heading"></div>
            <button data-aos="fade-up" data-aos-delay="400" v-if="subsection.type === 'sms_gateway'" class="cta ss-cta" @click="$emit('toggleForm')">
                {{headerContent.ctaLabel}}
            </button>
            <a data-aos="fade-up" data-aos-delay="400" v-if="subsection.type === 'tele_assistance'" class="cta ss-cta" :href="headerContent.ctaRoute">
                {{headerContent.ctaLabel}}
            </a>
            <div class="header-return">
                <router-link data-aos="fade-left" data-aos-delay="600" class="back-btn" :to="{ name: 'section', params: { slug1: section.slug }}">
                    <i class="icon-left-open-big arrow"></i>
                    {{translate('returnToSupport')}}
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import LogoMeta from '../components/LogoMeta';

export default {
    name: 'SubsectionHeader',
    props: [
        'headerContent',
        'section',
        'subsection',
        //Used on sms-gateway form
        'showForm',
        'showMessage'
    ],
    components: {
        LogoMeta
    },
    computed: {
        updatesSubsection() {
            const targetSection = ['updates'];
            return targetSection.includes(this.subsection.type)
        }
    }
}
</script>