<template>
    <AuthenticatedLayout title="Clasicon.com">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between p-2">
                <h2 class="text-xl font-semibold leading-tight">
                    Bienvenido, {{ user.name }}
                </h2>
            </div>
        </template>

        <!-- Contenido principal -->
        <div class="CONTENIDO md:p-6 p-0 bg-white dark:bg-gray-800 rounded-md shadow-md flex justify-between mt-10 md:mt-3">
            <div class="w-full md:mr-4 ">
                <!-- Filtros de categorías -->
                <div class="flex justify-around mb-4 ">
                    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'book'">
                        <FontAwesomeIcon :icon="faBook" class="text-gray-400 text-2xl hover:text-blue-500" />
                        <span class="text-sm text-gray-600 dark:text-gray-400">Libros</span>
                    </div>
                    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'movie'">
                        <FontAwesomeIcon :icon="faFilm" class="text-gray-400 text-2xl hover:text-blue-500" />
                        <span class="text-sm text-gray-600 dark:text-gray-400">Películas</span>
                    </div>
                    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'series'">
                        <FontAwesomeIcon :icon="faTv" class="text-gray-400 text-2xl hover:text-blue-500" />
                        <span class="text-sm text-gray-600 dark:text-gray-400">Series</span>
                    </div>
                    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'game'">
                        <FontAwesomeIcon :icon="faGamepad" class="text-gray-400 text-2xl hover:text-blue-500" />
                        <span class="text-sm text-gray-600 dark:text-gray-400">Juegos</span>
                    </div>
                    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'music'">
                        <FontAwesomeIcon :icon="faMusic" class="text-gray-400 text-2xl hover:text-blue-500" />
                        <span class="text-sm text-gray-600 dark:text-gray-400">Música</span>
                    </div>
                </div>

                <!-- Posteos de otros usuarios -->
                <div v-for="(post, index) in filteredPosts" :key="index"
                    class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md mb-6 flex flex-col md:flex-row">
                    <img :src="`/storage/${post.image}`" alt="Recommendation Image"
                        class="w-full h-48 object-cover rounded-md mb-4 md:w-24 md:h-32 md:mr-4 md:mb-0">

                    <div class="flex flex-col w-full">
                        <div class="flex flex-col md:flex-row items-start md:items-center mb-2">
                            <FontAwesomeIcon :icon="getCategoryIcon(post.category)" class="mr-2 text-gray-400" />
                            <h4 class="text-md font-bold text-gray-800 dark:text-gray-300">{{ post.title }}</h4>
                        </div>
                        <div class="inline-flex">
                        
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 ">
                            <strong class="text-gray-800 text-2xl">"</strong>
                            {{ isExpanded[index] ? post.description : post.description.slice(0, 350) }}
                            <strong class="text-gray-800 text-xl">"</strong>

                            <span v-if="post.description.length > 350" @click="toggleExpansion(index)"
                                class="text-blue-500 cursor-pointer">
                                {{ isExpanded[index] ? '...ver menos' : '...ver más' }}
                            </span>
                                                        

                        </p>
                    </div>
                        <div class="text-sm text-gray-800 dark:text-gray-300 mb-2">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center flex-shrink-0">
                                    <FontAwesomeIcon :icon="faUser" class="mr-2" />
                                    <span>{{ post.user.name }}</span>
                                </div>
                                <button @click="toggleFollow(post.user.id, index)"
                                    :class="isFollowing[index] ? 'bg-[#3c888d]' : 'bg-[#000000]'"
                                    class="text-white px-4 py-1 rounded-lg text-sm min-w-[110px] text-center">
                                    {{ isFollowing[index] ? 'Siguiendo' : 'Seguir' }}
                                </button>
                            </div>
                        </div>



                        <!-- Sección de comentarios -->
                        <div class="mt-4">
                            <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Comentarios</h5>

                            <!-- Mostrar los comentarios existentes -->
                            <div v-for="comment in post.comments" :key="comment.id"
                                class="mt-2 p-2 bg-gray-200 dark:bg-gray-600 rounded-md">
                                <div class="inline-flex items-center">
                                    <img :src="'storage/' + comment.user.profile_picture" class="rounded-full w-8 mr-2 ">

                                    <p class="text-sm text-gray-700 dark:text-gray-200"><strong>{{ comment.user.name
                                            }}:</strong>
                                    </p>
                                </div>
                                <p> {{ comment.comment }}</p>
                            </div>

                            <!-- Formulario para agregar un nuevo comentario -->
                            <div class="mt-2">
                                <textarea v-model="newComment[index]" rows="2" placeholder="Escribe un comentario..."
                                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                                <button @click="submitComment(post.id, index)"
                                    class="mt-2 px-4 py-1 bg-blue-500 text-white rounded-lg">
                                    Comentar
                                </button>
                            </div>
                        </div>
                    </div>


                </div>




            </div>

            <!-- Columnas de categorías en la derecha -->
            <div class="w-2/5 sticky top-0 h-screen overflow-y-auto hidden sm:block">
                <div v-for="(category, categoryName) in recommendations" :key="categoryName" class="mb-6">
                    <div
                        class="flex items-center justify-between p-4 rounded-lg shadow-lg mb-4 border border-black bg-transparent">
                        <!-- Icono y categoría -->
                        <div class="flex items-center">
                            <FontAwesomeIcon :icon="getCategoryIcon(categoryName)" class="mr-2" />
                            <h3 class="text-lg font-semibold capitalize">{{ translateCategory(categoryName) }}</h3>
                        </div>
                        <!-- Botón de actualizar -->
                        <button @click="fetchCategoryRecommendations(categoryName)"
                            class="text-sm text-white p-2 rounded-full bg-blue-500 hover:bg-blue-400">
                            <FontAwesomeIcon :icon="faSyncAlt" />
                        </button>
                    </div>
                    <div class="bg-gray-900 p-3 rounded-md shadow-md">
                        <div v-if="Array.isArray(category)" v-for="recommendation in category.slice(0, 3)"
                            :key="recommendation.id" class="mb-4">
                            <h4 class="text-md font-bold text-white">{{ recommendation.title }}</h4>
                            <p class="text-sm text-gray-300">"{{ recommendation.description }}"</p>
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

<script setup>
import { ref, computed, onMounted, nextTick } from 'vue';
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { usePage, router } from '@inertiajs/vue3';
import { faSyncAlt, faUser, faBook, faFilm, faGamepad, faTv, faMusic } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import axios from 'axios';

const recommendations2 = ref(usePage().props.recommendations_organic || []);
const user = usePage().props.auth.user;
const isFollowing = ref(recommendations2.value.map(post => post.is_following));

const recommendations = ref({
    books: [],
    movies: [],
    games: [],
    series: [],
    music: []
});

// Estado para la categoría seleccionadaf
const selectedCategory = ref('');



const logout = () => {
    // Elimina el estado de visita del dashboard
    localStorage.removeItem('hasVisitedDashboard');

    // Aquí iría el código para cerrar sesión, por ejemplo:
    usePage().props.$inertia.post(route('logout'));
};


// Estado para manejar la expansión de texto
const isExpanded = ref([]);

const toggleExpansion = (index) => {
    isExpanded.value[index] = !isExpanded.value[index];
};

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
};

// Función para seguir o dejar de seguir
function toggleFollow(targetUserId, index) {
    const action = isFollowing.value[index] ? 'unfollow' : 'follow';
    router.post(route(`social.${action}`, targetUserId), {}, {
        onSuccess: () => {
            isFollowing.value[index] = !isFollowing.value[index];
        }
    });
}

// Filtrar posteos simulados por categoría
const filteredPosts = computed(() => {
    if (Array.isArray(recommendations2.value) && selectedCategory.value) {
        return recommendations2.value.filter(post => post.category.toLowerCase() === selectedCategory.value.toLowerCase());
    }
    return recommendations2.value; // Devuelve todo si no hay categoría seleccionada
});

// Función para obtener recomendaciones aleatorias por categoría
const fetchCategoryRecommendations = async (categoryName) => {
    try {
        const response = await axios.get(`/api/recommendations/random?category=${categoryName}`);
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
            };
        } else {
            console.warn(`No valid recommendations found for category: ${categoryName}`);
        }
    } catch (error) {
        console.error(`Error fetching recommendations for category: ${categoryName}`, error);
    }
};

// Llama a la función para obtener recomendaciones cuando se carga la página
const fetchRecommendations = async () => {
    const response = await axios.get('/api/recommendations/random');
    recommendations.value = response.data;
};

fetchRecommendations();



// Función para traducir las categorías si es necesario
const translateCategory = (categoryName) => {
    const translations = {
        books: 'Libros',
        movies: 'Películas',
        games: 'Juegos',
        series: 'Series',
        music: 'Música'
    };
    return translations[categoryName] || categoryName;
};

const newComment = ref([]); // Estado para manejar el nuevo comentario

// Función para enviar un comentario
const submitComment = (recommendationId, index) => {
    if (newComment.value[index]) { // Asegúrate de que haya un comentario antes de enviar la solicitud
        axios.post(`/recommendations/${recommendationId}/comments`, {
            comment: newComment.value[index] || ''
        })
            .then(response => {
                console.log("RESPUESTA -->", response.data);

                // Añadir el nuevo comentario directamente al array de comentarios
                recommendations2.value[index].comments.push(response.data);

                // Limpiar el campo de comentario
                newComment.value[index] = '';
            })
            .catch(error => {
                console.error("Error al agregar el comentario:", error);
            });
    }
};

</script>
