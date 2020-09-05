require('../bootstrap');
Vue.component('dashboard', require("./DashboardMain").default);
const app = new Vue({
    el: '#dashboard'
});
