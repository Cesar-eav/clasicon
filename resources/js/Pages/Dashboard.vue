<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'

// Simulando un usuario y contenido destacado
const user = usePage().props.auth.user
const featuredRecommendations = ref([
    {
        id: 1,
        title: 'The Great Gatsby',
        description: 'A novel written by American author F. Scott Fitzgerald.',
        category: 'book',
        image: 'https://via.placeholder.com/150'
    },
    {
        id: 2,
        title: 'Inception',
        description: 'A science fiction film directed by Christopher Nolan.',
        category: 'movie',
        image: 'https://via.placeholder.com/150'
    },
    {
        id: 3,
        title: 'Breaking Bad',
        description: 'A television series created by Vince Gilligan.',
        category: 'series',
        image: 'https://via.placeholder.com/150'
    }
])
</script>

<template>
    <AuthenticatedLayout title="Bienvenido a Clasicon.cl">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Bienvenido, {{ user.name }}
                </h2>
            </div>
        </template>
        
        <!-- Contenido principal -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
            <div class="mb-6">
                <h3 class="text-lg font-semibold">Tus Recomendaciones Destacadas</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div v-for="recommendation in featuredRecommendations" :key="recommendation.id" class="bg-gray-100 dark:bg-gray-900 rounded-lg p-4">
                        <img :src="recommendation.image" alt="Recommendation Image" class="w-full h-32 object-cover rounded-md">
                        <h4 class="text-lg font-bold mt-2">{{ recommendation.title }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ recommendation.description }}</p>
                        <span class="inline-block bg-blue-500 text-white text-xs px-2 py-1 mt-2 rounded">{{ recommendation.category }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold">Explora Más Recomendaciones</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Descubre nuevos libros, películas, juegos y series recomendados por nuestra comunidad.</p>
                <a href="#" class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded">Explorar Ahora</a>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
