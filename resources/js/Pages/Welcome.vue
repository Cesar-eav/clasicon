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
        <div class="absolute inset-0 bg-gradient-to-r from-black via-transparent to-black opacity-80"></div>

        <div class="relative z-10 flex flex-col md:flex-row w-full max-w-screen-xl mx-auto px-4 md:px-0">
            <!-- Sección principal -->
            <div class="flex-1 text-center md:text-left p-6">
                <h1 class="text-4xl md:text-7xl font-extrabold mb-4 tracking-tight leading-tight"><span class="text-blue-500">Clasicón.com</span></h1>
                <p class="text-base md:text-xl mb-6 md:mb-8">Descubre, comparte y recomienda lo mejor en libros, películas, series y mucho más. Únete a una comunidad apasionada.</p>

                <!-- Botones de inicio de sesión y registro -->
                <div class="flex flex-col md:flex-row items-center gap-4 mt-4 md:mt-12">
                    <Link v-if="!auth.user" href="/login"
                        class="bg-gradient-to-r from-[#3c888d] to-[#3c888d] w-full md:w-56 h-12 text-white px-6 py-2 rounded-full hover:bg-blue-700 flex items-center justify-center gap-2 transition-transform transform hover:scale-105">
                    <FontAwesomeIcon :icon="faSignInAlt" />
                    Ingresar
                    </Link>

                    <Link v-if="!auth.user" :href="route('register')"
                        class="bg-gradient-to-r from-[#3c888d] to-[#3c888d] w-full md:w-56 h-12 text-white px-6 py-2 rounded-full hover:bg-green-700 flex items-center justify-center gap-2 transition-transform transform hover:scale-105">
                    <FontAwesomeIcon :icon="faUserPlus" />
                    Registrarse
                    </Link>
                </div>

                <!-- Enlace para explorar sin iniciar sesión -->
                <div v-if="auth.user" class="mt-6 md:mt-12">
                    <Link :href="route('dashboard')"
                        class="bg-gray-800 text-white px-6 py-2 rounded-full hover:bg-gray-900 flex items-center justify-center gap-2 transition-transform transform hover:scale-105 w-full md:w-auto">
                    <FontAwesomeIcon :icon="faCompass" />
                    Explorar
                    </Link>
                </div>
            </div>

            <!-- Sección de recomendaciones -->
            <div
                class="w-full md:w-2/3 p-4 md:p-8 bg-gray-900 bg-opacity-90 rounded-lg shadow-lg h-auto md:h-[75vh] flex flex-col backdrop-blur-md mt-8 md:mt-0">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl md:text-3xl font-semibold text-white">Clasicones de hoy</h2>
                    <button @click="shuffleRecommendations" class="text-white hover:text-gray-400 transition-transform transform hover:scale-110">
                        <FontAwesomeIcon :icon="faSyncAlt" />
                    </button>
                </div>
                <div class="space-y-4 overflow-y-auto max-h-96 md:max-h-full">
                    <div v-for="(recommendation, index) in recommendations_organic" :key="recommendation.id"
                        class="flex items-center bg-gray-800 bg-opacity-80 rounded-lg p-4 hover:bg-opacity-100 transition-colors">
                        <img :src="`/storage/${recommendation.image}`" alt="Recommendation Image"
                            class="w-16 h-20 md:w-20 md:h-24 object-cover rounded-md mr-4 shadow-md">
                        <div class="flex-1">
                            <h3 class="text-lg md:text-xl font-bold text-white">{{ recommendation.title }}</h3>
                            <p class="text-xs md:text-sm text-gray-300">
                                <strong class="text-gray-800 text-xl md:text-2xl">"</strong>
                                {{ isExpanded[index] ? recommendation.description : recommendation.description.slice(0, 350) }}
                                <strong class="text-gray-800 text-lg md:text-xl">"</strong>
                                <span v-if="recommendation.description.length > 350" @click="toggleExpansion(index)"
                                    class="text-blue-500 cursor-pointer">
                                    {{ isExpanded[index] ? '...ver menos' : '...ver más' }}
                                </span>
                            </p>
                            <p class="text-xs text-red-400 flex items-center gap-1 mt-2">
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
        </footer>
    </div>
</template>


