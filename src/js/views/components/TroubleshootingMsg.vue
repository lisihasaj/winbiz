<template>
    <div v-if="page && show" data-aos="fade" class="troubleshooting-msg">
        <div class="troubleshooting-msg__box">
            <div class="troubleshooting-msg__content container--lg">
                <div class="text" v-html="page.content"></div>
                <button @click="hidePopup">{{translate('close')}}</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TroubleshootingMsg',
    data () {
        return {
            show: true,
        }
    },
    methods: {
        hidePopup() {
            this.show = false;
        }
    },
    computed: {
        page() {
            return this.$store.getters.getSectionByType('home').collections.find(c => c.type === 'troubleshooting_msg').pages.find(p => p.type === 'troubleshooting_msg');
        }
    }
}
</script>