<template>
    <div class="contact__header d-flex justify-content-center align-items-end">
        <LogoMeta />
        <div class="contact__header-content d-flex justify-content-center align-items-start">
            <div data-aos="fade-up" data-aos-delay="300" v-html="section.content" class="contact__header-text d-flex flex-column align-items-center">
            </div>
        </div>
    </div>
</template>

<script>
import LogoMeta from '../components/LogoMeta';

export default {
    name: 'ContactHeader',
    props: ['section'],
    components: {
        LogoMeta
    }
}
</script>