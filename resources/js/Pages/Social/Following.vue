<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue';
import { usePage, router } from '@inertiajs/vue3';

const following = ref(usePage().props.following || []);
</script>

<template>
    <AuthenticatedLayout title="Usuarios que Sigues">
        <template #header >
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between p-2 mt-12">
                <h2 class="text-xl font-semibold leading-tight">
                    Sigues a estos usuarios
                </h2>
            </div>
        </template>

        <!-- Listado de usuarios que sigo -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
            <div v-if="following.length > 0">
                <ul>
                    <li v-for="user in following" :key="user.id" class="mb-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <img :src="user.profile_picture || '/storage/images/Sin-perfil.jpg'" alt="Profile Picture"
                                class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-300">{{ user.user.name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ user.user.about }}</p>
                            </div>
                        </div>
                        <button @click="unfollow(user.id)" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md flex-shrink-0"   style="min-width: 150px;">
                            Dejar de Seguir
                        </button>
                    </li>
                </ul>
            </div>
            <div v-else>
                <p class="text-gray-600 dark:text-gray-400">No estás siguiendo a ningún usuario.</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

