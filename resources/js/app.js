import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

// Importaciones de Font Awesome
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faBell,faBook, faPalette, faFilm, faLeaf, faFilter, faTv, faCirclePlay, faFileVideo, faGamepad, faLocationDot ,faMusic, faLandmark, faMapMarkedAlt, faEllipsisH, faPodcast,faArchway, faSprayCan, faBuilding, faMuseum, faUtensils } from '@fortawesome/free-solid-svg-icons';

// Añadir los íconos que necesitas a la librería de Font Awesome
library.add(faBell,faBook, faLeaf, faPalette, faFilm,faFilter, faPodcast, faTv,faCirclePlay,faFileVideo,faLocationDot, faGamepad, faMusic, faLandmark, faMapMarkedAlt, faEllipsisH,faArchway, faSprayCan, faBuilding, faMuseum, faUtensils);

const appName = 'Clasicón.com';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>{
        // Intentar resolver desde ./Pages
        const pageComponent = resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'));
        if (pageComponent) {
            return pageComponent;
        }

        // Si no se encuentra en ./Pages, intentar resolver desde ./Components
        return resolvePageComponent(`./Components/${name}.vue`, import.meta.glob('./Components/**/*.vue'));
    },
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
