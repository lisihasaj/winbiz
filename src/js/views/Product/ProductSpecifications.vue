<template>
    <div class="product-specifications container--lg">
        <div class="product-specifications__pages p-0 d-flex flex-column justify-content-start align-items-center col-md-12 col-lg-11 col-xl-10">
            <div class="page" v-for="page in specs" :key="page.id">
                <div class="page__header d-flex flex-row justify-content-between align-items-center p-0" @click="expandPage(page.id)">
                    <div :id="page.id" class="page__header-content d-flex flex-column justify-content-center align-items-start p-0">
                        <h3 class="title">{{page.title}}</h3>
                        <h5 class="subtitle">{{page.fields.subtitle.value}}</h5>
                    </div>
                    <span class="page__header-expand">
                        <i class="icon-up-open-big page__header-expand__button" :class="{'arrow-down':expandedPageId === page.id}">
                        </i>
                    </span>
                </div>
                <transition name="details">
                    <div class="page__content-wrapper" v-show="expandedPageId === page.id">
                        <div class="page__content d-flex justify-content-between align-items-start" v-html="page.content">
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductSpecifications',
    props: ['specs'],
    data() {
        return {
            expandedPageId: null,
        }
    },
    methods: {
        expandPage(id) {
            const activePage = document.getElementById(id);
            if (id !== this.expandedPageId) {
                this.expandedPageId = id;
            } else {
                this.expandedPageId = null
            };

            setTimeout(() => {
                activePage.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' });
            }, 140)
        }
    }
}
</script>