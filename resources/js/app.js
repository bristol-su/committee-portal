import LogIntoRole from './components/login/LogIntoRole';
import {Spinner} from "spin.js";
import VueFormGenerator from 'vue-form-generator'
import 'vue-form-generator/dist/vfg.css'

window.Event = new Vue();

Vue.use(VueFormGenerator);

// Default modal settings for the VModal
window.$defaultModalSettings = {adaptive: true, height: 'auto', scrollable: true};

// Main Vue Instance
new Vue({
    el: '#committee-portal-header-root',

    components: {
        LogIntoRole,
    }
});


 window.serveStaticContent = function (filename) {
    return 'https://'
        + process.env.MIX_AWS_STATIC_URL + '/'
        + process.env.MIX_AWS_STATIC_BUCKET + '/'
        + process.env.MIX_AWS_STATIC_FOLDER + '/'
        + filename
};



var opts = {
    lines: 13, // The number of lines to draw
    length: 38, // The length of each line
    width: 17, // The line thickness
    radius: 45, // The radius of the inner circle
    scale: 1, // Scales overall size of the spinner
    corners: 1, // Corner roundness (0..1)
    color: '#16b5ca', // CSS color or array of colors
    fadeColor: 'transparent', // CSS color or array of colors
    speed: 1, // Rounds per second
    rotate: 0, // The rotation offset
    animation: 'spinner-line-fade-quick', // The CSS animation name for the lines
    direction: 1, // 1: clockwise, -1: counterclockwise
    zIndex: 2e9, // The z-index (defaults to 2000000000)
    className: 'spinner', // The CSS class to assign to the spinner
    top: '50%', // Top position relative to parent
    left: '50%', // Left position relative to parent
    shadow: '0 0 1px transparent', // Box-shadow for the lines
    position: 'absolute' // Element positioning
};

window.spinner = new Spinner(opts);
