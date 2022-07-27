window._ = require('lodash');
try {
    require('bootstrap');
    window.bootstrap = require('bootstrap');
} catch (e) {}
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
