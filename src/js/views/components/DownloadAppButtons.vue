<template>
    <div class="download-app-buttons">
        <a v-for="(b, i) in buttons" :key="i" :href="b.href" target="_blank">
            <img :src='b.img' class="image"/>
        </a>
    </div>
</template>

<script>
export default {
    name: 'DownloadAppButtons',
    data() {
        return {
            buttons: [
                {
                    href: 'https://apps.apple.com/ch/app/winbiz/id1530518600?l=fr',
                    img: '/images/appStore-download.svg'
                },
                {
                    href: 'https://play.google.com/store/apps/details?id=app.winbiz&gl=CH',
                    img: '/images/playStore-download.svg'
                }
            ]
        }
    }
}
</script>