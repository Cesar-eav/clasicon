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


                <!-- Posteos de otros usuarios -->
                <div class="flex flex-wrap w-full gap-2 justify-center ">
                    <div v-for="(post, index) in filteredPosts" :key="index"
                        class="bg-gray-100 py-4 rounded-lg  shadow-md mb-6 flex flex-col w-96  md:w-56">
                        <img :src="post.image ? `/storage/${post.image}` : '/storage/sin-portada.jpg'"
                            alt="Recommendation Image"
                            class="h-56 md:h-40 w-full object-cover md:rounded-md mb-4 md:mr-4 md:mb-0">

                        <div class="flex flex-row  items-start md:items-center mb-2 px-2">

                            <a :href="`https://www.google.com/maps/place/${post.lat},${post.lng}/@${post.lat},${post.lng},18z`"
                                target="_blank">
                                <font-awesome-icon icon="fa-solid fa-location-dot"
                                    class="text-red-500 text-md hover:text-red-400 mr-2" />
                            </a>


                            <h4 class="text-md font-bold text-[#3c888d] dark:text-gray-300">{{ post.title }}</h4>
                        </div>
                        <h4 class="text-md pl-2 font-bold text-gray-800 dark:text-gray-300">{{ post.ciudad }}</h4>

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

        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed, onMounted, nextTick } from 'vue';
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { usePage, router, Link } from '@inertiajs/vue3';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import axios from 'axios';
import { defineProps } from 'vue';

const props = defineProps({
    recomendacionesSidebar: {
    type: Array,
    default: () => []
  }
});

const recomendacionesSidebar = props.recomendacionesSidebar;


const newReply = ref([]); // Estado para manejar las respuestas


const recommendations2 = ref(usePage().props.recommendations || []);
const user = usePage().props.auth.user;





// Estado para la categoría seleccionadaf
const selectedCategory = ref('');



// Estado para manejar la expansión de texto
const isExpanded = ref([]);

const toggleExpansion = (index) => {
    isExpanded.value[index] = !isExpanded.value[index];
};



// Filtrar posteos simulados por categoría
const filteredPosts = computed(() => {
    if (Array.isArray(recommendations2.value) && selectedCategory.value) {
        return recommendations2.value.filter(post => post.category.toLowerCase() === selectedCategory.value.toLowerCase());
    }
    return recommendations2.value; // Devuelve todo si no hay categoría seleccionada
});



// Llama a la función para obtener recomendaciones cuando se carga la página
const fetchRecommendations = async () => {
    const response = await axios.get('/api/recommendations/random');
    recommendations.value = response.data;
};

fetchRecommendations();



</script>
