const AppConstants = {}
AppConstants.install = function (Vue, options) {
    Vue.prototype.appConstants = {
        // mapStyle: mapStyle,
        socials: {
            facebook: {
                name: 'facebook',
                link: ''
            },
            linkedin: {
                name: 'linkedin',
                link: ''
            },
            twitter: {
                name: 'twitter',
                link: ''
            }
        },
        translations: {
            fr: {
                test: `test FR`,
            },
            en: {
                test: `test EN?`
            }
        }
    }
}

export default AppConstants