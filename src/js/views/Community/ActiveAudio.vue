<template>
    <div class="active-audio-container d-flex flex-column align-items-center justify-content-start">
        <h4 class="active-audio__title">{{title}}</h4>
        <div class="active-audio__item d-flex">
            <div class="image-wrapper d-flex align-items-center justify-content-center">
                <img class="icon" src="/images/w.svg" />
                <img class="image" :src="`${selectedAudio.fields.image.value[0].url}`" />
            </div>
            <div class="audio d-flex flex-column justify-content-center align-items-start">
                <div class="d-flex flex-row justify-content-start align-items-center">
                    <i class="icon-play-circled audio__play"></i>
                    <div class="audio__title-wrapper d-flex flex-column align-items-start justify-content-between">
                        <span class="date">{{selectedAudio.fields.date.value}}</span>
                        <div class="title" v-html="selectedAudio.content"></div>
                    </div>
                </div>
                <div class="audio__progress-bar">
                    <audio :src="`${selectedAudio.fields.audio.value[0].url}`"></audio>
                </div>
                <div class="audio__tags-wrapper d-flex flex-row align-items-center justify-content-start">
                    <span class="tag" v-for="(tag, index) in selectedAudio.tags" :key="index">
                        {{tag.name}}
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'ActiveAudio',
    props: [
        'section', 
        'content',
        'selectedAudio'
    ],
    data() {
        return {
            title: 'à la une'
        }
    }
}
</script>