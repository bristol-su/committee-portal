import UploadDocuments from './components/UploadDocuments';
import Preview from './../../../../../../resources/js/components/Preview';
import TreasurerSignOff from './components/TreasurerSignOff';
import Submissions from './components/ViewSubmissions/AllSubmissions.vue';
new Vue({
    el: '#exitingtreasurer-root',

    components: {
        Submissions,
        UploadDocuments,
        Preview,
        TreasurerSignOff
    }
});