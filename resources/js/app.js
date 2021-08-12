require('./bootstrap');

import Vue from 'vue';

import InfiniteLoading from 'vue-infinite-loading';

Vue.use(InfiniteLoading);
// Vue.use(P5);
// Vue.use(Mappa);

Vue.component('front-page',require('./components/Front.vue').default);
Vue.component('world-map',require('./components/WorldMap.vue').default);

const app = new Vue({
    el: '#app'
});
