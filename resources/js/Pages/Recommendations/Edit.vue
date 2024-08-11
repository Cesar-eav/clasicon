<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { useForm } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'

// Obtener la recomendación existente
const recommendation = usePage().props.recommendation

// Inicializar el formulario con los datos existentes
const form = useForm({
    title: recommendation.title,
    description: recommendation.description,
    category: recommendation.category
})

function submitForm() {
    form.put(route('recommendations.update', recommendation.id), {
        onSuccess: () => form.reset()
    })
}
</script>

<template>
    <AuthenticatedLayout title="Editar Recomendación">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight">Editar Recomendación</h2>
        </template>

        <div class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                    <input type="text" v-model="form.title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                    <textarea v-model="form.description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300"></textarea>
                </div>

                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categoría</label>
                    <select v-model="form.category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300">
                        <option value="book">Libro</option>
                        <option value="movie">Película</option>
                        <option value="game">Juego</option>
                        <option value="series">Serie</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
