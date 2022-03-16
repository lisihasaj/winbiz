<template>
    <div class="video-filters d-flex">
        <form class="video-sorters-wrapper d-flex form-group">
            <div class='sorter-select__container video-sorter' v-for="sorter in sorters" :key="sorter.id">
                <label class='sorter-select__label'>{{translate('videoSorterLabel')}}</label>
                <div class='sorter-select__box d-flex flex-row justify-content-between'>
                    <select @change="handleSort($event, sorter.id)" name="sortVideos" :id="sorter.id" ref="sorters">
                        <option value="" :name="sorter.disabled" selected disabled>
                            {{sorter.disabled}}
                        </option>
                        <option v-for="(option, index) in sorter.options" :value="option" :name="option" :key="index">
                            {{option}}
                        </option>
                    </select>
                </div>
            </div>
        </form>
        <div class="video-searcher-wrapper d-flex">
            <div class="search-container d-flex align-items-end">
                <div class="search-box d-flex flex-row justify-content-end">
                    <input type="search" :placeholder="translate('searchPlaceholder')" name='search' @input="handleSearch($event)" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'VideoFilters',
    props: ['tags'],
    data() {
        return {
            sorters: [
                {
                    id: 0,
                    disabled: `${this.translate('sortByAlphabet')}`,
                    options: [
                        `${this.translate('alpha1')}`,
                        `${this.translate('alpha2')}`
                    ]
                },
                {
                    id: 1,
                    disabled: `${this.translate('sortByTopic')}`,
                    options: this.tags
                },
                {
                    id: 2,
                    disabled: `${this.translate('sortByDate')}`,
                    options: [
                        `${this.translate('date1')}`,
                        `${this.translate('date2')}`
                    ]
                },
                // {
                //     id: 3,
                //     disabled: `${this.translate('sortByDuration')}`,
                //     options: [
                //         `1 - 5 ${this.translate('duration')}`,
                //         `5 - 10 ${this.translate('duration')}`,
                //         `10 - 30 ${this.translate('duration')}`,
                //         `30 - 60 ${this.translate('duration')}`,
                //         `60 < ${this.translate('duration')}`,
                //     ]
                // },
            ]
        }
    },
    methods: {
        handleSort(event, id) {
            this.$emit('handleSort', event.target.value, id);
        },
        handleSearch(event) {
            this.$emit('handleSearch', event.target.value);
        }
    }
}
</script>