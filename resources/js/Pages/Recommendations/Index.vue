<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'

// Simulación de datos de recomendaciones
const recommendations = usePage().props.recommendations
const userId = usePage().props.userId

function deleteRecommendation(id) {
    if (confirm('¿Estás seguro de que quieres eliminar esta recomendación?')) {
        router.delete(route('recommendations.destroy', id), {
            onSuccess: () => {
                window - location.reload();
            }
        })
    }
}
</script>

<template>
    <AuthenticatedLayout title="Mis Recomendaciones">
        <template #header>
            <div class="relative top-20 z-0 bg-white dark:bg-gray-800 p-4 shadow-md">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <h2 class="text-xl text-center font-semibold leading-tight">Mis Recomendaciones</h2>
                    <a :href="route('recommendations.create')" class="bg-[#3c888d] text-white px-4 py-2 rounded-md text-center">
                       + Nuevo Clasicón
                    </a>
                </div>
            </div>
        </template>

        <!-- Listado de Recomendaciones -->
        <div class="p-6 mt-10 md:mt-14 bg-white dark:bg-gray-800 rounded-md shadow-md overflow-y-auto h-[calc(100vh-150px)]">
            <div v-if="recommendations.length > 0" class="space-y-4 md:overflow-x-auto">
                <!-- Tabla para escritorio -->
                <table class="hidden md:table w-full table-auto">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-white">Imagen</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-white">Título</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-white">Descripción</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-white">Categoría</th>
                            <th class="px-4 py-2 text-right text-sm font-semibold text-gray-600 dark:text-white">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="recommendation in recommendations" :key="recommendation.id"
                            class="bg-white dark:bg-gray-800">
                            <td class="px-4 py-2">
                                <img :src="`/storage/${recommendation.image}`" alt="Recommendation Image"
                                    class="w-32 h-38 object-cover rounded-md">
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ recommendation.title }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                {{ recommendation.description.length > 150 ? recommendation.description.slice(0, 150) + '...' : recommendation.description }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ recommendation.category }}</td>
                            <td class="px-4 py-2 text-right text-sm">
                                <a :href="route('recommendations.edit', recommendation.id)"
                                    class="text-[#3c888d] dark:text-blue-400 mr-4">Editar</a>
                                <button @click="deleteRecommendation(recommendation.id)"
                                    class="text-red-600 dark:text-red-400">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Vista para móviles -->
                <div v-for="recommendation in recommendations" :key="recommendation.id"
                    class="block md:hidden bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                    <img :src="`/storage/${recommendation.image}`" alt="Recommendation Image"
                        class="w-full h-48 object-cover rounded-md mb-4">
                    
                    <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ recommendation.title }}</h4>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-2">
                        {{ recommendation.description.length > 100 ? recommendation.description.slice(0, 100) + '...' : recommendation.description }}
                    </p>
                    <span class="inline-block bg-[#3c888d] text-white text-xs px-2 py-1 mt-2 rounded">{{ recommendation.category }}</span>

                    <div class="flex justify-between items-center mt-4">
                        <a :href="route('recommendations.edit', recommendation.id)"
                            class="text-[#3c888d] dark:text-blue-400">Editar</a>
                        <button @click="deleteRecommendation(recommendation.id)"
                            class="text-red-600 dark:text-red-400">Eliminar</button>
                    </div>
                </div>
            </div>

            <div v-else>
                <p class="text-gray-600 dark:text-gray-400">No has creado ninguna recomendación todavía.</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
