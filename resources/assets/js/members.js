/**
 * Created by anwarsarmiento on 20/5/17.
 */

Vue.component('create_member', require('./components/CreateMember.vue'));


const members = new Vue({
    el: '#newMembers',

    data: {
        name:'Anwar'
    }
});