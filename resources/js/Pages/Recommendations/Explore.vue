<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'

const recommendations = usePage().props.recommendations
</script>

<template>
    <AuthenticatedLayout title="Explorar Recomendaciones">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight">Explorar Recomendaciones</h2>
        </template>

        <div class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
            <!-- Verifica si hay recomendaciones disponibles -->
            <div v-if="recommendations.length > 0" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Itera sobre las recomendaciones y muestra cada una -->
                <div v-for="recommendation in recommendations" :key="recommendation.id" class="bg-gray-100 dark:bg-gray-900 rounded-lg p-4">
                    <h4 class="text-lg font-bold">{{ recommendation.title }}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ recommendation.description }}</p>
                    <span class="inline-block bg-blue-500 text-white text-xs px-2 py-1 mt-2 rounded">{{ recommendation.category }}</span>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Recomendado por: {{ recommendation.user.name }}</p>
                </div>
            </div>
            <!-- Mensaje si no hay recomendaciones -->
            <div v-else>
                <p class="text-gray-600 dark:text-gray-400">No hay recomendaciones para mostrar en este momento.</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
