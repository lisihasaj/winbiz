<template>
    <div class="children-header d-flex justify-content-center align-items-end">
        <LogoMeta />
        <div class="children-header__container container--lg d-flex align-items-start justify-content-center">
            <div data-aos="fade-up" data-aos-delay="300" v-html="headerContent.text" class="children-header__content d-flex flex-column align-items-center justify-content-start">
            </div>
            <div class="children-header__return d-flex justify-content-start align-items-start">
                <router-link data-aos="fade-left" data-aos-delay="600" class="back-btn" :to="{name: 'section', params: {sectionSlug: section.slug}}">
                    {{label}}
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import LogoMeta from '../components/LogoMeta';
export default {
    name: 'ChildrenHeader',
    props: [
        'section',
        'headerContent',
        'label'
    ],
    components: {
        LogoMeta
    }
}
</script>