<template>
    <div class="about-winbiz">
        <transition name="fade">
            <div class="blur-filter" v-if="modal" @click="toggleModal"></div>
        </transition>
        <SectionHeader :section='section' :headerContent='headerContent' @goToJobs="goToJobs" />
        <WinbizStatistics :section='section' />
        <WinbizPartnersBlock :section='section' @goToPartnersMap='goToPartnersMap' />
        <JobApplicationBlock :section='section' id="jobs" />
        <MapBlock @toggleModal='toggleModal' :section="section" :content="partnersMapContent" id="partnership" />
        <PartnershipModal v-if="modal" @toggleModal='toggleModal' :section='section' />
        <DownloadAppBlock :downloadAppBlockContent='downloadAppBlockContent' />
    </div>
</template>

<script>
import { find } from '@/helpers';
import SplashPage from './components/SplashPage.vue';

export default {
    name: 'AboutWinbiz',
    props: ['section'],
    components: {
        SplashPage,
        SectionHeader: () => import('@/views/components/SectionHeader.vue' /*webpackChunkName: "section-header"*/),
        WinbizStatistics: () => import('@/views/Winbiz/WinbizStatistics.vue' /*webpackChunkName: "winbiz-statistics"*/),
        WinbizPartnersBlock: () => import('@/views/Winbiz/WinbizPartnersBlock.vue' /*webpackChunkName: "winbiz-partners-block"*/),
        JobApplicationBlock: () => import('@/views/Winbiz/JobApplicationBlock.vue' /*webpackChunkName: "job-application-block"*/),
        MapBlock: () => import('@/views/components/MapBlock.vue' /*webpackChunkName: "map-block"*/),
        PartnershipModal: () => import('@/views/Winbiz/PartnershipModal.vue' /*webpackChunkName: "partnership-modal"*/),
        DownloadAppBlock: () => import('@/views/components/DownloadAppBlock.vue' /*webpackChunkName: "download-app-block"*/),
    },
    data() {
        return {
            modal: false,
            selectedPartnership: ''
        }
    },
    methods: {
        toggleModal() {
            this.modal = !this.modal;
            if(this.modal)
                document.documentElement.style.overflow = "hidden";
            else
                document.documentElement.style.overflow = "auto";
        },
        goToPartnersMap() {
            return document.getElementById('partnership').scrollIntoView({
                behavior: 'smooth'
            })
        },
        goToJobs() {
            return document.getElementById('jobs').scrollIntoView({
                behavior: 'smooth', block: 'center', inline: 'center'
            })
        }
    },
    computed: {
        headerContent() {
            const headings = this.section.content;
            const collection = this.section.collections.find(c => c.type === 'jobs');
            const page = collection.pages[0];
            const backgroundImage = `url(${this.section?.fields.cover_image?.value[0].url})`;
            const productPage = this.$store.getters.getSectionByType('product')
            let content = {
                text: headings,
                backgroundCover: {backgroundImage},
                page: page,
                collectionBtn: `${this.translate('goToJobsCta')}`,
                externalBtn: `${this.translate('discoverCta')}`,
                externalRoute: productPage.slug
            }
            return content
        },
        downloadAppBlockContent() {
            const collection = find(this.section.collections, 'type', 'download_app_block');
            const pageBySlug = collection?.pages.find(p => p.type === 'winbiz_dab')
            const content = {
                title: pageBySlug.content,
                coverImage: pageBySlug.fields.cover.value[0].url
            }
            return content
        },
        partnersMapContent() {
            const page = this.section.collections.find(c => c.type === 'partners_map').pages[0];
            const content = {
                title: page.title,
                subtitle: page.content,
                partnerTypes: [
                    {
                        id: 0,
                        label: this.translate('training1'),
                        name: 'Trustee',
                        description: page.fields.trustee.value,
                        type: 'fiduciary',
                    },
                    {
                        id: 1,
                        label: this.translate('training2'),
                        name: 'Partner',
                        description: page.fields.partner.value,
                        type: 'partner'
                    },
                    {
                        id: 2,
                        label: this.translate('training3'),
                        name: 'Winbiz Specialist',
                        description: page.fields.winbiz_specialist.value,
                        type: 'specialist'
                    }
                ],
            };
            return content;
        }
    }
}
</script>