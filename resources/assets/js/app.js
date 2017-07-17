
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 *
 */



Vue.component('createMember', require('./components/CreateMember.vue'));
Vue.component('editMember', require('./components/CreateMember.vue'));
Vue.component('createDepartament', require('./components/CreateDepartament.vue'));
Vue.component('createIncomes', require('./components/CreateAccounts.vue'));
Vue.component('createInternalControl', require('./components/CreateInternalControl.vue'));
Vue.component('createWeeklyIncomes', require('./components/CreateWeeklyIncomes.vue'));
Vue.component('listWeeklyInfo', require('./components/ListWeeklyInfo.vue'));
Vue.component('createExpenses', require('./components/CreateExpenses.vue'));
Vue.component('createBank', require('./components/CreateBank.vue'));
Vue.component('createChurchDeposits', require('./components/CreateChurchDeposits.vue'));
Vue.component('createCheck', require('./components/CreateCheck.vue'));
Vue.component('registroExpenses', require('./components/RegistroExpenses.vue'));
Vue.component('listsExpenses', require('./components/ListsExpenses.vue'));



const app = new Vue({
        el: '#app',


});
