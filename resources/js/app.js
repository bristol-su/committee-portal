import VModal from 'vue-js-modal';
import Form from './utilities/Form';
import CommitteeRoleSelect from "./components/CommitteeRoleSelect";
import GroupSelect from './components/GroupSelect';

// Define an event instance in which global events may be fired
window.Event = new Vue();

// Extend Vue
Vue.use(Notifications);
Vue.use(VModal, {dynamic: true, injectModalsContainer: true });

// Define http provider for Vue
Vue.prototype.$http = axios;

// Default modal settings for the VModal
window.$defaultModalSettings = {adaptive: true, height: 'auto'};

// Form helper class
window.VueForm = Form;

// Main Vue Instance
new Vue({
    el: '#committee-portal-header-root',

    components: {
        'committee-role-select': CommitteeRoleSelect,
        'group-select': GroupSelect
    }
});

// Notification Vue Instance
new Vue({
    el: '#portal-notification-root',

});