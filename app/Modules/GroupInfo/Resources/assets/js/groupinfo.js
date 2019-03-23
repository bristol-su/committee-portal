import AdminTable from "./components/AdminTable";
import GroupInformation from "./components/GroupInformation";

new Vue({
    el: '#groupinfo-root',

    components: {
        'group-admin-info': AdminTable,
        'group-info': GroupInformation
    }
});