<script setup>
import PerfectScrollbar from '@/Components/PerfectScrollbar.vue'
import SidebarLink from '@/Components/Sidebar/SidebarLink.vue'
import { HomeIcon, UserGroupIcon, BookOpenIcon, CogIcon, BadgeCheckIcon, StarIcon, PlusIcon } from '@heroicons/vue/outline'
import { faPalette,faLeaf, faArchway, faSprayCan, faBuilding, faMuseum, faUtensils } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { defineProps } from 'vue';

const props = defineProps({
    recomendaciones: {
    type: Array,
    default: () => []
  }
});

const recomendaciones = props.recomendaciones;

console.log('Recomendaciones recibidas en SidebarContent.vue:', recomendaciones);



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

        <!-- Crear Recomendación -->
        <SidebarLink title="Crear Clasicón" :href="route('recommendations.create')"
            :active="route().current('recommendations.create')">
            <template #icon>
                <PlusIcon class="flex-shrink-0 w-6 h-6 text-yellow-500" aria-hidden="true" />
                <!-- Icono en amarillo -->
            </template>
        </SidebarLink>

        <SidebarLink class="sm:hidden"
            title="Naturaleza"
            :href="route('recommendations.naturaleza')"
            :active="route().current('recommendations.naturaleza')"
        >
            <template #icon>
                <CogIcon class="hidden flex-shrink-0 w-6 h-6 text-gray-500" aria-hidden="true" /> 
                <FontAwesomeIcon :icon="faLeaf" class="text-[#3c888d] hiddenflex-shrink-0 w-6 h-6 hover:text-red-400" />
            </template>
            

        </SidebarLink> 

        <SidebarLink class="sm:hidden"
            title="Monumentos"
            :href="route('recommendations.monumentos')"
            :active="route().current('recommendations.monumentos')"
        >
            <template #icon>
                <CogIcon class="hidden flex-shrink-0 w-6 h-6 text-gray-500" aria-hidden="true" /> 
                <FontAwesomeIcon :icon="faMuseum" class="text-[#3c888d] hiddenflex-shrink-0 w-6 h-6 hover:text-red-400" />
            </template>
            

        </SidebarLink> 


        <SidebarLink class="sm:hidden"
            title="Museos"
            :href="route('recommendations.museos')"
            :active="route().current('recommendations.museos')"
        >
            <template #icon>
                <CogIcon class="hidden flex-shrink-0 w-6 h-6 text-gray-500" aria-hidden="true" /> 
                <FontAwesomeIcon :icon="faArchway" class="text-[#3c888d] hiddenflex-shrink-0 w-6 h-6 hover:text-red-400" />
            </template>
            

        </SidebarLink> 

        <SidebarLink class="sm:hidden"
            title="Street Art"
            :href="route('recommendations.streetart')"
            :active="route().current('recommendations.streetart')"
        >
            <template #icon>
                <CogIcon class="hidden flex-shrink-0 w-6 h-6 text-gray-500" aria-hidden="true" /> 
                <FontAwesomeIcon :icon="faSprayCan" class="text-[#3c888d] hiddenflex-shrink-0 w-6 h-6 hover:text-red-400" />
            </template>
            

        </SidebarLink> 
        <SidebarLink class="sm:hidden"
            title="Cultura"
            :href="route('recommendations.cultura')"
            :active="route().current('recommendations.cultura')"
        >
            <template #icon>
                <CogIcon class="hidden flex-shrink-0 w-6 h-6 text-gray-500" aria-hidden="true" /> 
                <FontAwesomeIcon :icon="faPalette" class="text-[#3c888d] hiddenflex-shrink-0 w-6 h-6 hover:text-red-400" />
            </template>
            

        </SidebarLink> 
        <SidebarLink class="sm:hidden"
            title="Arquitectura"
            :href="route('recommendations.arquitectura')"
            :active="route().current('recommendations.arquitectura')"
        >
            <template #icon>
                <CogIcon class="hidden flex-shrink-0 w-6 h-6 text-gray-500" aria-hidden="true" /> 
                <FontAwesomeIcon :icon="faBuilding" class="text-[#3c888d] hiddenflex-shrink-0 w-6 h-6 hover:text-red-400" />
            </template>
            

        </SidebarLink> 
    </PerfectScrollbar>
</template>
