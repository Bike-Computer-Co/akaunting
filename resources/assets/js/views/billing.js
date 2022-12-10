import Vue from "vue";

require('./../bootstrap');
import DashboardPlugin from './../plugins/dashboard-plugin';
import Global from "../mixins/global";
import Form from "../plugins/form";
import BulkAction from "../plugins/bulk-action";
Vue.use(DashboardPlugin);


const app = new Vue({
    el: '#app',

    mixins: [
        Global
    ],

    data: function () {
        return {
            resume: new Form('resume'),
            cancel: new Form('cancel'),
        }
    },

    methods: {
        // Form Submit
        onResume() {
            this.form.loading = true;
            this.resume.submit();
        },
        onCancel() {
            this.form.loading = true;
            this.cancel.submit();
        },
    }
});
