<template>
    <div class="map-block" :class="{'course-map': section.type === 'trainings'}">
        <div class="map-block__container container--lg d-flex">

            <div class="map-block__content d-flex flex-column align-items-start justify-content-start px-0 col-sm-12 col-md-10 col-xl-4">
                <div class="title">
                    <h1 data-aos="fade-right">{{content.title}}</h1>
                    <p data-aos="fade-right" v-html="content.subtitle"></p>
                </div>
                <form class="partner-selectors d-flex flex-column align-items-start justify-content-start">
                    <div class="checkbox-ex partner-checkbox">
                        <input type="checkbox" class="checkbox-ex__toggle" :value="translate('branches')">
                        <div class="checkbox-ex__label-wrapper d-flex flex-column align-items-start justify-content-start">
                            <label class="checkbox-ex__label">{{translate('branches')}}</label>
                        </div>
                    </div>
                    <div v-for="(partner, index) in content.partnerTypes" :key="index" class="checkbox-ex partner-checkbox">
                        <input ref="partnersCheckbox" type="radio" class="checkbox-ex__toggle" :id="partner.key" :value="partner.type" v-model="typeOfPartner" />
                        <div class="checkbox-ex__label-wrapper d-flex flex-column align-items-start justify-content-start">
                            <label class="checkbox-ex__label" :for="partner.key">{{partner.label}}</label>
                            <p class="checkbox-ex__description">{{partner.description}}</p>
                        </div>
                    </div>
                    <p v-if="section.type === 'winbiz'" data-aos="fade-right" class="partner-description">{{translate('callToBecomePartner')}}</p>
                </form>
                <button v-if="section.type === 'winbiz'" class="cta" @click='toggleModal'>
                    {{translate('applyForPartnerCta')}}
                </button>
            </div>

            <div class="map-block__map d-flex flex-column justify-content-end px-0 col-md-12 col-xl-8">
                <div class="search-block">
                    <div data-aos="fade-left" data-aos-delay="200" class='search-block__input-box'>
                        <i class="icon-search-1 search-block__icon"></i>
                        <input id="autocomplete" type='search' :placeholder="translate('searchPlaceholder')" name='search' class='search-block__input' />
                    </div>
                </div>
                <div data-aos="fade" class="map-box" id="map">
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
import mapSettings from '@/mixins/mapSettings';

export default {
    name: 'MapBlock',
    props: [
        'section',
        'content'
    ],
    mixins: [mapSettings],
    methods: {
        toggleModal() {
            this.$emit('toggleModal');
        },
    }
}
</script>