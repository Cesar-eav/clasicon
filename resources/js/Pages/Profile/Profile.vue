<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { usePage } from '@inertiajs/vue3'
import { ref } from 'vue'


const user = ref(usePage().props.user);
const mis_clasicones = ref(usePage().props.mis_clasicones);
const followers = usePage().props.followers || []

</script>

<template>
    <AuthenticatedLayout title="Mis Seguidores">
        <template #header>
            <div
                class="flex flex-col gap-4 md:flex-row md:p-2  justify-center bg-white  rounded-md shadow-md   mt-20 md:mt-16">

                <div class="w-60  mx-auto">
                    <img :src="`/storage/${$page.props.auth.user.profile_picture}`" alt="Profile Picture"
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
                <div class="flex  flex-col bg-white  rounded-md shadow-md w-1/2  p-5">
                    Seguidores

                    <div class="flex">
                        <div v-for="(follower, index) in followers" :key="index" class="pb-1">
                            <img :src="follower.follower.profile_picture ? '/storage/' + follower.follower.profile_picture : '/storage/images/Sin-perfil.jpg'"
                            :title="follower.follower.name" class="w-full h-48 object-cover rounded-md mb-2 md:w-12 md:h-12 md:mr-2 md:mb-0">
                            <!--  -->

                        </div>
                    </div>
                </div>


                <div class="flex flex-col rounded-md shadow-md bg-white w-1/2 p-5">
                    Tus Clasicones
                    <div class="flex">
                        <div v-for="(clasicon, index) in mis_clasicones" :key="index" class="pb-1">
                            <img :src="`/storage/${clasicon.image}`" :alt="clasicon.title" :title="clasicon.title"
                                class="w-full h-48 object-cover rounded-md mb-2 md:w-12 md:h-12 md:mr-2 md:mb-0">
                            <!--  -->

                        </div>
                    </div>

                </div>
            </div>
        </template>

    </AuthenticatedLayout>
</template>
