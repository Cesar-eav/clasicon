<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3'
import { faSignInAlt, faUserPlus, faCompass, faTachometerAlt, faUser, faSyncAlt } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { ref } from 'vue'

// Definimos las propiedades que puede recibir el componente
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    auth: Object // Propiedad para manejar la autenticación del usuario
})

// Imagen de fondo y otros recursos
const backgroundImage = "https://images.unsplash.com/photo-1582134534988-f8bcfc928273?q=80&w=1496&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"; // Cambia por una URL de imagen real

// Datos simulados de recomendaciones
const recommendations_organic = ref(usePage().props.recommendations_organic || []);

// Estado para manejar la expansión de texto
const isExpanded = ref([]);

// Función para mezclar recomendaciones de forma reactiva
const shuffleRecommendations = () => {
    recommendations_organic.value = recommendations_organic.value.sort(() => Math.random() - 0.5);
}

// Función para alternar la expansión del texto
const toggleExpansion = (index) => {
    isExpanded.value[index] = !isExpanded.value[index];
}

// Mezclamos las recomendaciones al cargar la página
shuffleRecommendations();

</script>



<template>

    <Head title="Bienvenido a Clasicón" />

    <div class="relative flex items-center justify-center min-h-screen bg-cover bg-center text-white"
        :style="{ backgroundImage: `url(${backgroundImage})` }">
        <!-- Fondo oscuro transparente -->
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <div class="relative z-10 flex flex-col md:flex-row w-full max-w-screen-xl mx-auto">
            <!-- Sección principal -->
            <div class="flex-1 text-center md:text-left p-6">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Clasicón.com</h1>
                <p class="text-lg md:text-xl mb-8">Tu espacio para descubrir, compartir y recomendar lo mejor en libros,
                    películas, series, y más.</p>

                <!-- Botones de inicio de sesión y registro -->
                <div class="flex flex-col items-center gap-4 mt-6 md:mt-20">
                    <Link v-if="!auth.user" href="/login"
                        class="bg-blue-600 w-56 h-12  text-white px-6 py-2 rounded-full hover:bg-blue-700 flex items-center justify-center gap-2">
                    <FontAwesomeIcon :icon="faTachometerAlt" />
                    Ingresar
                    </Link>

                    <Link v-if="!auth.user" :href="route('register')"
                        class="bg-green-600 w-56 h-12 text-white px-6 py-2 rounded-full hover:bg-green-700 flex items-center justify-center gap-2">
                    <FontAwesomeIcon :icon="faUserPlus" />
                    Registrarse
                    </Link>
                </div>

                <!-- Enlace para explorar sin iniciar sesión -->
                <div v-if="auth.user" class="mt-8">
                    <Link :href="route('dashboard')"
                        class="bg-gray-800 text-white px-6 py-2 rounded-full hover:bg-gray-900 flex items-center justify-center gap-2">
                    <FontAwesomeIcon :icon="faCompass" />
                    INGRESAR
                    </Link>
                </div>
            </div>
            <!-- Sección de recomendaciones -->
            <div
                class="w-full md:w-2/3 p-2 md:p-6 bg-gray-800 dark:bg-gray-900 rounded-lg shadow-lg h-[75vh] flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-semibold text-white">Clasicones de hoy</h2>
                    <button @click="shuffleRecommendations" class="text-white hover:text-gray-400">
                        <FontAwesomeIcon :icon="faSyncAlt" />
                    </button>
                </div>
                <div class="space-y-4 overflow-y-auto">
                    <div v-for="(recommendation, index) in recommendations_organic" :key="recommendation.id"
                        class="flex items-center bg-gray-700 dark:bg-gray-800 rounded-lg p-4">
                        <img :src="`/storage/${recommendation.image}`" alt="Recommendation Image"
                            class="w-16 h-22 object-cover rounded-md mr-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-white">{{ recommendation.title }}</h3>
                            <p class="text-sm text-gray-300">
                                <strong class="text-gray-800 text-2xl">"</strong>
                                {{ isExpanded[index] ? recommendation.description : recommendation.description.slice(0, 350) }}
                                <strong class="text-gray-800 text-xl">"</strong>
                                <span v-if="recommendation.description.length > 350" @click="toggleExpansion(index)"
                                    class="text-blue-500 cursor-pointer">
                                    {{ isExpanded[index] ? '...ver menos' : '...ver más' }}
                                </span>
                            </p>
                            <p class="text-xs text-red-400 flex items-center gap-1">
                             <FontAwesomeIcon :icon="faUser" />   Aporte de {{ recommendation.user.name }}
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer con información adicional -->
        <footer class="absolute bottom-0 w-full text-center py-4 bg-black bg-opacity-60 text-gray-300">
            <p>&copy; 2024 Clasicón. Todos los derechos reservados.</p>
            <!-- <p>Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})</p> -->
        </footer>
    </div>
</template>
