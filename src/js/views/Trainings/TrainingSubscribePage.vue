<template>
    <div class="subscribe d-flex justify-content-start flex-column align-items-center">
        <LogoMeta />
        <SubscribeHeader :section='trainingsSection' :subsection='subscribeSection' />
        <!-- trainings in german are handled by an outside link -->
        <template v-if="locale === 'de'">
            <div class="subscribe-confirmator container--lg d-flex flex-column align-items-center">
                <div class="subscribe-confirmator__message col-sm-11 col-md-10 col-lg-7 col-xl-6 d-flex flex-column align-items-center">
                    <h1 v-html="translate('trainingsMessageDE')"></h1>
                    <p>{{translate('note3')}}</p>
                </div>
            </div>
        </template>
        <template v-else>
            <template v-if="!loading">
                <SubscribeCalendar v-if="!disableForm" :section='trainingsSection' :subsection='subscribeSection' :page="page" :trainings="trainings" :locations="locations" :defaultGroupId="defaultGroupId" />
                <div v-else class="subscribe-confirmator container--lg d-flex flex-column align-items-center">
                    <div class="subscribe-confirmator__message col-sm-11 col-md-10 col-lg-7 col-xl-6 d-flex flex-column align-items-center">
                        <h1>
                            <strong>{{translate('note')}}</strong> {{translate('note2')}}
                        </h1>
                        <p>{{translate('note3')}}</p>
                    </div>
                </div>
            </template>
        </template>
    </div>
</template>

<script>
import { metaConfig, formatMeta } from '../../formatMeta';
import LogoMeta from '../components/LogoMeta';
import _uniq from 'lodash/uniq';
import _groupBy from 'lodash/groupBy';

export default {
    name: 'TrainingSubscribePage',
    components: {
        LogoMeta,
        SubscribeHeader: () => import('./components/SubscribeHeader.vue' /*webpackChunkName: "subscribe-header"*/),
        SubscribeCalendar: () => import('./components/SubscribeCalendar.vue' /*webpackChunkName: "subscribe-calendar"*/),
    },
    data() {
        return {
            trainings: [],
            locations: {},
            page: {},
            loading: true,
            defaultGroupId: null
        }
    },
    mixins: [metaConfig],
    mounted () {
        if (this.subsection) {
            this.params = formatMeta(this.subsection)
            this.$nextTick( () => {
                this.$emit('updateHead')
            })
        };

        this.getTrainings().then(response => {
            const { page, groups } = response.data
            const regularGroups = groups.filter((g) => g.type === 'regular');
            const defaultGroup = groups.find((g) => g.type === 'default');

            this.trainings = _groupBy(regularGroups, 'location') || {};
            this.locations = _uniq(regularGroups.map((g) => g.location))
            this.page = page
            this.defaultGroupId = (defaultGroup) ? defaultGroup.id : null

            this.params = formatMeta(page)
            this.$nextTick( () => {
                this.$emit('updateHead')
            })

            setTimeout(() => {
                this.loading = false
            }, 0)
        }, () => {
            alert('error getting trainings')
        })
    },
    methods: {
        getTrainings () {
            return axios.get(`/${this.$route.params.locale}/api/v2/groups/next/${this.$route.params.trainingId}`)
        }
    },
    computed: {
        disableForm() {
            return Object.keys(this.locations).length === 0 && this.defaultGroupId === null;
        },
        trainingsSection () {
            return this.$store.getters.getSectionByType('trainings')
        },
        subscribeSection () {
            return this.trainingsSection.children.find((c) => c.type === 'subscribe')
        },
        locale () {
            return this.$route.params.locale
        }
    }
}
</script>