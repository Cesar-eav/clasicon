<script setup>
import { onMounted, onUnmounted, ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import {
    SearchIcon,
    MenuIcon,
    XIcon,
} from '@heroicons/vue/outline'
import {
    handleScroll,
    scrolling,
    toggleDarkMode,
    sidebarState,
} from '@/Composables'
import Button from '@/Components/Button.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import axios from 'axios'

import { faBell } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';



// Estado para almacenar la consulta de búsqueda y resultados
const searchQuery = ref('')
const searchResults = ref([])
const showResults = ref(false)

// Función para buscar recomendaciones
const searchRecommendations = () => {
    if (searchQuery.value.trim()) {
        axios.get(`/search-recommendations?query=${searchQuery.value}`)
            .then(response => {
                searchResults.value = response.data
                showResults.value = true // Mostrar resultados
            })
            .catch(error => {
                console.error('Error al buscar recomendaciones:', error)
            })
    } else {
        searchResults.value = []
        showResults.value = false
    }
}



const goToSearchResults = () => {
    if (searchQuery.value.trim()) {
        // Redirige a la vista de resultados, pasando el término de búsqueda como parámetro
        window.location.href = `/search-results?query=${searchQuery.value}`
    }
}

const dropdownOpen = ref(false);
const notifications = ref([]);
const dropdownElement = ref(null);



const fetchNotifications = () => {
    console.log("FETCH NOTIFICACTIONS L91 ");
    axios.get('/api/notifications').then(response => {
        notifications.value = response.data;
    });
};

const fetchUnreadNotifications = () => {
    console.log("UNREAD NOTIFICACTIONS L99 ");
    axios.get('/api/notifications/unread').then(response => {
        notifications.value = response.data;
    }).catch(error => {
        console.error('Error al obtener las notificaciones no leídas:', error);
    });
};

const markAsRead = (notificationId) => {
    console.log("markAsRead: LEIDA")
    axios.post(`/api/notifications/${notificationId}/mark-as-read`).then(() => {
        fetchNotifications();
    });
};

const markAllAsRead = () => {
    axios.post('/api/notifications/mark-all-as-read').then(() => {
        console.log("markAllAsRead => LEIDASSS")
        console.log(notifications.value);
        notifications.value = []

    }).catch(error => {
        console.error('Error al marcar todas las notificaciones como leídas:', error);

    });
};

// Función para abrir/cerrar el dropdown y marcar todas las notificaciones como leídas
const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value;
    if (!dropdownOpen.value) {
        markAllAsRead(); 
    }
};

// Función para manejar clics fuera del componente
const handleClickOutside = (event) => {
    // Buscar los elementos de campana y notificaciones
    console.log("CLIC FUERA");

    const bellButton = document.querySelector('.fa-bell');
    const notificationDropdown = document.querySelector('.notification-dropdown');
    
    // Si el clic no es dentro del botón de campana o del dropdown, cerrar el dropdown
    if (
        bellButton && !bellButton.contains(event.target) &&
        notificationDropdown && !notificationDropdown.contains(event.target)
    ) {
        dropdownOpen.value = false; // Cerrar el dropdown
        console.log("CIERRA DRODOWN");
        markAllAsRead(); 

    }
};



onMounted(() => {
    fetchUnreadNotifications();
    document.addEventListener('click', handleClickOutside);
    document.addEventListener('scroll', handleScroll)


});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
    document.removeEventListener('scroll', handleScroll)


});




</script>

<template>
    <nav aria-label="secondary" :class="[
        'fixed inset-x-0 top-0 z-10 px-6 py-4 bg-white flex items-center justify-between transition-transform duration-500 dark:bg-dark-eval-1',
    ]">

        <div class="flex flex-row items-center gap-2">
            <!-- Buscador -->
            <div class="relative md:left-80 left-50 ">
                <input v-model="searchQuery" @input="searchRecommendations" @focus="showResults = true"
                    @keydown.enter="goToSearchResults" type="text" placeholder="Buscar clasicones..."
                    class="px-4 py-2 md:w-80 w-40 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />


            </div>
        </div>
        <div v-if="$page.props.auth.user">
            <!-- Botón de campanita -->
            <button  @click="toggleDropdown" class="relative">
                <FontAwesomeIcon :icon="faBell" class="fas fa-bell text-2xl" />
                <span v-if="notifications.length"
                    class="absolute top-0 right-0 text-xs bg-red-500 text-white rounded-full px-1">
                    {{ notifications.length }}
                </span>
            </button>

            <!-- Dropdown de notificaciones -->
            <div v-if="dropdownOpen" class="notification-dropdown absolute bg-[#3c888d] shadow-lg rounded-md mt-2 w-64 p-4 z-10">
                <ul>
                    <li v-for="notification in notifications" :key="notification.id" class="border-b pb-2">
                        <h2 class="text-white mb-2">NOTIFICACIONES</h2>
                        <a @click="markAsRead(notification.id)" class="text-xs text-white">
                            <div v-html="notification.data.message"></div>
                        </a>
                    </li>
                </ul>
            </div >
        </div>

        <div class="items-center gap-2 ">

            <Dropdown align="right" width="48">
                <template #trigger>
                    <span class="inline-flex rounded-md">
                        <img v-if="$page.props.auth.user"
                            :src="$page.props.auth.user.profile_picture ? `/storage/${$page.props.auth.user.profile_picture}` : '/storage/images/Sin-perfil.jpg'"
                            alt="Profile Picture" class="w-10 h-10 rounded-full md:flex hidden" />
                        <img v-else src="/storage/images/Sin-perfil.jpg" alt="Profile Picture"
                            class="w-10 h-10 rounded-full md:flex hidden" />

                        <button v-if="$page.props.auth.user" type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none focus:ring focus:ring-[#3c888d] focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:bg-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">
                            {{ $page.props.auth.user.name }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <button v-else type="button "
                            class="inline-flex items-center px-3 py-2 md:mx-5 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border  rounded-md hover:text-gray-700 focus:outline-none focus:ring focus:ring-[#3c888d] focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:bg-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">
                            <a href="/login"> Acceder</a>
                        </button>
                    </span>
                </template>
                <template #content class="z-50" v-if="$page.props.auth.user">
                    <DropdownLink :href="route('profile.edit')">Perfil</DropdownLink>
                    <DropdownLink :href="route('logout')" method="post" as="button">Cerrar sesión</DropdownLink>
                </template>
            </Dropdown>
        </div>
    </nav>



    <!-- Mobile bottom bar -->
    <div :class="[
        'fixed inset-x-0 bottom-0 flex items-center justify-between px-4 py-4 sm:px-6 transition-transform duration-500 bg-white md:hidden dark:bg-dark-eval-1',
        {
            'translate-y-full': scrolling.down,
            'translate-y-0': scrolling.up,
        },
    ]">
        <Button iconOnly variant="secondary" type="button" v-slot="{ iconSizeClasses }" srText="Search">
            <SearchIcon aria-hidden="true" :class="iconSizeClasses" />
        </Button>

        <Link :href="route('dashboard')">
        <h1 class="text-black font-bold text-2xl">C</h1>
        <span class="sr-only">C</span>
        </Link>

        <Button iconOnly variant="secondary" type="button" @click="sidebarState.isOpen = !sidebarState.isOpen"
            v-slot="{ iconSizeClasses }" class="md:hidden" srText="Search">
            <MenuIcon v-show="!sidebarState.isOpen" aria-hidden="true" :class="iconSizeClasses" />
            <XIcon v-show="sidebarState.isOpen" aria-hidden="true" :class="iconSizeClasses" />
        </Button>
    </div>
</template>
