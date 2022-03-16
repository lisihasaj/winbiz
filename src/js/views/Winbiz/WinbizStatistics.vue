<template>
    <div class="winbiz-statisctics d-flex flex-column align-items-start">
        <div class="winbiz-statisctics__container container--lg d-flex flex-column justify-content-start">
            <h1 data-aos="fade-right" class="winbiz-statisctics__title">{{translate('winbizStatisticsTitle')}}</h1>
            <div data-aos="fade-right" class="winbiz-statisctics__content d-flex" v-html="section.fields.winbiz_statistics.value"></div>
        </div>
        <div class="blue-section" :style="{backgroundImage: `url(${section.fields.team_cover.value[0].url})`}"></div>
    </div>
</template>

<script>
export default {
    name: 'WinbizStatistics',
    props: ['section']
}
</script>