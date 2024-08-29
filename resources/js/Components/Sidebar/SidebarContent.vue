<script setup>
import PerfectScrollbar from '@/Components/PerfectScrollbar.vue'
import SidebarLink from '@/Components/Sidebar/SidebarLink.vue'
import { HomeIcon, UserGroupIcon, BookOpenIcon, CogIcon, BadgeCheckIcon, StarIcon } from '@heroicons/vue/outline'
</script>

<template>
    <PerfectScrollbar tagname="nav" aria-label="main" class="relative flex flex-col flex-1 max-h-full gap-2 px-3">
        

           <a :href="route('profile.myprofile')" class="flex flex-row items-center">
             <img :src="$page.props.auth.user.profile_picture ? `/storage/${$page.props.auth.user.profile_picture}` :'/storage/images/Sin-perfil.jpg'" alt="Profile Picture"
                class="w-10 h-10 rounded-full mr-2" />

                
            <p>{{ $page.props.auth.user.name }}</p>
        </a>
    

        <!-- Dashboard -->
        <SidebarLink title="Inicio" :href="route('dashboard')" :active="route().current('dashboard')">
            <template #icon>
                <HomeIcon class="flex-shrink-0 w-6 h-6 text-blue-500" aria-hidden="true" /> <!-- Icono en azul -->
            </template>
        </SidebarLink>

        <!-- Mis Recomendaciones -->
        <SidebarLink title="Mis Clasicones" :href="route('recommendations.index')"
            :active="route().current('recommendations.index')">
            <template #icon>
                <BookOpenIcon class="flex-shrink-0 w-6 h-6 text-green-500" aria-hidden="true" /> <!-- Icono en verde -->
            </template>
        </SidebarLink>

        <!-- Crear Recomendación -->
        <SidebarLink title="Crear Recomendación" :href="route('recommendations.create')"
            :active="route().current('recommendations.create')">
            <template #icon>
                <BookOpenIcon class="flex-shrink-0 w-6 h-6 text-yellow-500" aria-hidden="true" />
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
         -->
        

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
        <!-- 
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

        <SidebarLink
            title="Configuración"
            :href="route('profile.settings')"
            :active="route().current('profile.settings')"
        >
            <template #icon>
                <CogIcon class="flex-shrink-0 w-6 h-6 text-gray-500" aria-hidden="true" /> 
            </template>
        </SidebarLink> -->

    </PerfectScrollbar>
</template>
