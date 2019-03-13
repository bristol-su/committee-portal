import UserPage from './components/UserPage';
import AdminPage from './components/AdminPage';

new Vue({
    el: '#tierselection-root',

    components: {
        'tier-selection-user-page': UserPage,
        'tier-selection-admin-page': AdminPage,
    }
});