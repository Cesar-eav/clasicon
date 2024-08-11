<script setup>
import PerfectScrollbar from '@/Components/PerfectScrollbar.vue'
import SidebarLink from '@/Components/Sidebar/SidebarLink.vue'
import { HomeIcon, UserGroupIcon, BookOpenIcon, CogIcon, BadgeCheckIcon, StarIcon } from '@heroicons/vue/outline'
import SidebarCollapsible from '@/Components/Sidebar/SidebarCollapsible.vue'
import SidebarCollapsibleItem from '@/Components/Sidebar/SidebarCollapsibleItem.vue'
</script>

<template>
    <PerfectScrollbar
        tagname="nav"
        aria-label="main"
        class="relative flex flex-col flex-1 max-h-full gap-4 px-3"
    >
        <!-- Dashboard -->
        <SidebarLink
            title="Inicio"
            :href="route('dashboard')"
            :active="route().current('dashboard')"
        >
            <template #icon>
                <HomeIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <!-- Recommendations -->
        <SidebarCollapsible
            title="Recomendaciones"
            :active="route().current('recommendations.*')"
        >
            <template #icon>
                <BookOpenIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>

            <SidebarCollapsibleItem
                title="Mis Recomendaciones"
                :href="route('recommendations.index')"
                :active="route().current('recommendations.index')"
            />
            <SidebarCollapsibleItem
                title="Crear Recomendación"
                :href="route('recommendations.create')"
                :active="route().current('recommendations.create')"
            />
            <SidebarCollapsibleItem
                title="Explorar Recomendaciones"
                :href="route('recommendations.explore')"
                :active="route().current('recommendations.explore')"
            />
        </SidebarCollapsible>

        <!-- Social Interaction -->
        <SidebarCollapsible
            title="Interacción Social"
            :active="route().current('social.*')"
        >
            <template #icon>
                <UserGroupIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>

            <SidebarCollapsibleItem
                title="Seguidores"
                :href="route('social.followers')"
                :active="route().current('social.followers')"
            />
            <SidebarCollapsibleItem
                title="Siguiendo"
                :href="route('social.following')"
                :active="route().current('social.following')"
            />
            <SidebarCollapsibleItem
                title="Notificaciones"
                :href="route('social.notifications')"
                :active="route().current('social.notifications')"
            />
        </SidebarCollapsible>

        <!-- Achievements -->
        <SidebarLink
            title="Mis Logros"
            :href="route('profile.achievements')"
            :active="route().current('profile.achievements')"
        >
            <template #icon>
                <BadgeCheckIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <!-- Points -->
        <SidebarLink
            title="Mis Puntos"
            :href="route('profile.points')"
            :active="route().current('profile.points')"
        >
            <template #icon>
                <StarIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <!-- User Settings -->
        <SidebarLink
            title="Configuración"
            :href="route('profile.settings')"
            :active="route().current('profile.settings')"
        >
            <template #icon>
                <CogIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

    </PerfectScrollbar>
</template>
