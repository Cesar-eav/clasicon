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
      <div class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md flex justify-between">
        <div class="w-full mr-10">
          <!-- Filtros de categorías -->
          <div class="flex justify-around mb-4">
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
  
          <!-- Simulación de posteos de otros usuarios -->
          <div v-for="(post, index) in filteredPosts" :key="index"
              class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md mb-6 flex">
            <img :src="`/storage/${post.image}`" alt="Recommendation Image"
                class="w-24 h-32 object-cover rounded-md mr-4">
            <div>
              <div class="flex items-center">
                <FontAwesomeIcon :icon="getCategoryIcon(post.category)" class="mr-2 text-gray-400" />
                <h4 class="text-md font-bold text-gray-800 dark:text-gray-300">{{ post.title }}</h4>
              </div>
              <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ isExpanded[index] ? post.description : post.description.slice(0, 350) }}
                <span v-if="post.description.length > 350" @click="toggleExpansion(index)" class="text-blue-500 cursor-pointer">
                  {{ isExpanded[index] ? '...menos' : '...más' }}
                </span>
              </p>
              <div class="text-sm text-gray-800 dark:text-gray-300">
                <div class="flex items-center">
                  <FontAwesomeIcon :icon="faUser" class="mr-2" />
                  <span>{{ post.user.name }}</span>
                </div>
                <button class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-sm">Seguir</button>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Columnas de categorías en la derecha -->
        <div class="w-2/5 sticky top-0 h-screen overflow-y-auto hidden sm:block">
          <div v-for="(category, categoryName) in recommendations" :key="categoryName" class="mb-6">
            <div class="flex items-center justify-between p-4 rounded-lg shadow-lg mb-4 border border-black bg-transparent">
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
  
  <script setup>
  import { ref, computed } from 'vue';
  import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
  import { usePage } from '@inertiajs/vue3';
  import { faSyncAlt, faUser, faBook, faFilm, faGamepad, faTv, faMusic } from '@fortawesome/free-solid-svg-icons';
  import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
  import axios from 'axios';
  
  const recommendations2 = ref(usePage().props.recommendations_organic || []);
  
  const user = usePage().props.auth.user;
  const recommendations = ref({
      books: [],
      movies: [],
      games: [],
      series: [],
      music: []
  });
  
  // Estado para la categoría seleccionada
  const selectedCategory = ref('');
  
  // Estado para manejar la expansión de texto
  const isExpanded = ref([]);
  
  const toggleExpansion = (index) => {
      isExpanded.value[index] = !isExpanded.value[index];
  };
  
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
  
  // Filtrar posteos simulados por categoría
  const filteredPosts = computed(() => {
      console.log('Selected Category:', selectedCategory.value);
      if (Array.isArray(recommendations2.value) && selectedCategory.value) {
          return recommendations2.value.filter(post => post.category.toLowerCase() === selectedCategory.value.toLowerCase());
      }
      return recommendations2.value; // Devuelve todo si no hay categoría seleccionada
  });
  </script>
  