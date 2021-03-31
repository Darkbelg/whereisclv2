require('./bootstrap');

window.Vue = require('vue');

import InfiniteLoading from 'vue-infinite-loading';
Vue.use(InfiniteLoading);

Vue.component('front-page',require('./components/Front.vue').default);

const app = new Vue({
    el: '#app'
});
