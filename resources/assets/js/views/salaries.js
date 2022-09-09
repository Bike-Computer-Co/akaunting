/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import BulkAction from "../plugins/bulk-action";

require('./../bootstrap');

import Vue from 'vue';

import DashboardPlugin from './../plugins/dashboard-plugin';

import Global from './../mixins/global';

import Form from './../plugins/form';

// plugin setup
Vue.use(DashboardPlugin);

const app = new Vue({
    el: '#main-body',

    mixins: [
        Global
    ],

    data: function () {
        return {
            form: new Form('salary'),
        }
    },

});
