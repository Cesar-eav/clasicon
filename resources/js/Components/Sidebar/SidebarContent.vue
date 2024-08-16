<script setup>
import PerfectScrollbar from '@/Components/PerfectScrollbar.vue'
import SidebarLink from '@/Components/Sidebar/SidebarLink.vue'
import { HomeIcon, UserGroupIcon, BookOpenIcon, CogIcon, BadgeCheckIcon, StarIcon } from '@heroicons/vue/outline'
</script>

<template>
    <PerfectScrollbar
        tagname="nav"
        aria-label="main"
        class="relative flex flex-col flex-1 max-h-full gap-2 px-3" 
    >
        <!-- Dashboard -->
        <SidebarLink
            title="Inicio"
            :href="route('dashboard')"
            :active="route().current('dashboard')"
        >
            <template #icon>
                <HomeIcon class="flex-shrink-0 w-6 h-6 text-blue-500" aria-hidden="true" /> <!-- Icono en azul -->
            </template>
        </SidebarLink>

        <!-- Mis Recomendaciones -->
        <SidebarLink
            title="Mis Recomendaciones"
            :href="route('recommendations.index')"
            :active="route().current('recommendations.index')"
        >
            <template #icon>
                <BookOpenIcon class="flex-shrink-0 w-6 h-6 text-green-500" aria-hidden="true" /> <!-- Icono en verde -->
            </template>
        </SidebarLink>

        <!-- Crear Recomendación -->
        <SidebarLink
            title="Crear Recomendación"
            :href="route('recommendations.create')"
            :active="route().current('recommendations.create')"
        >
            <template #icon>
                <BookOpenIcon class="flex-shrink-0 w-6 h-6 text-yellow-500" aria-hidden="true" /> <!-- Icono en amarillo -->
            </template>
        </SidebarLink>

        <!-- Explorar Recomendaciones -->
        <SidebarLink
            title="Explorar Recomendaciones"
            :href="route('recommendations.explore')"
            :active="route().current('recommendations.explore')"
        >
            <template #icon>
                <BookOpenIcon class="flex-shrink-0 w-6 h-6 text-red-500" aria-hidden="true" /> <!-- Icono en rojo -->
            </template>
        </SidebarLink>

        <!-- Seguidores -->
        <SidebarLink
            title="Seguidores"
            :href="route('social.followers')"
            :active="route().current('social.followers')"
        >
            <template #icon>
                <UserGroupIcon class="flex-shrink-0 w-6 h-6 text-purple-500" aria-hidden="true" /> <!-- Icono en morado -->
            </template>
        </SidebarLink>

        <!-- Siguiendo -->
        <SidebarLink
            title="Siguiendo"
            :href="route('social.following')"
            :active="route().current('social.following')"
        >
            <template #icon>
                <UserGroupIcon class="flex-shrink-0 w-6 h-6 text-indigo-500" aria-hidden="true" /> <!-- Icono en índigo -->
            </template>
        </SidebarLink>

        <!-- Notificaciones -->
        <SidebarLink
            title="Notificaciones"
            :href="route('social.notifications')"
            :active="route().current('social.notifications')"
        >
            <template #icon>
                <UserGroupIcon class="flex-shrink-0 w-6 h-6 text-pink-500" aria-hidden="true" /> <!-- Icono en rosado -->
            </template>
        </SidebarLink>

        <!-- Mis Logros -->
        <SidebarLink
            title="Mis Logros"
            :href="route('profile.achievements')"
            :active="route().current('profile.achievements')"
        >
            <template #icon>
                <BadgeCheckIcon class="flex-shrink-0 w-6 h-6 text-orange-500" aria-hidden="true" /> <!-- Icono en naranja -->
            </template>
        </SidebarLink>

        <!-- Mis Puntos -->
        <SidebarLink
            title="Mis Puntos"
            :href="route('profile.points')"
            :active="route().current('profile.points')"
        >
            <template #icon>
                <StarIcon class="flex-shrink-0 w-6 h-6 text-teal-500" aria-hidden="true" /> <!-- Icono en teal -->
            </template>
        </SidebarLink>

        <!-- Configuración -->
        <SidebarLink
            title="Configuración"
            :href="route('profile.settings')"
            :active="route().current('profile.settings')"
        >
            <template #icon>
                <CogIcon class="flex-shrink-0 w-6 h-6 text-gray-500" aria-hidden="true" /> <!-- Icono en gris -->
            </template>
        </SidebarLink>
    </PerfectScrollbar>
</template>
