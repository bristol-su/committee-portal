// Module root vue instance
import UserPage from './components/UserPage';

window.CommitteeDetailsEvent = new Vue();

new Vue({

    el: '#committeedetails-root',

    components: {
        'committeedetails-user-page': UserPage,
    }

});