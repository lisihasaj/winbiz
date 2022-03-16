<template>
    <div class="why-winbiz">
        <div class="why-winbiz-container container--lg d-flex flex-column align-items-center justify-content-start p-0">
            <h1 data-aos="fade" class="title">{{translate('whyWinbiz')}}</h1>
            <div data-aos="fade" data-aos-delay="200" v-html="section.fields.why_winbiz.value" class="why-winbiz-container__reasons d-flex col-md-12 col-lg-11 col-xl-10 justify-content-between align-items-start">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'WhyWinbiz',
    props: ['section'],
    data() {
        return {
            content: {
                title: 'Pourquoi choisir Winbiz ?'
            }
        }
    }
}
</script>