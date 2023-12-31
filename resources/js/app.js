import 'fabric';

window.$ = window.jQuery = require('jquery');
window._ = require('lodash');
require('tinycolorpicker');

try {
    //require('bootstrap');
    window.bootstrap = require('bootstrap/dist/js/bootstrap.bundle.js');
} catch (e) {
    console.error('Could not load Bootstrap JS');
}



// require('mdbootstrap/js/mdb');
import 'jquery-ui/ui/widgets/draggable.js';

/**
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
