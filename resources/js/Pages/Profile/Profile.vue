<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { usePage, Link } from '@inertiajs/vue3'
import { ref } from 'vue'


const user = ref(usePage().props.user);
const mis_clasicones = ref(usePage().props.mis_clasicones);
const followers = usePage().props.followers || []
const thoughts = ref(usePage().props.thoughts || []);

</script>

<template>
    <AuthenticatedLayout title="Mi Perfil">
        <template #header>
            <div
                class="flex w-ful h-auto flex-col md:gap-4 md:flex-row p-2 justify-start rounded-md shadow-md mt-20 md:mt-24">

                <div class="flex md:justify-start mx-auto md:mx-0 ">
                    <img :src="$page.props.auth.user.profile_picture ? `/storage/${$page.props.auth.user.profile_picture}` : '/storage/images/Sin-perfil.jpg'"
                        alt="Profile Picture" class="w-40 h-40 object-cover rounded-full md:rounded-lg  " />
                </div>
                <div class="TEXTO flex flex-col items-center md:items-start w-4/5">
                    <p class="text-4xl font-semibold  mt-4 leading-tight ">
                        {{ $page.props.auth.user.name }}
                    </p>
                    <p>{{ $page.props.auth.user.about }}</p>
                </div>
            </div>

<!-- Pensamientos listados verticalmente -->
<div class="flex flex-col gap-4 md:flex-row justify-between md:justify-center md:p-2 mt-2">
    
    <!-- Sección de Seguidores -->
    <div class="flex flex-col bg-white rounded-md shadow-md w-full md:w-[20%] p-5">
        <p class="font-semibold text-lg">Seguidores</p>
        <div class="flex flex-wrap">
            <div v-for="(follower, index) in followers" :key="index" class="pb-1">
                <Link :href="route('social.profile', follower.follower.id)">
                    <img :src="follower.follower.profile_picture ? '/storage/' + follower.follower.profile_picture : '/storage/images/Sin-perfil.jpg'"
                        :title="follower.follower.name"
                        class="h-12 w-12 object-cover rounded-md mb-2 mr-2 md:mb-0">
                </Link>
            </div>
        </div>
    </div>

    <!-- Sección de Pensamientos -->
    <div class="flex flex-col bg-white rounded-md shadow-md w-full md:w-[60%] p-5">
        <p class="font-semibold text-lg">Muro</p>
        <div class="flex flex-col gap-4">
            <div v-if="thoughts.length > 0">
                <div v-for="(thought, index) in thoughts" :key="index" class="flex flex-col bg-gray-200 p-5 rounded-lg mb-5">
                    <p>{{ thought.content }}</p>
                    <p class="text-sm text-gray-500">{{ thought.created_at }}</p>
                </div>
            </div>
            <div v-else>
                No hay contenido para mostrar
            </div>
        </div>
    </div>

    <!-- Sección de Clasicones -->
    <div class="flex flex-col bg-white rounded-md shadow-md w-full md:w-[20%] p-5">
        <p class="font-semibold text-lg">Clasicones</p>
        <div class="flex flex-wrap">
            <div v-for="(clasicon, index) in mis_clasicones" :key="index" class="pb-1">
                <Link :href="route('social.clasicon', clasicon.id)">
                    <img :src="`/storage/${clasicon.image}`" :alt="clasicon.title" :title="clasicon.title"
                        class="h-12 w-12 object-cover rounded-md mb-2 md:w-12  mr-2 md:mb-0">
                </Link>
            </div>
        </div>
    </div>

</div>


        </template>
    </AuthenticatedLayout>
</template>
