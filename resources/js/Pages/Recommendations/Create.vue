<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

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
            <div class="flex justify-center space-x-8">
                <div @click="selectCategory('book')" class="cursor-pointer text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9 2-9-18-9 18 9-2z" />
                    </svg>
                    <p class="mt-2 text-sm">Libros</p>
                </div>
                <div @click="selectCategory('movie')" class="cursor-pointer text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v1m0 8v1m7-6a5 5 0 00-10 0m10 0H5m7 4h-1m0 0H5m7 0h6m-6 0v1m0-2v-1" />
                    </svg>
                    <p class="mt-2 text-sm">Películas</p>
                </div>
                <div @click="selectCategory('series')" class="cursor-pointer text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 12h14m-7 4h7" />
                    </svg>
                    <p class="mt-2 text-sm">Series</p>
                </div>
                <div @click="selectCategory('game')" class="cursor-pointer text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m6 0v3m0-3V9m0 6h-6m6-6H9" />
                    </svg>
                    <p class="mt-2 text-sm">Juegos</p>
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
