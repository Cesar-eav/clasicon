<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue'

// Simulando datos de puntos
const userPoints = ref(1200)
const pointsHistory = ref([
    {
        id: 1,
        date: '2024-08-01',
        description: 'Recomendación de libro',
        points: 200
    },
    {
        id: 2,
        date: '2024-08-03',
        description: 'Comentario en recomendación',
        points: 50
    },
    {
        id: 3,
        date: '2024-08-05',
        description: 'Recomendación de película',
        points: 300
    },
    {
        id: 4,
        date: '2024-08-07',
        description: 'Reacción a una recomendación',
        points: 30
    }
])
</script>

<template>
    <AuthenticatedLayout title="Mis Puntos">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Mis Puntos
                </h2>
            </div>
        </template>

        <!-- Contenido principal -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
            <!-- Total de Puntos -->
            <div class="mb-6 text-center">
                <h3 class="text-3xl font-bold text-blue-600 dark:text-blue-400">Total de Puntos</h3>
                <p class="text-5xl font-extrabold text-gray-900 dark:text-white mt-2">{{ userPoints }}</p>
            </div>

            <!-- Historial de Puntos -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold">Historial de Puntos</h3>
                <div class="mt-4 overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-white">Fecha</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-white">Descripción</th>
                                <th class="px-4 py-2 text-right text-sm font-semibold text-gray-600 dark:text-white">Puntos</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800">
                            <tr v-for="history in pointsHistory" :key="history.id">
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ history.date }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ history.description }}</td>
                                <td class="px-4 py-2 text-right text-sm text-gray-700 dark:text-gray-300">{{ history.points }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
