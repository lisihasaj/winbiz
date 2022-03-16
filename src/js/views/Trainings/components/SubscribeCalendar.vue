<template>
    <div class="subscribe-calendar container--lg d-flex flex-column justify-content-start align-items-center">
        <template v-if="!showMessage">
            <div :class="{'subscribe-calendar__disabled': calendarBlockDisabled}" class="subscribe-calendar__container px-0 col-md-12 col-lg-10 col-xl-9 d-flex flex-column align-items-center justify-content-start">
                <div class="pickers__wrapper d-flex" v-if="datesAvailable">
                    <div class="pickers__location">
                        <div class="pickers__location-title">
                            <h3>{{translate('etape1')}}</h3>
                            <p>{{translate('choosePlaceDate')}} <strong>{{page.page_title}}</strong></p>
                        </div> 
                        <div class="pickers__location-select form-group d-flex flex-column align-items-start justify-content-start">
                            <div class="checkbox pickers__location-checkbox" v-for="item in locations" :key="item">
                                <input type="checkbox" class="checkbox__toggle" name="location" :id="item" :value="item" :true-value="item" v-model="location">
                                <label :for="item" class="checkbox__label">{{item}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="pickers__schedule d-flex flex-wrap">
                        <div class="col-12 col-lg-6" v-for="item in trainings[location]" :key="item.id">
                            <label :for="item.id" class="schedule-card" :class="{'is-active': item.id === trainingGroupId}">
                                <input type="radio" :id="item.id" :value="item.id" v-model="trainingGroupId">
                                <h4 class="schedule-card__title">{{translate('schedule')}}</h4>
                                <div class="schedule-card__schedules" v-for="(time, date, index) in item['training_dates']" :key="index">
                                    <div class="d-flex justify-content-between">
                                        <p class="schedule-card__date">{{formatDate(date)}}</p>
                                        <p class="schedule-card__time d-flex flex-column"><span v-for="(time, index) in item['training_dates'][date]" :key="index">{{time.from}} - {{time.to}} &nbsp;&nbsp;</span></p>
                                    </div>
                                </div>
                                <p class="schedule-card__lecturer">{{item.lecturer_name}} <br /> <span>{{translate('lecturer')}}</span></p>
                                <p class="schedule-card__places">{{translate('availablePlaces')}}: {{item.available_participants}}</p>
                            </label>
                        </div>
                        <div class="col-12 d-flex" v-if="trainingGroupId">
                            <div class="pickers__select-forms">
                                <button @click="setCalendarBlock" v-show="!calendarBlockDisabled" class="cta">
                                    {{translate('next')}}
                                </button>
                                <i :class="[calendarBlockDisabled ? 'icon-ok-circled2-1 icon-shown' : 'icon-hidden']"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <SubscribeForm :trainingName="page.page_title" :section='section' :subsection='subsection' :locationName='location' :trainingGroupId='trainingGroupId' v-if="calendarBlockDisabled" @showForm='setCalendarBlock' @showMessage='setMessageBlock' :calendarBlockDisabled="calendarBlockDisabled" :defaultGroupId="defaultGroupId" :trainings="trainings" />
        </template>
        <template v-if="showMessage">
            <FormCompletitionMessage :messageContent='messageContent'/>
            <SharedRoutesBlock :cardsContent='cardsContent' :section='section' />
        </template>
    </div>
</template>

<script>
export default {
    name: 'SubscribeCalendar',
    props: [
        'section', 
        'subsection',
        'trainings',
        'locations',
        'page',
        'defaultGroupId'
    ],
    components: {
        SubscribeForm: () => import('./SubscribeForm.vue' /*webpackChunkName: "subscribe-form"*/),
        FormCompletitionMessage: () => import('@/views/components/FormCompletitionMessage.vue' /*webpackChunkName: "form-completition-message"*/),
        SharedRoutesBlock: () => import('./SharedRoutesBlock.vue' /*webpackChunkName: "shared-routes-block"*/),
    },
    data() {
        return {
            calendarBlockDisabled: false,
            showMessage: false,
            //For Calendar
            trainingGroupId: null,
            location: this.locations[0],
        }
    },
    mounted () {
        // training date choosing is only available for FR language
        if (!this.datesAvailable) {
            this.setCalendarBlock();
        }
    },
    watch: {
        'location': function () {
            this.trainingGroupId = null
        }
    },
    methods: {
        setCalendarBlock() {
            this.calendarBlockDisabled = !this.calendarBlockDisabled;
            if (!this.calendarBlockDisabled) {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth',
                })
            }
        },
        setMessageBlock() {
            this.showMessage = !this.showMessage;
            window.scrollTo(0,0)
        },
        formatDate (date) {
            return dayjs(date).format('DD MMM YYYY')
        }
    },
    computed: {
        //Trainings route cards
        cardsContent() {
            //This is a list of four first cards
            let collection = this.section.collections[0];
            collection.pages.map(p => {
                p.parentName = collection.name
                p.parentId = collection.id
                p.parentSlug = collection.slug
            })
            const pages = collection.pages.slice(0, 4)
            return pages
        },
        //End note message
        messageContent() {
            const text = this.subsection.fields.subscribe_end_note.value;
            const homePage = this.$store.getters.getSectionByType('home');
            let content = {
                message: text,
                home: homePage,
                btnLabel: `${this.translate('returnHome')}`,
            };
            return content
        },
        locale () {
            return this.$route.params.locale
        },
        datesAvailable () {
            return this.locale === 'fr' && Object.keys(this.trainings).length
        }
    },
}
</script>