window.Quill = require('quill');
require('fullcalendar');
window.$ = window.jQuery = require('jquery');
window.moment = require('moment');
require('bootstrap-sass');
require('./modal-validation');

window.debounce = function(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};