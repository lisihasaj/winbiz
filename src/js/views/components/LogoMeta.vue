<template>
    <div class="logo-meta__wrapper container--lg d-flex justify-content-end align-items-start">
        <div :class="{'meta-modifier' : blackMeta, 'white-triangle' : whiteTriangle}" class="logo-meta__items">
            <p>{{translate('logoWord1')}}</p>
            <p>{{translate('logoWord2')}}</p>
            <p>{{translate('logoWord3')}}</p>
        </div>
    </div>
    
</template>

<script>
export default {
    name: 'LogoMeta',
    methods: {
        activeSubsection(subSectionType) {
            const parent = this.activeSection,
                child = parent.children.find(c => c.slug === this.$route.params.slug2);
            if (child?.type === subSectionType)
                return true
            return false;
        },
    },
    computed: {
        activeSection() {
            if(this.$route.name !== 'home')
                return this.$store.getters.getSectionBySlug(this.$route.params.slug1);
            else 
                return this.$store.getters.homeSection
        },
        blackMeta() {
            const targetSection = ['contact', 'terms', 'free_test', 'winbiz_local'];
            if (targetSection.includes(this.activeSection.type))
                return true;
            else if (this.activeSubsection('product_specs') ||
                this.activeSubsection('assistance_vip') || 
                this.activeSubsection('tele_assistance') || 
                this.activeSubsection('sms_gateway') || 
                this.activeSubsection('updates') ||
                this.activeSubsection('downloads') ||
                this.activeSubsection('subscribe'))
                return true;

            return false;
        },
        whiteTriangle() {
            const targetSection = ['support'];
            return targetSection.includes(this.activeSection.type)
        }
    },
}
</script>