import translations from "@/translations";

let Plugins = {}

Plugins.install = function (Vue, options) {
	Vue.prototype.fullScreenUrl = function (src) {
			return croppa.url(src, 2200, null, ['resize'])
	}

	Vue.prototype.thumbnailUrl = function (src) {
			return croppa.url(src, 500, null, ['resize'])
	}
	Vue.prototype.checkField = function (a, fieldName) {
		if (a.fields[fieldName]) {
			const object = a.fields[fieldName]
			const objectValue = object.value
			if (object && objectValue) {
				return true
			} else {
				return false
			}
		}
	}
	Vue.prototype.translate = function (key) {
		if (translations[this.$route.params.locale][key]) {
			return translations[this.$route.params.locale][key];
		}
		return '';
	};
}


export default Plugins
