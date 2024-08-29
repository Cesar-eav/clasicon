<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { usePage } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'

const user = ref(usePage().props.user);
const clasicones = ref(usePage().props.clasicones || []);
const followers = usePage().props.followers || [];
const expanded = ref([]); // Inicializa expanded como un array vacío
onMounted(() => {
    // Inicializa expanded con la misma longitud que clasicones, con todos los valores en false
    expanded.value = clasicones.value.map(() => false);
});

// Función para alternar la expansión de la descripción
const toggleExpansion = (index) => {
    if (expanded.value[index] !== undefined) {
        expanded.value[index] = !expanded.value[index];
    }
};
</script>

<template>
    <AuthenticatedLayout title="Mi Perfil">
        <template #header>
            <div class="flex flex-col md:gap-4 md:flex-row p-2 justify-start rounded-md shadow-md mt-20 md:mt-16">
                <div class="w-60 flex md:justify-start mx-auto md:mx-0">
                    <img :src="user.profile_picture ? `/storage/${user.profile_picture}` : '/storage/images/Sin-perfil.jpg'"
                        alt="Profile Picture" class="rounded-full md:rounded-lg w-full h-auto" />
                </div>
                <div class="flex flex-col items-center md:items-start">
                    <p class="text-4xl font-semibold mt-4 leading-tight">
                        {{ user.name }}
                    </p>
                    <p>{{ user.about }}</p>
                </div>
            </div>
            <div class="flex flex-col gap-4 md:flex-row justify-center md:justify-center md:p-2 mt-2">
                <div class="flex flex-col bg-white rounded-md shadow-md md:w-1/3 p-5">
    <div>
        Seguidores de {{ user.name }}
    </div>
    <div class="flex flex-row flex-wrap mt-2">
        <div v-for="(follower, index) in followers" :key="index" class="pb-1">
            <img :src="follower.follower.profile_picture ? '/storage/' + follower.follower.profile_picture : '/storage/images/Sin-perfil.jpg'"
                :title="follower.follower.name" class="h-12 w-12 object-cover rounded-md mb-2 mr-2">
        </div>
    </div>
</div>


                <div class="flex flex-col rounded-md shadow-md bg-white md:w-2/3 p-5">
                    Sus Clasicones
                    <div class="flex flex-col">
                        <div v-for="(clasicon, index) in clasicones" :key="index" class="pb-1 flex flex-row">
                            <div class="w-1/4 mr-2">
                                <img :src="clasicon.image ? `/storage/${clasicon.image}` : '/storage/images/Sin-perfil.jpg'"
                                    :alt="clasicon.title" :title="clasicon.title"
                                    class="h-30 w-30 object-cover rounded-md mb-2 md:w-full  md:mb-0">
                            </div>
                            <div class="flex flex-col w-3/4">
                                <p class="font-bold">{{ clasicon.title }}</p>
                                <p>
                                    <!-- Verificación adicional para evitar errores -->
                                    "{{ clasicon.description }}"
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </template>
    </AuthenticatedLayout>
</template>
