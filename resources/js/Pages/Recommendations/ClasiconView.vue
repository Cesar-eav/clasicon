<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { usePage, Link } from '@inertiajs/vue3'
import { ref } from 'vue'


const user = ref(usePage().props.user);
const clasicon = ref(usePage().props.clasicon);
const followers = usePage().props.followers || []
const filteredRecommendations = ref(usePage().props.clasicon);

const translateCategoryList = (categoryName) => {
    const translationsList = {
        book: 'Libro',
        movie: 'Película',
        game: 'Juego',
        series: 'Serie',
        music: 'Música'
    };
    return translationsList[categoryName] || categoryName;
};

</script>

<template>
    <AuthenticatedLayout title="Mi Perfil">
        <template #header>

            <!-- {{ clasicones[0].user_id }} -->
            <div class="space-y-4  mt-20 bg-gray-200 bg-opacity-80">
                <div v-for="(recommendation, index) in filteredRecommendations" :key="recommendation.id"
                    class="flex flex-col md:flex-row items-center rounded-lg md:p-4 hover:bg-opacity-100 transition-colors">

                    <!-- ESCRITORIO:Div con tamaño fijo para la imagen y la categoría en escritorio -->
                    <div class="hidden md:flex w-7/12 flex-col items-center">
                        <span
                            class="hidden md:inline-block bg-[#3c888d] text-white text-center text-xs px-2 py-1 md:mb-2 rounded w-full">
                            {{ translateCategoryList(recommendation.category) }}
                        </span>

                        <img :src="`/storage/${recommendation.image}`" alt="Recommendation Image"
                            class="w-full object-cover rounded-md mb-4  md:mb-0">
                    </div>

                    <!-- Contenido para móviles -->
                    <div class="md:flex flex flex-col md:ml-4 self-start pb-2 w-full">

                        <!-- Título de la categoría en móviles -->
                        <div
                            class="md:hidden bg-[#3c888d] text-white text-center text-xs px-2 py-2 md:mb-2 rounded-t-lg w-full">
                            {{ translateCategoryList(recommendation.category) }}
                        </div>

                        <!-- Imagen en móviles -->
                        <div class="w-full">
                            <img :src="`/storage/${recommendation.image}`" alt="Recommendation Image"
                                class="w-full rounded-b-lg shadow-md md:hidden border-2 border-gray-300">
                        </div>

                        <!-- Título y detalles -->
                        <h3 class="text-lg md:text-2xl font-bold text-[#3c888d] mt-4 md:mt-0 ">
                            {{ recommendation.title }}
                        </h3>

                        <h3 v-show="recommendation.enlace" class="text-lg md:text-xl font-bold text-[#3c888d] mt-4 md:mt-1 mb-2 hover:text-red-500">
                            <a :href="recommendation.enlace" target="_blank" >Enlace</a>
                        </h3>
                        <h3 v-show="recommendation.ciudad" class="text-lg md:text-xl font-bold text-[#3c888d] mt-4 md:mt-1 mb-2 hover:text-red-500">
                            {{recommendation.ciudad}}
                        </h3>

                        <h3 v-show="recommendation.autor" class="text-lg md:text-xl font-bold text-[#3c888d] mt-4 md:mt-1 mb-2 hover:text-red-500">
                            {{recommendation.autor}}
                        </h3>
                        <h3 v-show="recommendation.horario" class="text-lg md:text-xl font-bold text-[#3c888d] mt-4 md:mt-1 mb-2 hover:text-red-500">
                            {{recommendation.horario}}
                        </h3>



                        <p class="text-md text-[#3c888d] flex items-center gap-1 mt-1">
                            Por

                            <Link :href="route('social.profile', clasicon[0].user.id)"
                                class="text-blue-500 hover:underline">
                            {{ clasicon[0].user.name }}
                            </Link>

                        </p>

                        <p class="text-xs md:text-sm text-gray-600 italic">
                            
                            {{ recommendation.description }}
                            
                        </p>
                    </div>
                </div>
            </div>




        </template>
    </AuthenticatedLayout>
</template>
