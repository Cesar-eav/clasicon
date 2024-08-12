<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faBook, faFilm, faTv, faGamepad, faMusic, faLandmark, faMapMarkedAlt, faEllipsisH } from '@fortawesome/free-solid-svg-icons'

// Estado para mostrar u ocultar el formulario y para la categoría seleccionada
const selectedCategory = ref(null)

// Formulario para crear una nueva recomendación
const form = useForm({
    title: '',
    description: '',
    category: ''
})

// Función para seleccionar la categoría
function selectCategory(category) {
    selectedCategory.value = category
    form.category = category
}

// Función para enviar el formulario
function submitForm() {
    form.post(route('recommendations.store'), {
        onSuccess: () => {
            form.reset()
            selectedCategory.value = null
        }
    })
}

// Función para volver a la selección de categorías
function goBack() {
    selectedCategory.value = null
}
</script>

<template>
    <AuthenticatedLayout title="Nueva Recomendación">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight">Crear Nueva Recomendación</h2>
        </template>

        <!-- Si no se ha seleccionado una categoría, muestra los íconos -->
        <div v-if="!selectedCategory" class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md text-center">
            <p class="text-lg mb-4">Selecciona una categoría:</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div @click="selectCategory('book')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'book']" class="text-blue-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Libros</p>
                </div>
                <div @click="selectCategory('movie')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'film']" class="text-green-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Películas</p>
                </div>
                <div @click="selectCategory('series')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'tv']" class="text-red-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Series</p>
                </div>
                <div @click="selectCategory('game')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'gamepad']" class="text-purple-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Juegos</p>
                </div>
                <div @click="selectCategory('music')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'music']" class="text-yellow-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Música</p>
                </div>
                <div @click="selectCategory('museum')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'landmark']" class="text-orange-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Museos</p>
                </div>
                <div @click="selectCategory('tourism')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'map-marked-alt']" class="text-teal-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Destinos Turísticos</p>
                </div>
                <div @click="selectCategory('other')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'ellipsis-h']" class="text-gray-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Otras</p>
                </div>
            </div>
        </div>

        <!-- Si se ha seleccionado una categoría, muestra el formulario -->
        <div v-else class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Recomendar {{ selectedCategory }}</h3>
                <button @click="goBack" class="bg-gray-600 text-white px-4 py-2 rounded-md">Volver</button>
            </div>
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                    <input type="text" v-model="form.title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                    <textarea v-model="form.description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300"></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Guardar Recomendación</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
