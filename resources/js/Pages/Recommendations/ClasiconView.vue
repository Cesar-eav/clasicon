<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { usePage } from '@inertiajs/vue3'
import { ref } from 'vue'


const user = ref(usePage().props.user);
const mis_clasicones = ref(usePage().props.mis_clasicones);
const followers = usePage().props.followers || []
const thoughts = ref(usePage().props.thoughts || []);
const filteredRecommendations = ref(usePage().props.clasicones);

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

            <div class="space-y-4 max-h-96 md:max-h-full mt-20  bg-gray-200 bg-opacity-80">
                    <div v-for="(recommendation, index) in filteredRecommendations" :key="recommendation.id"
                        class="flex items-center rounded-lg md:p-4 hover:bg-opacity-100 transition-colors">

                        <!-- Div con tamaño fijo para la imagen y la categoría -->
                        <div class="w-52 h-48 flex flex-col items-center hidden md:flex">
                            <span
                                class="hidden md:inline-block  bg-[#3c888d] text-white text-center text-xs px-2 py-1 md:mb-2 rounded w-full">
                                {{ translateCategoryList(recommendation.category) }}
                            </span>

                            <img :src="`/storage/${recommendation.image}`" alt="Recommendation Image"
                              >

                        </div>

                        <!-- IMAGENES MOVIL -->
                        <div class="md:flex-1 md:ml-4 self-start pb-2">
                            <span
                                class="md:hidden inline-block bg-[#3c888d] text-white text-center text-xs px-2 py-1 md:mb-2 rounded-t-lg w-full">
                                {{ translateCategoryList(recommendation.category) }}
                            </span>
                            <img :src="`/storage/${recommendation.image}`" alt="Recommendation Image"
                                class="w-full h-50 object-fill rounded-b-lg shadow-md md:hidden">


                            <h3 class="text-lg md:text-xl font-bold text-[#3c888d]"  style="text-shadow: 1px 1px 3px #3c888d;">{{ recommendation.title }}</h3>
                            <p class="text-md text-[#3c888d] flex items-center gap-1 mt-1">
                                 Por <strong>{{ recommendation.user.name }}:</strong>
                            </p>
                            <p class="text-xs md:text-sm text-gray-600">
                                <strong class="text-gray-600 text-lg ">"</strong>
                                {{ recommendation.description  }}
                                <strong class="text-gray-600 text-lg ">"</strong>

                            </p>

                        </div>
                    </div>
                </div>



        </template>
    </AuthenticatedLayout>
</template>

