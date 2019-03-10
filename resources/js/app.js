import VModal from 'vue-js-modal';
import Form from './utilities/Form';
import CommitteeRoleSelect from "./components/CommitteeRoleSelect";
import GroupSelect from './components/GroupSelect';
import Notifications from 'vue-notification';
import CustomFileUpload from './components/FileUpload/CustomFileUpload';
import PortalVue from 'portal-vue'

// import vueDropzone from 'vue2-dropzone'; // Multi file upload use

// Define an event instance in which global events may be fired
window.Event = new Vue();

// Extend Vue
Vue.use(Notifications);
Vue.use(VModal);
Vue.use(PortalVue);

// Define http provider for Vue
Vue.prototype.$http = axios;

// Default modal settings for the VModal
window.$defaultModalSettings = {adaptive: true, height: 'auto'};

window.currentReaffiliationYear = process.env.MIX_REAFFILIATION_YEAR;

// Form helper class
window.VueForm = Form;

window.CustomFileUpload = CustomFileUpload;

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

