<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { faSyncAlt, faUser, faBook, faFilm, faGamepad, faTv, faMusic, faPaperPlane } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import axios from 'axios'

const user = usePage().props.auth.user
const postContent = ref('') // Aquí guardamos el contenido que el usuario va a postear
const selectedCategory = ref('book') // Categoría seleccionada por el usuario
const recommendations = ref({
    books: [],
    movies: [],
    games: [],
    series: [],
    music: []
})

// Función para manejar la publicación de contenido
const postRecommendation = async () => {
    if (postContent.value.trim() !== '') {
        try {
            console.log('Posting content:', postContent.value, 'Category:', selectedCategory.value)
            // Aquí podrías hacer una solicitud POST a la API para guardar la recomendación
            // await axios.post('/api/recommendations', { content: postContent.value, category: selectedCategory.value })

            // Después de publicar, limpiar el área de texto
            postContent.value = ''
            alert('Publicación exitosa')
        } catch (error) {
            console.error('Error posting recommendation:', error)
            alert('Error al publicar, por favor intenta de nuevo.')
        }
    } else {
        alert('No puedes publicar un contenido vacío.')
    }
}

// Función para obtener recomendaciones aleatorias por categoría
const fetchCategoryRecommendations = async (categoryName) => {
    console.log(`Fetching recommendations for category: ${categoryName}`); // Debugging: Indica qué categoría se está actualizando
    try {
        const response = await axios.get(`/api/recommendations/random?category=${categoryName}`)
        console.log('API response:', response.data); // Debugging: Muestra la respuesta de la API
        
        let recommendationsArray = [];

        if (Array.isArray(response.data[categoryName])) {
            recommendationsArray = response.data[categoryName];
        } else {
            console.error(`The object does not contain an array for category: ${categoryName}`);
        }

        if (recommendationsArray.length > 0) {
            recommendations.value = {
                ...recommendations.value,
                [categoryName]: recommendationsArray
            }
            console.log('Updated recommendations:', recommendations.value); // Debugging: Muestra las recomendaciones después de la actualización
        } else {
            console.warn(`No valid recommendations found for category: ${categoryName}`);
        }
    } catch (error) {
        console.error(`Error fetching recommendations for category: ${categoryName}`, error); // Debugging: Muestra errores si los hay
    }
}

// Llama a la función para obtener recomendaciones cuando se carga la página
const fetchRecommendations = async () => {
    console.log('Fetching all recommendations on page load'); // Debugging: Indica que se están obteniendo todas las recomendaciones al cargar la página
    const response = await axios.get('/api/recommendations/random')
    recommendations.value = response.data
    console.log('Initial recommendations:', recommendations.value); // Debugging: Muestra las recomendaciones iniciales
}

fetchRecommendations()

// Función para obtener el ícono adecuado para cada categoría
const getCategoryIcon = (categoryName) => {
    const icons = {
        books: faBook,
        movies: faFilm,
        games: faGamepad,
        series: faTv,
        music: faMusic
    };
    return icons[categoryName] || faBook;
}

// Función para traducir las categorías si es necesario (opcional si decides manejar la traducción manualmente)
const translateCategory = (categoryName) => {
    const translations = {
        books: 'Libro',
        movies: 'Película',
        games: 'Juego',
        series: 'Serie',
        music: 'Música'
    };
    return translations[categoryName] || categoryName;
}

// Simulación de posteos de otros usuarios
const simulatedPosts = ref([
    {
        user: 'Carlos Pérez',
        title: 'Inception',
        category: 'Película',
        description: 'Una obra maestra de la narración de sueños y realidades entrelazadas.',
        image: 'https://via.placeholder.com/150',
    },
    {
        user: 'María González',
        title: 'El Padrino',
        category: 'Película',
        description: 'Una obra maestra cinematográfica sobre el poder, la familia y la corrupción.',
        image: 'https://via.placeholder.com/150',
    },
    {
        user: 'Juan Ramírez',
        title: '1984',
        category: 'Libro',
        description: 'Una obra maestra sobre la rebelión y la opresión, donde la guerra es paz.',
        image: 'https://via.placeholder.com/150',
    },
    {
        user: 'Ana Martínez',
        title: 'Breaking Bad',
        category: 'Serie',
        description: 'Una serie que redefine el drama televisivo con personajes complejos y tramas intensas.',
        image: 'https://via.placeholder.com/150',
    },
    {
        user: 'Luis Fernández',
        title: 'Stranger Things',
        category: 'Serie',
        description: 'Una mezcla perfecta de nostalgia de los 80 y una narrativa moderna.',
        image: 'https://via.placeholder.com/150',
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
        <div class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md flex justify-between">
            <div class="w-full max-w-2xl">
                <h3 class="text-lg font-semibold">Postea tu Clasicón</h3>
                
                <!-- Selector de categoría con inputs radio -->
                <div class="mb-4">
                    <label class="inline-flex items-center mr-4">
                        <input type="radio" value="book" v-model="selectedCategory" class="form-radio text-blue-600">
                        <span class="ml-2">Libro</span>
                    </label>
                    <label class="inline-flex items-center mr-4">
                        <input type="radio" value="movie" v-model="selectedCategory" class="form-radio text-blue-600">
                        <span class="ml-2">Película</span>
                    </label>
                    <label class="inline-flex items-center mr-4">
                        <input type="radio" value="series" v-model="selectedCategory" class="form-radio text-blue-600">
                        <span class="ml-2">Serie</span>
                    </label>
                    <label class="inline-flex items-center mr-4">
                        <input type="radio" value="music" v-model="selectedCategory" class="form-radio text-blue-600">
                        <span class="ml-2">Música</span>
                    </label>
                </div>

                <!-- Área de post similar a Facebook/Twitter -->
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md mb-6">
                    <!-- Área de texto -->
                    <textarea v-model="postContent" rows="4" class="w-full p-2 rounded-md border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white" placeholder="Escribe algo..."></textarea>
                    <div class="flex justify-end mt-4">
                        <button @click="postRecommendation" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
                            <FontAwesomeIcon :icon="faPaperPlane" class="mr-2" />
                            Publicar
                        </button>
                    </div>
                </div>

                <!-- Simulación de posteos de otros usuarios -->
                <h3 class="text-lg font-semibold mb-4">Posteos de Otros Usuarios</h3>
                <div v-for="(post, index) in simulatedPosts" :key="index" class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md mb-6 flex">
                    <img :src="post.image" alt="Recommendation Image" class="w-16 h-16 object-cover rounded-md mr-4">
                    <div>
                        <h4 class="text-md font-bold">{{ post.title }} ({{ post.category }})</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ post.description }}</p>
                        <div class="flex items-center mt-2">
                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-300 mr-2">{{ post.user }}</span>
                            <button class="ml-auto bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-sm">Seguir</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columnas de categorías en la derecha -->
            <div class="w-1/4 sticky top-0 h-screen overflow-y-auto">
                <div v-for="(category, categoryName) in recommendations" :key="categoryName" class="mb-6">
                    <div class="flex items-center justify-between p-4 rounded-lg shadow-lg mb-4 border border-black bg-transparent">
                        <!-- Icono y categoría -->
                        <div class="flex items-center">
                            <FontAwesomeIcon :icon="getCategoryIcon(categoryName)" class="mr-2" />
                            <h3 class="text-lg font-semibold capitalize">{{ translateCategory(categoryName) }}</h3>
                        </div>
                        <!-- Botón de actualizar -->
                        <button @click="fetchCategoryRecommendations(categoryName)" class="text-sm text-white p-2 rounded-full bg-blue-500 hover:bg-blue-400">
                            <FontAwesomeIcon :icon="faSyncAlt" />
                        </button>
                    </div>
                    <div class="bg-gray-900 p-3 rounded-md shadow-md">
                        <div v-if="Array.isArray(category)" v-for="recommendation in category.slice(0, 3)" :key="recommendation.id" class="mb-4">
                            <h4 class="text-md font-bold text-white">{{ recommendation.title }}</h4>
                            <p class="text-sm text-gray-300">{{ recommendation.description }}</p>
                            <div class="flex items-center text-sm text-gray-400">
                                <FontAwesomeIcon :icon="faUser" class="mr-2" />
                                <span>{{ recommendation.user }}</span>
                            </div>
                        </div>
                        <div v-else>
                            <p class="text-sm text-gray-500">No hay recomendaciones disponibles.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
