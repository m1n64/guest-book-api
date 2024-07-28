import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';

import { Centrifuge } from 'centrifuge';
window.Centrifuge = Centrifuge;

/*
Echo.channel('public')
    .listen('.new.review', (e) => {
        console.log(e);
    });

Echo.channel('private.1')
    .listen('.new.reply', (e) => {
        console.log(e);
    });
*/
