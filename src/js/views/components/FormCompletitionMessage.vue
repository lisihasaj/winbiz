<template>
    <div id='message' data-aos="fade" data-aos-delay="600" class="form-message-wrapper container--lg d-flex flex-column justify-content-start align-items-center">
        <div class="form-message__box px-0 col-md-12 col-lg-8 col-xl-7 d-flex flex-column align-items-center justify-content-center">
            <div class="form-message__text d-flex flex-column align-items-center justify-content-center" v-html="messageContent.message">
            </div>
            <router-link class="back-btn" :to="{ name: 'home'}">
                {{messageContent.btnLabel}}
            </router-link>
        </div>
    </div>
</template>

<script>

export default {
    name: 'FormCompletitionMessage',
    props: [
        'messageContent'
    ],
    mounted() {
        const box = document.getElementById('message');
        box.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' });
    }
}
</script>