/* eslint-disable vue/require-name-property */
Vue.mixin({
    computed: {
        routes() {
            return this.$store.state.routes.url;
        }
    }
});