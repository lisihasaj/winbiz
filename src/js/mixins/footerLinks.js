const footerLinks = {
    methods: {
        scrollToTop() {
            window.scrollTo(0, 0)
        }
    },
    computed: {
        homepage() {
            return this.$store.getters.getSectionByType('home');
        },
        footerSection() {
            return this.$store.getters.getSectionByType('footer');
        },
        allLinks() {
            const product = this.$store.getters.getSectionByType('product');
            const support = this.$store.getters.getSectionByType('support');
            const trainings = this.$store.getters.getSectionByType('trainings');
            const community = this.$store.getters.getSectionByType('community');
            const winbiz = this.$store.getters.getSectionByType('winbiz');
            const contact = this.$store.getters.getSectionByType('contact');
            const productDetails = product?.children.find(ss => ss.type === 'product_specs').slug;
            const smsGateway = product?.children.find(ss => ss.type === 'sms_gateway').slug;
            const assistanceVIP = support?.children.find(ss => ss.type === 'assistance_vip').slug;
            const teleAssistance = support?.children.find(ss => ss.type === 'tele_assistance').slug;
            const updates = support?.children.find(ss => ss.type === 'updates').slug;
            const downloads = support?.children.find(ss => ss.type === 'downloads').slug;
            const entrepreneurs = trainings?.collections[0].slug;
            const entrepreneursPage = trainings?.collections[0].pages[0].slug;
            const fiduciaires = trainings?.collections[1].slug;
            const fiduciairesPage = trainings?.collections[1].pages[0].slug;
            const winbizSpecialist = trainings?.collections[2].slug;
            const winbizSpecialistPage = trainings?.collections[2].pages[0].slug;
            const jobOffers = winbiz?.collections.find(c => c.type === 'jobs').pages[0]?.slug;
            let content = [
                {
                    pages: [
                        {
                            name: `${this.translate('winbizProduct')}`,
                            link: `/${this.$route.params.locale}/${product.slug}`,
                            target: '_self'
                        },
                        {
                            name: `${this.translate('appstore')}`,
                            link: 'https://winbizappstore.ch/fr/2-accueil',
                            target: '_blank'
                        },
                        {
                            name: `${this.translate('winbizOptions')}`,
                            link: `/${this.$route.params.locale}/${product.slug}/${productDetails}`,
                            target: '_self'
                        },
                        {
                            name: `${this.translate('veoprint')}`,
                            link: 'https://www.veoprint.ch/',
                            target: '_blank'
                        },
                        {
                            name: `SMS Gateway`,
                            link: `/${this.$route.params.locale}/${product.slug}/${smsGateway}`,
                            target: '_self'
                        }
                    ]
                },
                {
                    pages: [
                        {
                            name: `${this.translate('faq')}`,
                            link: `${this.$faqUrl}`,
                            target: '_blank'
                        },
                        {
                            name: `${this.translate('assistanceVIP')}`,
                            link: `/${this.$route.params.locale}/${support.slug}/${assistanceVIP}`,
                            target: '_self'
                        },
                        {
                            name: `${this.translate('versions')}`,
                            link: `/${this.$route.params.locale}/${support.slug}/${updates}`,
                            target: '_self'
                        },
                        {
                            name: `${this.translate('downloads')}`,
                            link: `/${this.$route.params.locale}/${support.slug}/${downloads}`,
                            target: '_self'
                        },
                        {
                            name: `${this.translate('teleAssistance')}`,
                            link: `/${this.$route.params.locale}/${support.slug}/${teleAssistance}`,
                            target: '_self'
                        }
                    ]
                },
                {   
                    pages: [
                        {
                            name: `${this.translate('entrepreneurs')}`,
                            link: `/${this.$route.params.locale}/${trainings.slug}/${entrepreneurs}/${entrepreneursPage}`,
                            target: '_self'
                        },
                        {
                            name: `${this.translate('trustees')}`,
                            link: `/${this.$route.params.locale}/${trainings.slug}/${fiduciaires}/${fiduciairesPage}`,
                            target: '_self'
                        },
                        {
                            name: `${this.translate('winbizSpecialist')}`,
                            link: `/${this.$route.params.locale}/${trainings.slug}/${winbizSpecialist}/${winbizSpecialistPage}`,
                            target: '_self'
                        },
                        {
                            name: `${this.translate('twitterFeed')}`,
                            link: `/${this.$route.params.locale}/${community.slug}`,
                            target: '_self'
                        },
                        {
                            name: `${this.translate('videos')}`,
                            link: `/${this.$route.params.locale}/${community.slug}`,
                            target: '_self'
                        }
                    ]
                },
                {
                    pages: [
                        {
                            name: `${this.translate('history')}`,
                            link: `/${this.$route.params.locale}/${winbiz.slug}`,
                            target: '_self'
                        },
                        {
                            name: `${this.translate('jobs')}`,
                            link: `/${this.$route.params.locale}/${winbiz.slug}/${jobOffers}`,
                            target: '_self'
                        },
                        {
                            name: `${this.translate('partnership')}`,
                            link: `/${this.$route.params.locale}/${winbiz.slug}`,
                            target: '_self'
                        },
                        {
                            name: `${this.translate('contact')}`,
                            link: `/${this.$route.params.locale}/${contact.slug}`,
                            target: '_self'
                        }
                    ]
                }
            ]
            return content;
        }
    }
}

export default footerLinks;