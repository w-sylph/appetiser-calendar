import './bootstrap.js';
import './mixins/global.js';

Vue.component('app', require('./pages/App.vue').default);

import store from './store';

const app = {
    async getRoutes() {
        return new Promise((resolve, reject) => {
            axios.post('/init/routes')
            .then(response => {
                let data = response.data;
                store.commit('routes/set', data.routes);
                resolve();
            }).catch(error => {
                console.log(error);
                reject();
            }).then(() => {

            });
        });
    },

    async init() {
        await this.getRoutes();

        /* eslint-disable vue/require-name-property */
        new Vue({
            el: '#app',
            store
        });
    }
};

app.init();
