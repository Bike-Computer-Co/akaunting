import Vue from "vue";

require('./../bootstrap');
import DashboardPlugin from './../plugins/dashboard-plugin';
import Global from "../mixins/global";
Vue.use(DashboardPlugin);


const app = new Vue({
    el: '#app',

    mixins: [
        Global
    ],
});
