require('./bootstrap');

import Vue from 'vue';
window.P5 = require('p5');
window.Mappa = require('mappa-mundi');

import InfiniteLoading from 'vue-infinite-loading';
Vue.use(InfiniteLoading);

Vue.component('front-page',require('./components/Front.vue').default);
Vue.component('world-map',require('./components/WorldMap.vue').default);

const app = new Vue({
    el: '#app'
});
