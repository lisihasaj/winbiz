<template>
    <div class="job-application">
        <div class="job-application__container container--lg d-flex flex-column align-items-center justify-content-center">
            <div data-aos="fade" class="job-application__block-content" v-html="section.fields.job_application_block.value"></div>
            <a data-aos="fade" href="mailto:jobs@winbiz.ch" class="cta">
                {{translate('applyCta')}}
            </a>
            <div class="job-application__cards d-flex col-sm-12 col-md-10 col-xl-9">
                <router-link data-aos="fade-up" v-for="(card, index) in cardsContent.pages" :key="index" class="card" :to="{name: 'subsection', params: {slug1: section.slug, slug2: card.slug}}">
                    <div class="card-box"></div>
                    <div class="card-content d-flex flex-column align-items-start justify-content-between">
                        <div class="card-tags d-flex flex-row align-items-center">
                            <span class="tag" v-for="(tag, index) in card.tags" :key="index">
                                {{tag.name}}
                            </span>
                        </div>
                        <h5 class="card-title">
                            {{card.title}}
                        </h5>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'JobApplicationBlock',
    props: ['section'],
    computed: {
        cardsContent() {
            return this.section.collections.find(c => c.type === 'jobs');
        }
    }
}
</script>