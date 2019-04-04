import VModal from 'vue-js-modal';
import Form from './utilities/Form';
import CommitteeRoleSelect from "./components/CommitteeRoleSelect";
import GroupSelect from './components/GroupSelect';
import CustomFileUpload from './components/FileUpload/CustomFileUpload';
import CustomFileUploadAdminFileTable from './components/FileUpload/AdminTable';
import CustomFileUploadAdminNoteTemplate from './components/FileUpload/AdminNoteTemplate';
import DateViewer from './components/DateViewer';
import AWN from 'awesome-notifications';
import axios from 'axios';
// import PortalVue from 'portal-vue'
import ModuleLayout from "./components/HomePage/ModuleLayout";

// import vueDropzone from 'vue2-dropzone'; // Multi file upload use

// Define an event instance in which global events may be fired
window.Event = new Vue();
// Extend Vue
// Vue.use(Notifications)wir;
Vue.use(VModal);
// Vue.use(PortalVue);

// Define http provider for Vue
Vue.prototype.$http = axios;
Vue.prototype.$notify = new AWN({
    position: 'top-right'
});


// Default modal settings for the VModal
window.$defaultModalSettings = {adaptive: true, height: 'auto', scrollable: true};

window.currentReaffiliationYear = process.env.MIX_REAFFILIATION_YEAR;

// Form helper class
window.VueForm = Form;
window.DateViewer = DateViewer;
window.CustomFileUpload = CustomFileUpload;
window.CustomFileUploadAdminFileTable = CustomFileUploadAdminFileTable;
window.CustomFileUploadAdminNoteTemplate = CustomFileUploadAdminNoteTemplate;

// Main Vue Instance
new Vue({
    el: '#committee-portal-header-root',

    components: {
        'committee-role-select': CommitteeRoleSelect,
        'group-select': GroupSelect,
    }
});

// TODO Move to own file
new Vue({
    el: '#committee-portal-portal',
    components: {
        'committee-portal': ModuleLayout
    }
});

window.serveStaticContent = function (filename) {
    return 'https://'
        + process.env.MIX_AWS_STATIC_URL + '/'
        + process.env.MIX_AWS_STATIC_BUCKET + '/'
        + process.env.MIX_AWS_STATIC_FOLDER + '/'
        + filename
};


// Cookies