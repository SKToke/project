require('../bootstrap');
Vue.component('project-details', require("./ProjectDetails").default);
const app = new Vue({
    el: '#project-details'
});
