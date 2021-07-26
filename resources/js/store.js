import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
	modules: {
		routes: {
			namespaced: true,
			state: {
				url: []
			},

			mutations: {
				set(state, routes) {
					state.url = routes;
				}
			}
		}
	},

	getters: {
		//
	}
});