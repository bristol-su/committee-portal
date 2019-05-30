import UploadDocuments from './components/UploadDocuments';
import TreasurerSignOff from './components/TreasurerSignOff';
import AllSubmissions from './components/ViewSubmissions/AllSubmissions.vue';
import UploadRequest from './components/UploadRequest';

new Vue({
    el: '#exitingtreasurer-root',

    components: {
        AllSubmissions,
        UploadDocuments,
        TreasurerSignOff,
        UploadRequest
    }
});

Vue.prototype.$exitingtreasurerevent = new Vue();