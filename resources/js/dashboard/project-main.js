require('../bootstrap');
Vue.component('project', require("./Project").default);
const app = new Vue({
    el: '#project'
});
