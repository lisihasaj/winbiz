<template>
    <div class="twitter-feed d-flex">
        <LoadingComponent v-if="loading" />
        <div class="twitter-feed__container container--lg d-flex">
            <div class="twitter-feed__title-wrapper d-flex flex-column">
                <div data-aos="fade-right" data-aos-delay="100" class="twitter-feed__title-content" v-html="page.content"></div>
                <a data-aos="fade-right" data-aos-delay="200" class="twitter-feed__title-cta" :href="page.fields.profile_link.value" target="_blank">
                    {{translate('seeMoreCta')}}
                </a>
            </div>
            <div data-aos="fade" data-aos-delay="300" class="twitter-feed__tweets">
                <div class="twitter-feed__tweets-container">
                    <Timeline :id="page.fields.profile_name.value" sourceType="profile" widget-class="twitter" :options="{ id: page.fields.profile_name.value }" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Tweet, Timeline } from 'vue-tweet-embed';
import LoadingComponent from '../components/LoadingComponent';

export default {
    name: 'TwitterFeed',
    props: ['section'],
    components: {
        Tweet,
        Timeline,
        LoadingComponent
    },
    data() {
        return {
            loading: true
        }
    },
    mounted() {
        setTimeout(() => {
            this.loading = false
        }, 4000)
    },
    computed: {
        page() {
            return this.section.collections.find(c => c.type === 'twitter_feed').pages.find(p => p.type === 'twitter_feed');
        }
    }
}
</script>