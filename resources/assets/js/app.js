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


/**
 * Componentes de ingreso de informacion nueva.
 */
Vue.component('createMember', require('./components/Creating/CreateMember.vue'));
Vue.component('createMemberCampo', require('./components/Creating/CreateMemberCampo.vue'));
Vue.component('createVisitor', require('./components/Creating/CreateVisitor.vue'));
Vue.component('createja', require('./components/Creating/CreateJaEvent.vue'));
Vue.component('createDepartament', require('./components/Creating/CreateDepartament.vue'));
Vue.component('createIncomes', require('./components/Creating/CreateAccounts.vue'));
Vue.component('createInternalControl', require('./components/Creating/CreateInternalControl.vue'));
Vue.component('createWeeklyIncomes', require('./components/Creating/CreateWeeklyIncomes.vue'));
Vue.component('createExpenses', require('./components/Creating/CreateExpenses.vue'));
Vue.component('createBank', require('./components/Creating/CreateBank.vue'));
Vue.component('createChurchDeposits', require('./components/Creating/CreateChurchDeposits.vue'));
Vue.component('createLocalDeposits', require('./components/Creating/CreateLocalDeposits.vue'));
Vue.component('createCheck', require('./components/Creating/CreateCheck.vue'));
Vue.component('createChurchPublic', require('./components/Creating/CreateChurchPublic.vue'));


Vue.component('createUserCargo', require('./components/LocalField/CreateUserCargo.vue'));
Vue.component('createUser', require('./components/Creating/CreateUser.vue'));
Vue.component('createAssistance', require('./components/Creating/CreateAssistance.vue'));
/**
 * Clubes Jovenes
 */
Vue.component('createCardMember', require('./components/Creating/CreateCardMember.vue'));
Vue.component('createCardMemberAventureros', require('./components/Creating/CreateCardMemberAventureros.vue'));
Vue.component('createCardMemberCampo', require('./components/Creating/CreateCardMemberCampo.vue'));
Vue.component('createClubDirector', require('./components/Creating/CreateClubDirector.vue'));
/**
 * Editores de tablas
 */

Vue.component('editMember', require('./components/Editors/EditMember.vue'));
Vue.component('editClaveUser', require('./components/Editors/EditClaveUser.vue'));
Vue.component('editorsDepartament', require('./components/Editors/EditorDepartament.vue'));
/**
 * Listas de datos en tablas tipo dataTable
 */
Vue.component('listsIncomeAccounts', require('./components/Lists/ListsIncomeAccounts.vue'));
Vue.component('listsExpenses', require('./components/Lists/ListsExpenses.vue'));
Vue.component('listsExpenseAccounts', require('./components/Lists/ListsExpenseAccounts.vue'));
Vue.component('listWeeklyInfo', require('./components/Lists/ListWeeklyInfo.vue'));
Vue.component('listsMembers', require('./components/Lists/ListsMembers.vue'));
Vue.component('listsVisitor', require('./components/Lists/ListsVisitor.vue'));
Vue.component('listsChecks', require('./components/Lists/ListsChecks.vue'));
Vue.component('listsInternalControls', require('./components/Lists/ListsInternalControls.vue'));
Vue.component('listsDepartaments', require('./components/Lists/ListsDepartaments.vue'));
Vue.component('listsCheckExpenses', require('./components/Lists/ListsCheckExpenses.vue'));
Vue.component('listsProfile', require('./components/View/ListProfile.vue'));
Vue.component('viewProfile', require('./components/View/Profile.vue'));
/**
 * Otros fromularios
 */
Vue.component('transferAccount', require('./components/TransferAccounts.vue'));
Vue.component('depositLocalField', require('./components/DepositLocalField.vue'));
Vue.component('registroExpenses', require('./components/RegistroExpenses.vue'));


const app = new Vue({
    el: '#app',
});
