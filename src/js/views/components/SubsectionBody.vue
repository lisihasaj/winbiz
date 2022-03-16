<template>
    <div class="subsection-body__content d-flex flex-column justify-content-start align-items-center px-0">
        <div class="subsection-body__wrapper d-flex col-md-12 col-lg-11 col-xl-10 px-0">
            <div class="text col-sm-12 col-md-6 col-lg-7 col-xl-8 p-0" v-html="subsection.fields.page_text.value"></div>
            <a data-aos="fade" data-aos-delay="600" :href="`${$faqUrl}`" class="faq-page d-flex flex-column justify-content-start align-items-center col-9 col-sm-8 col-md-5 col-lg-4 col-xl-3">
                <img class="icon" src="/images/faq.svg" alt="" />
                <h5 class="title">{{translate('needBackUp')}}</h5>
                <p class="route">{{translate('seeMoreCta')}}</p>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SubsectionsBody',
    props: ['section', 'subsection'],
}
</script>