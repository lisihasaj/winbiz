<template>
    <div class="support-pages">
        <div class="container--lg d-flex flex-column align-items-center justify-content-start">
            <h1 data-aos="fade" class="support-pages__title">{{translate('pagesTitle')}}</h1>
            <ul data-aos="fade-up" data-aos-delay="200" class="support-pages__buttons d-flex align-items-center">
                <li>
                    <router-link :to="{name: 'subsection', params: { slug1: section.slug, slug2: subsection1.slug }}" class="support-pages__page d-flex flex-column justify-content-between align-items-center" >
                        <img class="icon" :src='`${subsection1.fields.page_icon.value[0].url}`' alt="" />
                        <h5 class="title">{{subsection1.title}}</h5>
                        <p class="route">{{translate('seeMoreCta')}}</p>
                    </router-link>
                </li>
                <li>
                    <a class="support-pages__page d-flex flex-column justify-content-between align-items-center" :href="`${$faqUrl}`" target="_blank">
                        <img class="icon" src='/images/faq.svg' alt="" />
                        <h5 class="title">FAQ</h5>
                        <p class="route">{{translate('seeMoreCta')}}</p>
                    </a>
                </li>
                <li>
                    <router-link :to="{name: 'subsection', params: { slug1: section.slug, slug2: subsection2.slug }}" class="support-pages__page d-flex flex-column justify-content-between align-items-center" >
                        <img class="icon" :src='`${subsection2.fields.page_icon.value[0].url}`' alt="" />
                        <h5 class="title">{{subsection2.title}}</h5>
                        <p class="route">{{translate('seeMoreCta')}}</p>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'subsection', params: { slug1: section.slug, slug2: subsection3.slug }}" class="support-pages__page d-flex flex-column justify-content-between align-items-center" >
                        <img class="icon" :src='`${subsection3.fields.page_icon.value[0].url}`' alt="" />
                        <h5 class="title">{{subsection3.title}}</h5>
                        <p class="route">{{translate('seeMoreCta')}}</p>
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SupportPages',
    props: ['section'],
    computed: {
        subsection1() {
            return this.section.children.find(ss => ss.type === 'tele_assistance');
        },
        subsection2() {
            return this.section.children.find(ss => ss.type === 'assistance_vip');
        },
        subsection3() {
            return this.section.children.find(ss => ss.type === 'downloads');
        }
    }
}
</script>