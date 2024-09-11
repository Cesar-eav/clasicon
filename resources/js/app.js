import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

// Importaciones de Font Awesome
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faBook, faFilm, faFilter, faTv, faCirclePlay, faFileVideo, faGamepad, faLocationDot ,faMusic, faLandmark, faMapMarkedAlt, faEllipsisH, faPodcast } from '@fortawesome/free-solid-svg-icons';

// Añadir los íconos que necesitas a la librería de Font Awesome
library.add(faBook, faFilm,faFilter, faPodcast, faTv,faCirclePlay,faFileVideo,faLocationDot, faGamepad, faMusic, faLandmark, faMapMarkedAlt, faEllipsisH);

const appName = import.meta.env.VITE_APP_NAME || 'Clasicón.com';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('font-awesome-icon', FontAwesomeIcon) // Registrar FontAwesomeIcon globalmente
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
