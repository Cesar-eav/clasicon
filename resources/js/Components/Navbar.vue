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

import { faLeaf } from '@fortawesome/free-solid-svg-icons';
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
const showAllNotifications = ref(false);
const unreadCount = ref(0);





const markNotificationsAsRead = async () => {
    try {
        await axios.post('/api/notifications/mark-all-as-read');
        unreadCount.value = 0;
    } catch (error) {
        console.error('Error marking notifications as read:', error);
    }
};

// Función para abrir/cerrar el dropdown y marcar todas las notificaciones como leídas
const toggleDropdown = async () => {
    console.log("CLIC", showAllNotifications.value)
    if (!showAllNotifications.value) {
        await fetchAllNotifications();
        markNotificationsAsRead();
    } else{
        console.log("Cierra")
        showAllNotifications.value = false
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
        showAllNotifications.value = false


    }
};




onUnmounted(() => {
    // document.removeEventListener('click', handleClickOutside);
    document.removeEventListener('scroll', handleScroll)


});




</script>

<template>
    <nav aria-label="secondary" :class="[
        'fixed inset-x-0 top-0 z-10 px-6 py-4 bg-white flex items-center justify-between transition-transform duration-500 ',
    ]">

        <div class="flex flex-row items-center gap-2">
            <!-- Buscador -->
            <div class="relative md:left-80 left-50 ">
                <input v-model="searchQuery" @input="searchRecommendations" @focus="showResults = true"
                    @keydown.enter="goToSearchResults" type="text" placeholder="Buscar..."
                    class="px-4 py-2 md:w-80 w-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />

            </div>

        </div>

        <div class="items-center">

            <Button iconOnly variant="secondary" type="button" @click="sidebarState.isOpen = !sidebarState.isOpen"
            v-slot="{ iconSizeClasses }" class="md:hidden" srText="Search">
            <MenuIcon v-show="!sidebarState.isOpen" aria-hidden="true" :class="iconSizeClasses" />
            <XIcon v-show="sidebarState.isOpen" aria-hidden="true" :class="iconSizeClasses" />
        </Button>
            
        <Link :href="route('recommendations.sugerencia')" class="hidden md:block">
        <p  class="bg-[#3c888d] text-white px-1 py-1 rounded-md text-center">
                + Registrate
        </p>
        </Link>
        </div>
    </nav>



    <!-- Mobile bottom bar -->
    <div :class="[
        'MENU fixed inset-x-0 bottom-0 flex items-center justify-between px-4 py-4 sm:px-6 transition-transform duration-500 bg-white md:hidden',
        {
            'translate-y-full': scrolling.down,
            'translate-y-0': scrolling.up,
        },
    ]">
        <!-- <Button iconOnly variant="secondary" type="button" v-slot="{ iconSizeClasses }" srText="Search">
            <SearchIcon aria-hidden="true" :class="iconSizeClasses" />
        </Button> -->
<!-- 
        <Link :href="route('welcome')">
        <h1 class="text-black font-bold text-2xl mx-32">Inicio</h1>
        <span class="sr-only">C</span>
        </Link> -->
        <div></div>
        <Link :href="route('recommendations.sugerencia')">
        <p  class="bg-[#3c888d] text-white px-1 py-1 rounded-md text-center">
                + Registrate
        </p>
        </Link>
        <div></div>
    </div>
</template>
