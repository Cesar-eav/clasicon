<template>
    <AuthenticatedLayout title="Welcome">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between p-2">
                <h2 class="text-xl font-semibold leading-tight">
                    Bienvenido, {{ user ? user.name : 'Invitado' }}
                </h2>
            </div>
        </template>

        <!-- Contenido principal -->
        <div class="CONTENIDO md:p-6 p-0 bg-white rounded-md shadow-md flex justify-between mt-10 md:mt-3">
            <div class="w-full md:mr-4  ">
                <!-- Filtros de categorías -->

                <div class="hidden bg-[#3c888d] md:flex justify-around sticky top-16 z-0  dark:bg-gray-800 p-4 shadow-md">
    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'nature'">
        <FontAwesomeIcon :icon="faLeaf" class="text-white text-2xl hover:text-red-400" />
        <span class="text-sm text-white dark:text-gray-400">Naturaleza</span>
    </div>
    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'monument'">
        <FontAwesomeIcon :icon="faArchway" class="text-white text-2xl hover:text-red-400" />
        <span class="text-sm text-white dark:text-gray-400">Monumentos</span>
    </div>
    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'streetart'">
        <FontAwesomeIcon :icon="faSprayCan" class="text-white text-2xl hover:text-red-400" />
        <span class="text-sm text-white dark:text-gray-400">Street Art</span>
    </div>
    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'architecture'">
        <FontAwesomeIcon :icon="faBuilding" class="text-white text-2xl hover:text-red-400" />
        <span class="text-sm text-white dark:text-gray-400">Arquitectura</span>
    </div>
    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'culture'">
        <FontAwesomeIcon :icon="faPalette" class="text-white text-2xl hover:text-red-400" />
        <span class="text-sm text-white dark:text-gray-400">Cultura</span>
    </div>
    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'museum'">
        <FontAwesomeIcon :icon="faMuseum" class="text-white text-2xl hover:text-red-400" />
        <span class="text-sm text-white dark:text-gray-400">Museos</span>
    </div>
    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'picada'">
        <FontAwesomeIcon :icon="faUtensils" class="text-white text-2xl hover:text-red-400" />
        <span class="text-sm text-white dark:text-gray-400">Picadas</span>
    </div>
</div>
                <!-- Posteos de otros usuarios -->
                <div class="flex flex-wrap w-full gap-2 justify-center ">
                    <div v-for="(post, index) in filteredPosts" :key="index"
                        class="bg-gray-100 py-4 rounded-lg  shadow-md mb-6 flex flex-col w-96  md:w-56">
                        <img :src="post.image ? `/storage/${post.image}` : '/storage/sin-portada.jpg'"
                        alt="Recommendation Image" class="h-56 md:h-40 w-full object-cover md:rounded-md mb-4 md:mr-4 md:mb-0">

                        <div class="flex flex-row  items-start md:items-center mb-2 px-2">
                            <FontAwesomeIcon :icon="getCategoryIcon(post.category)" class="mr-2 text-gray-400" />
                            <h4 class="text-md font-bold text-gray-800 dark:text-gray-300">{{ post.title }}</h4>
                        </div>
                        <div class="inline-flex px-2">

                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 break-words">

                                {{ isExpanded[index] ? post.description : post.description.slice(0, 250) }}

                                <span v-if="post.description.length > 350" @click="toggleExpansion(index)"
                                    class="text-blue-500 cursor-pointer">
                                    {{ isExpanded[index] ? '...ver menos' : '...ver más' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Columnas de categorías en la derecha -->
            <!-- <div class="w-2/5 sticky top-0 h-screen overflow-y-auto hidden sm:block">
                <div v-for="(category, categoryName) in recommendations" :key="categoryName" class="mb-6">
                    <div
                        class="flex items-center justify-between p-4 rounded-lg shadow-lg mb-4 border border-black bg-transparent">
                        <div class="flex items-center">
                            <FontAwesomeIcon :icon="getCategoryIcon(categoryName)" class="mr-2" />
                            <h3 class="text-lg font-semibold capitalize">{{ translateCategory(categoryName) }}</h3>
                        </div>
                        <button @click="fetchCategoryRecommendations(categoryName)"
                            class="text-sm text-white p-2 rounded-full bg-blue-500 hover:bg-blue-400">
                            <FontAwesomeIcon :icon="faSyncAlt" />
                        </button>
                    </div>
                    <pre>CATEGORY: {{ categoryName }}</pre>
                    <div class="bg-gray-900 p-3 rounded-md shadow-md">
                        <p class="text-white">asdsad</p>
                        <div v-if="Array.isArray(category)" v-for="recommendation in category.slice(0, 3)"
                            :key="recommendation.id" class="mb-4">
                            <h4 class="text-md font-bold text-white">{{ recommendation.title }}</h4>
                            <p class="text-red-500"> </p>
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
            </div> -->
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed, onMounted, nextTick } from 'vue';
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { usePage, router, Link } from '@inertiajs/vue3';
import { faSyncAlt, faUser, faBook, faFilm, faPalette, faGamepad, faTv, faMusic, faCirclePlay, faFileVideo, faLocationDot, faPodcast, faLeaf, faArchway, faSprayCan, faBuilding, faMuseum, faUtensils } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import axios from 'axios';

const newReply = ref([]); // Estado para manejar las respuestas

const submitReply = (thoughtId) => {
    if (newReply.value[thoughtId]?.trim()) {
        axios.post('/thoughts', {
            content: newReply.value,
            parent_id: thoughtId // Asociar la respuesta con el pensamiento original
        })
            .then(response => {
                // Actualizar la lista de respuestas
                thoughts.value.forEach(thought => {
                    if (thought.id === thoughtId) {
                        thought.replies.push(response.data);
                    }
                });
                newReply.value = ''; // Limpiar el textarea
            })
            .catch(error => {
                console.error('Error al guardar la respuesta:', error);
            });
    }
};

const recommendations2 = ref(usePage().props.recommendations_organic || []);
const user = usePage().props.auth.user;
const isFollowing = ref(recommendations2.value.map(post => post.is_following));

const newThought = ref(''); // Estado para manejar el nuevo pensamiento
const recentThought = ref(null); // Para el pensamiento temporal que se muestra al usuario tras crearlo
const thoughts = ref(usePage().props.thoughts || []);

onMounted(() => {
    thoughts.value = thoughts.value.map(thought => {
        return {
            ...thought,
            replies: thought.replies || [] // Asegura que siempre haya un array
        };
    });
});

// Función para enviar un nuevo pensamiento
const submitThought = () => {
    if (newThought.value.trim()) {
        axios.post('/thoughts', { content: newThought.value })
            .then(response => {
                // Limpiar el textarea
                newThought.value = '';
                // Mostrar el pensamiento recién creado (temporalmente)
                recentThought.value = response.data;

                // Ocultar el pensamiento después de 5 segundos (opcional)
                setTimeout(() => {
                    recentThought.value = null;
                }, 50000);
            })
            .catch(error => {
                console.error('Error al guardar el pensamiento:', error);
            });
    }
};

const recommendations = ref({
    nature: [],
    monument: [],
    streetart: [],
    architecture: [],
    culture: [],
    museum: [],
    picada: []
});

// Estado para la categoría seleccionadaf
const selectedCategory = ref('');

const handleCommentClick = () => {
    if (!user) {
        router.get(route('register')); // Redirige al formulario de registro
    }
};

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
        nature: faLeaf,
        monument: faArchway,
        streetart: faSprayCan,
        architecture: faBuilding,
        library: faBook,
        museum: faMuseum,
        picada: faUtensils,
        books: faBook,
        movies: faFilm,
        series: faTv,
        music: faMusic,
        culture: faPalette

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
        nature: 'Naturaleza',
        monuments: 'Monumentos',
        streetart: 'StreetArt',
        architecture: 'Arquitectura',
        culture: 'Cultura',
        museum: 'Museos',
        picada: 'Picadas'
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
                console.log("Comentario enviado. ID del comentario:", response.data.id);

                // Llamar de nuevo a la API para obtener el comentario completo con la información del usuario
                return axios.get(`/recommendations/${recommendationId}/comments/${response.data.id}`);
            })
            .then(fullCommentResponse => {
                console.log("Comentario completo:", fullCommentResponse.data);

                // Añadir el nuevo comentario completo directamente al array de comentarios
                recommendations2.value[index].comments.push(fullCommentResponse.data);

                // Limpiar el campo de comentario
                newComment.value[index] = '';
            })
            .catch(error => {
                console.error("Error al agregar el comentario:", error);
            });
    }
};

</script>
