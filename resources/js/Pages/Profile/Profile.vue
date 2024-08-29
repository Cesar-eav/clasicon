<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { usePage } from '@inertiajs/vue3'
import { ref } from 'vue'


const user = ref(usePage().props.user);
const mis_clasicones = ref(usePage().props.mis_clasicones);
const followers = usePage().props.followers || []

</script>

<template>
    <AuthenticatedLayout title="Mi Perfil">
        <template #header>
            <div
                class="flex flex-col  md:gap-4 md:flex-row p-2  justify-start rounded-md shadow-md   mt-20 md:mt-16">

                <div class="w-60 flex md:justify-start mx-auto md:mx-0">
                    <img :src="$page.props.auth.user.profile_picture ? `/storage/${$page.props.auth.user.profile_picture}` :'/storage/images/Sin-perfil.jpg'" alt="Profile Picture"
                        class="rounded-full md:rounded-lg w-full h-auto " />
                </div>
                <div class="flex flex-col items-center md:items-start">
                    <p class="text-4xl font-semibold  mt-4 leading-tight ">
                        {{ $page.props.auth.user.name }}
                    </p>
                    <p>{{ $page.props.auth.user.about }}</p>
                </div>
            </div>
            <div class="flex flex-col gap-4 md:flex-row justify-center md:justify-center md:p-2 mt-2 ">
                <div class="flex flex-col bg-white rounded-md shadow-md md:w-1/2 p-5">
                    Seguidores

                    <div class="flex  ">
                        <div v-for="(follower, index) in followers" :key="index" class="pb-1">
                            <img :src="follower.follower.profile_picture ? '/storage/' + follower.follower.profile_picture : '/storage/images/Sin-perfil.jpg'"
                            :title="follower.follower.name" class="h-12 w-12 object-cover rounded-md mb-2 mr-2  md:mb-0">
                            <!--  -->

                        </div>
                    </div>
                </div>


                <div class="flex flex-col rounded-md shadow-md bg-white md:w-1/2 p-5">
                    Tus Clasicones
                    <div class="flex">
                        <div v-for="(clasicon, index) in mis_clasicones" :key="index" class="pb-1">
                            <img :src="`/storage/${clasicon.image}`" :alt="clasicon.title" :title="clasicon.title"
                                class="h-12 w-12 object-cover rounded-md mb-2 md:w-12  mr-2 md:mb-0">


                        </div>
                    </div>

                </div>
            </div>
        </template>

    </AuthenticatedLayout>
</template>
