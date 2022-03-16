const videoFilters = {
    methods: {
        handleSearch(event) {
            this.videos = this.fetchedVideos.filter(v => v.title.toLowerCase().includes(event.toLowerCase()));
            this.$refs.sorters.$refs.sorters.map(s => {
                s.selectedIndex = 0
            })
        },
        //All video sorters by select input option
        handleSort(event, id) {
            const sorters = this.$refs.sorters.$refs.sorters;
            const filtered = sorters.filter(s => s.id !== sorters[id].id)
            filtered.map(s => {
                s.selectedIndex = 0
            })

            switch(event) {
                case this.translate('alpha1'):
                    this.$nextTick(() => {
                        const sortedByAZ = this.fetchedVideos.slice().sort((a, z) => {
                            const titleA = a.title.substring(0, 5),
                                titleZ = z.title.substring(0, 5);
                            if(titleA < titleZ) { return -1; }
                            if(titleA > titleZ) { return 1; }
                            return 0;
                        });
                        this.videos = sortedByAZ;
                    })
                break;
                case this.translate('alpha2'):
                    this.$nextTick(() => {
                        const sortedByZA = this.fetchedVideos.slice().sort((z, a) => {
                            const titleA = a.title.substring(0, 5),
                                titleZ = z.title.substring(0, 5);
                            if(titleA < titleZ) { return -1; }
                            if(titleA > titleZ) { return 1; }
                            return 0;
                        });
                        this.videos = sortedByZA;
                    })
                    break;
                case this.translate('date1'):
                    this.videos = this.fetchedVideos;
                    this.$nextTick(() => {
                        const filteredByDate = this.fetchedVideos.slice().sort((b, a) => {
                            const dateA = a.fields.date.value.split('/').reverse().join('');
                            const dateB = b.fields.date.value.split('/').reverse().join('');
                            return dateA > dateB ? 1 : dateA < dateB ? -1 : 0;
                        });
                        return this.videos = filteredByDate;
                    })
                    break;
                case this.translate('date2'):
                    this.$nextTick(() => {
                        const filteredByDate = this.fetchedVideos.slice().sort((a, b) => {
                            const dateA = a.fields.date.value.split('/').reverse().join('');
                            const dateB = b.fields.date.value.split('/').reverse().join('');
                            return dateA > dateB ? 1 : dateA < dateB ? -1 : 0;
                        });
                        return this.videos = filteredByDate;
                    })
                    break;
                default:
                    break;
            }


            switch(id) {
                case 1:
                    let videos = this.fetchedVideos
                    this.$nextTick(() => {
                        const filteredByTag = videos.filter(v => {
                            return v.tags.find(t => t.name === event);
                        });
                        return this.videos = filteredByTag;
                    });
                    break;
                default:
                    break;
            }
        }
    }
};

export default videoFilters;