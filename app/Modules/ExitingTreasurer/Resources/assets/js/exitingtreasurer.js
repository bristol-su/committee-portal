import UploadDocuments from './components/UploadDocuments';
import Preview from './../../../../../../resources/js/components/Preview';
import TreasurerSignOff from './components/TreasurerSignOff';
import AllSubmissions from './components/ViewSubmissions/AllSubmissions.vue';
import Reports from "./components/Reports";

new Vue({
    el: '#exitingtreasurer-root',

    components: {
        AllSubmissions,
        UploadDocuments,
        Preview,
        TreasurerSignOff,
        Reports
    }
});