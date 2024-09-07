<script setup>
import { onMounted, onUnmounted, ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import { useFullscreen } from '@vueuse/core'
import {
    SunIcon,
    MoonIcon,
    SearchIcon,
    MenuIcon,
    XIcon,
    ArrowsExpandIcon
} from '@heroicons/vue/outline'
import {
    handleScroll,
    isDark,
    scrolling,
    toggleDarkMode,
    sidebarState,
} from '@/Composables'
import Button from '@/Components/Button.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import { ArrowsInnerIcon } from '@/Components/Icons/outline'
import axios from 'axios'

const { isFullscreen, toggle: toggleFullScreen } = useFullscreen()

onMounted(() => {
    document.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
    document.removeEventListener('scroll', handleScroll)
})

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

// Función para manejar clics fuera del componente
const handleClickOutside = (event) => {
    const searchContainer = document.querySelector('.search-container')
    if (searchContainer && !searchContainer.contains(event.target)) {
        showResults.value = false
    }
}

// Escucha el clic en todo el documento para cerrar los resultados al hacer clic fuera
onMounted(() => {
    document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside)
})

// Función para seleccionar una recomendación
const selectRecommendation = (result) => {
    console.log('Recomendación seleccionada:', result)
    showResults.value = false // Cerrar la lista de resultados
}
</script>

<template>
    <nav aria-label="secondary" :class="[
        'fixed inset-x-0 top-0 z-10 px-6 py-4 bg-white flex items-center justify-between transition-transform duration-500 dark:bg-dark-eval-1',
    ]">

        <div class="flex flex-row items-center gap-2">
            <!-- Buscador -->
            <div class="relative search-container md:left-80 left-50 ">
                <input 
                    v-model="searchQuery"
                    @input="searchRecommendations"
                    @focus="showResults = true"
                    type="text" 
                    placeholder="Buscar clasicones..." 
                    class="px-4 py-2 md:w-80 w-40 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                />

                <!-- Resultados de la búsqueda -->
                <ul v-if="showResults && searchResults.length > 0" 
                    class="absolute left-0 mt-2 w-full bg-white border border-gray-300 rounded-lg shadow-lg max-h-40 overflow-y-auto z-50">
                    <li v-for="result in searchResults" 
                        :key="result.id" 
                        class="px-4 py-2 hover:bg-gray-100 cursor-pointer" 
                        @click="selectRecommendation(result)">
                        <Link :href="route('social.clasicon', result.id)" class="inline-flex items-center gap-2">{{ result.title }}</Link>
                    </li>
                </ul>
            </div>
        </div>

        <div class="items-center gap-2 ">
            <Button iconOnly variant="secondary" type="button" @click="toggleDarkMode" v-slot="{ iconSizeClasses }" class="hidden md:inline-flex" srText="Toggle dark mode">
            </Button>

            <Dropdown align="right" width="48">
                <template #trigger>
                    <span class="inline-flex rounded-md">
                        <img :src="$page.props.auth.user.profile_picture ? `/storage/${$page.props.auth.user.profile_picture}` : '/storage/images/Sin-perfil.jpg'"
                             alt="Profile Picture" class="w-10 h-10 rounded-full md:flex hidden " />
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none focus:ring focus:ring-purple-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:bg-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">
                            {{ $page.props.auth.user.name }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </template>

                <template #content class="z-50">
                    <DropdownLink :href="route('profile.edit')">Perfil</DropdownLink>
                    <DropdownLink :href="route('logout')" method="post" as="button">Cerrar sesión</DropdownLink>
                </template>
            </Dropdown>
        </div>
    </nav>
</template>
