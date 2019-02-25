import VModal from 'vue-js-modal';
import Form from './utilities/Form';


window.Event = new Vue();
Vue.use(VModal, {dynamic: true, injectModalsContainer: true });

window.$defaultModalSettings = {draggable: true, adaptive: true, resizable: true};

window.VueForm = Form;