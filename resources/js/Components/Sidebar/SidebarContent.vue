<script setup>
import PerfectScrollbar from '@/Components/PerfectScrollbar.vue'
import SidebarLink from '@/Components/Sidebar/SidebarLink.vue'
import { HomeIcon, UserGroupIcon, BookOpenIcon, CogIcon, BadgeCheckIcon, StarIcon, PlusIcon } from '@heroicons/vue/outline'
import { faPalette,faLeaf, faArchway, faSprayCan, faBuilding, faMuseum, faUtensils } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';



const recommendations = ref(usePage().props.recommendations || []);

</script>

<template>
    <PerfectScrollbar tagname="nav" aria-label="main" class="relative flex flex-col flex-1 max-h-full gap-2 px-3">

<!-- 
        <a v-if="$page.props.auth.user" :href="route('profile.myprofile')" class="flex flex-row items-center">
            <img :src="$page.props.auth.user.profile_picture ? `/storage/${$page.props.auth.user.profile_picture}` : '/storage/images/Sin-perfil.jpg'"
                alt="Profile Picture" class="w-10 h-10 rounded-full mr-2" />
            <p>{{ $page.props.auth.user.name }}</p>
        </a>

        <a v-else class="flex flex-row items-center">
            <img src="/storage/images/Sin-perfil.jpg" alt="Profile Picture" class="w-10 h-10 rounded-full mr-2" />
            <p>Invitado</p>
        </a> -->

        <!-- Dashboard -->
        <SidebarLink title="Inicio" :href="$page.props.auth.user ? route('welcome') : route('welcome') "  :active="route().current('dashboard')">
            <template #icon>
                <HomeIcon class="flex-shrink-0 w-6 h-6 text-blue-500" aria-hidden="true" /> <!-- Icono en azul -->
            </template>
        </SidebarLink>

        <!-- Mis Recomendaciones -->

        <!-- <SidebarLink title="Mis Clasicones" :href="route('recommendations.index')"
            :active="route().current('recommendations.index')">
            <template #icon>
                <BookOpenIcon class="flex-shrink-0 w-6 h-6 text-green-500" aria-hidden="true" />
            </template>
        </SidebarLink> -->

        <!-- Crear Recomendación -->
        <SidebarLink title="Crear Clasicón" :href="route('recommendations.create')"
            :active="route().current('recommendations.create')">
            <template #icon>
                <PlusIcon class="flex-shrink-0 w-6 h-6 text-yellow-500" aria-hidden="true" />
                <!-- Icono en amarillo -->
            </template>
        </SidebarLink>

        <!-- Explorar Recomendaciones
        <SidebarLink title="Explorar" :href="route('recommendations.explore')"
            :active="route().current('recommendations.explore')">
            <template #icon>
                <BookOpenIcon class="flex-shrink-0 w-6 h-6 text-red-500" aria-hidden="true" /> 
            </template>
        </SidebarLink> 

        <SidebarLink title="Seguidores" :href="route('social.followers')" :active="route().current('social.followers')">
            <template #icon>
                <UserGroupIcon class="flex-shrink-0 w-6 h-6 text-purple-500" aria-hidden="true" />
            </template>
        </SidebarLink>

        <SidebarLink title="Siguiendo" :href="route('social.following')" :active="route().current('social.following')">
            <template #icon>
                <UserGroupIcon class="flex-shrink-0 w-6 h-6 text-indigo-500" aria-hidden="true" />
            </template>
        </SidebarLink>

        <SidebarLink
            title="Notificaciones"
            :href="route('social.notifications')"
            :active="route().current('social.notifications')"
        >
            <template #icon>
                <UserGroupIcon class="flex-shrink-0 w-6 h-6 text-pink-500" aria-hidden="true" /> 
            </template>
        </SidebarLink>

        <SidebarLink
            title="Mis Logros"
            :href="route('profile.achievements')"
            :active="route().current('profile.achievements')"
        >
            <template #icon>
                <BadgeCheckIcon class="flex-shrink-0 w-6 h-6 text-orange-500" aria-hidden="true" /> 
            </template>
        </SidebarLink>

        <SidebarLink
            title="Mis Puntos"
            :href="route('profile.points')"
            :active="route().current('profile.points')"
        >
            <template #icon>
                <StarIcon class="flex-shrink-0 w-6 h-6 text-teal-500" aria-hidden="true" />
            </template>
        </SidebarLink>
        -->

        <SidebarLink class="sm:hidden"
            title="Naturaleza"
            :href="route('profile.settings')"
            :active="route().current('profile.settings')"
        >
            <template #icon>
                <CogIcon class="hidden flex-shrink-0 w-6 h-6 text-gray-500" aria-hidden="true" /> 
                <FontAwesomeIcon :icon="faLeaf" class="text-[#3c888d] hiddenflex-shrink-0 w-6 h-6 hover:text-red-400" />
            </template>
            

        </SidebarLink> 


    </PerfectScrollbar>
</template>
