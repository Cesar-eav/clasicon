<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { faUser } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const recommendations = usePage().props.recommendations
</script>

<template>
    <AuthenticatedLayout title="Explorar Recomendaciones">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight">Explorar Recomendaciones</h2>
        </template>

        <div class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
            <!-- Verifica si hay recomendaciones disponibles -->
            <div v-if="recommendations.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Itera sobre las recomendaciones y muestra cada una -->
                <div v-for="recommendation in recommendations" :key="recommendation.id" class="bg-gray-100 dark:bg-gray-900 rounded-lg p-4 flex">
                    <!-- Mostrar la imagen si está disponible -->
                    <div v-if="recommendation.image" class="w-1/3 mr-4 mt-4">
                        <img :src="`/storage/images/${recommendation.image}`" alt="Recommendation Image" class="w-full h-auto object-cover rounded-md">
                    </div>
                    <div class="flex-1">
                      <div class="flex items-center mt-4">  
                            <FontAwesomeIcon :icon="faUser" class="mr-2" /> 
                            <span class="text-md text-red-500 font-bold dark:text-gray-400">Recomendado por: {{ recommendation.user.name }}</span>
                        </div>

                        <h4 class="text-lg font-bold">{{ recommendation.title }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">"{{ recommendation.description }}"</p>
                        <span class="inline-block bg-blue-500 text-white text-xs px-2 py-1 mt-2 rounded">{{ recommendation.category }}</span>
                    </div>
                </div>
            </div>
            <!-- Mensaje si no hay recomendaciones -->
            <div v-else>
                <p class="text-gray-600 dark:text-gray-400">No hay recomendaciones para mostrar en este momento.</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
