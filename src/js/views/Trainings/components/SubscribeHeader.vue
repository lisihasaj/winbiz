<template>
    <div class="subscribe-header container--lg d-flex justify-content-center align-items-start">
        <div class="subscribe-header__content d-flex justify-content-center align-items-end px-0 col-sm-12 col-md-12 col-lg-10 col-xl-9">
            <div class="subscribe-header__title" v-html="subsection.content"></div>
            <div class="subscribe-header__return">
                <router-link class="back-btn" :to="{name: 'page', params: { slug1: $route.params.slug1, slug2: $route.params.slug2, slug3: $route.params.slug3 }}">
                    {{translate('returnToTrainings')}}
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SubscribeHeader',
    props: [
        'section',
        'subsection'
    ],
}
</script>