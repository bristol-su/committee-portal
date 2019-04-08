import UploadDocuments from './components/UploadDocuments';
import TreasurerSignOff from './components/TreasurerSignOff';
import AllSubmissions from './components/ViewSubmissions/AllSubmissions.vue';

new Vue({
    el: '#exitingtreasurer-root',

    components: {
        AllSubmissions,
        UploadDocuments,
        TreasurerSignOff,
    }
});

Vue.prototype.$exitingtreasurerevent = new Vue();