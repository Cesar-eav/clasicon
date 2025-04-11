<template>
    <AuthenticatedLayout title="Welcome">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between p-2">
                <h2 class="text-xl font-semibold leading-tight">
                    Bienvenido, {{ user ? user.name : 'Invitado' }}
                </h2>
            </div>
        </template>

        <DondeQuieresIr></DondeQuieresIr>

        <div class="CONTENIDO md:p-6 p-0 bg-white rounded-md shadow-md flex justify-between mt-10 md:mt-3">
            <div class="w-full md:mr-4  ">
                <div class="flex flex-wrap w-full gap-2 justify-center ">
                    <div v-for="(post, index) in recommendations" :key="post.id"
                        class="bg-gray-100 py-4 rounded-lg  shadow-md mb-6 flex flex-col w-96  md:w-56">
                        <img :src="post.image ? `/storage/${post.image}` : '/storage/sin-portada.jpg'"
                            alt="Recommendation Image"
                            class="h-56 md:h-40 w-full object-cover md:rounded-md mb-4 md:mr-4 md:mb-0"
                            loading="lazy">

                        <div class="flex flex-row  items-start md:items-center mb-2 px-2">
                            <a class="hidden md:block" :href="`https://www.google.com/maps/place/${post.lat},${post.lng}/@${post.lat},${post.lng},18z`"
                                target="_blank">    
                                <font-awesome-icon icon="fa-solid fa-location-dot"
                                class="text-red-500 text-md hover:text-red-400 mr-2" />
                            </a>

                            <a class="block md:hidden" :href="`geo:${post.lat},${post.lng}?q=${post.lat},${post.lng}&z=18`" target="_blank"> 
                                <font-awesome-icon icon="fa-solid fa-location-dot"
                                class="text-red-500 text-md hover:text-red-400 mr-2" /> 
                            </a>
                            <h4 class="text-md font-bold text-[#3c888d] dark:text-gray-300">{{ post.title }}</h4>
                        </div>
                        <h4 class="text-md pl-2 font-bold text-gray-800 dark:text-gray-300">{{ post.ciudad }}</h4>

                        <div class="inline-flex px-2">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 break-words">
                                {{ isExpanded[index] ? post.description : (post.description ? post.description.slice(0, 250) : '') }}
                                <span v-if="post.description && post.description.length > 350" @click="toggleExpansion(index)"
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
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { usePage } from '@inertiajs/vue3';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import DondeQuieresIr from '@/Components/Welcome/Donde.vue';


const recommendations = usePage().props.recommendations || [];
const user = usePage().props.auth.user;
const isExpanded = ref([]);

const toggleExpansion = (index) => {
    isExpanded.value[index] = !isExpanded.value[index];
};
</script>