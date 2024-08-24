<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'

// Simulación de datos de recomendaciones
const recommendations = usePage().props.recommendations
const userId = usePage().props.userId

function deleteRecommendation(id) {
    if (confirm('¿Estás seguro de que quieres eliminar esta recomendación?')) {
        router.delete(route('recommendations.destroy', id))
    }
}
</script>

<template>
    <AuthenticatedLayout title="Mis Recomendaciones">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">Mis Recomendaciones</h2>
                <a :href="route('recommendations.create')" class="bg-blue-600 text-white px-4 py-2 rounded-md">Nueva
                    Recomendación</a>
            </div>
        </template>

        <!-- Listado de Recomendaciones -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
            <div v-if="recommendations.length > 0" class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-white">Título
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-white">Imagen
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-white">
                                Descripción</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-white">
                                Categoría</th>
                            <th class="px-4 py-2 text-right text-sm font-semibold text-gray-600 dark:text-white">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="recommendation in recommendations" :key="recommendation.id"
                            class="bg-white dark:bg-gray-800">
                            <td class="px-4 py-2">
                                <img :src="`/storage/${recommendation.image}`" alt="Recommendation Image" class="w-32 h-38 object-cover rounded-md">
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ recommendation.title }}
                            </td>

                            <!-- <td v-else class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                <span class="text-gray-500 dark:text-gray-400">No Image</span>
                            </td> -->
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ recommendation.description
                                }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ recommendation.category }}
                            </td>
                            <td class="px-4 py-2 text-right text-sm">
                                <a :href="route('recommendations.edit', recommendation.id)"
                                    class="text-blue-600 dark:text-blue-400 mr-4">Editar</a>
                                <button @click="deleteRecommendation(recommendation.id)"
                                    class="text-red-600 dark:text-red-400">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-else>
                <p class="text-gray-600 dark:text-gray-400">No has creado ninguna recomendación todavía.</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
