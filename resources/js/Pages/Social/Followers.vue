<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { usePage } from '@inertiajs/vue3'

const followers = usePage().props.followers || []
</script>

<template>
    <AuthenticatedLayout title="Mis Seguidores">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">Mis Seguidores</h2>
            </div>
        </template>

        <!-- Listado de Seguidores -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
            <div v-if="followers.length > 0" class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-white">Imagen</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-white">Nombre</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-white">Descripción</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-white">Fecha de Seguimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="follower in followers" :key="follower.id" class="bg-white dark:bg-gray-800">
                            <td class="px-4 py-2">
                                <img :src="follower.profile_picture" alt="Follower Image"
                                    class="w-32 h-32 object-cover rounded-md">
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ follower.follower.name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ follower.follower.about }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ follower.created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-else class="text-center p-10">
                <img src="/images/no-followers.png" alt="No Followers" class="mx-auto mb-4 w-32 h-32 object-cover">
                <p class="text-gray-600 dark:text-gray-400">Aún no tienes seguidores. ¡Comparte tu perfil para ganar más seguidores!</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
