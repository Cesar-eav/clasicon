<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import Button from '@/Components/Button.vue'
import { MenuFoldLineLeftIcon, MenuFoldLineRightIcon } from '@/Components/Icons/outline'
import { XIcon } from '@heroicons/vue/outline'
import { sidebarState } from '@/Composables'

const user = usePage().props.auth.user;

</script>

<template>
    <div class="flex items-center justify-between flex-shrink-0 px-3">
        <Link  :href="user ? route('welcome') :  route('welcome')" class="inline-flex items-center gap-2">
            <img src="/storage/Logo.png" class="w-12">
            <h1 class="text-black font-bold text-2xl">Clasicón</h1>
            
        </Link>

        <Button
            iconOnly
            variant="secondary"
            type="button"
            v-slot="{ iconSizeClasses }"
            v-show="sidebarState.isOpen || sidebarState.isHovered"
            @click="sidebarState.isOpen = !sidebarState.isOpen"
            :srText="sidebarState.isOpen ? 'Close sidebar' : 'Open sidebar'"
          
        >
            <MenuFoldLineLeftIcon
                aria-hidden="true"
                v-show="sidebarState.isOpen"
                :class="['hidden lg:block', iconSizeClasses]" />

            <MenuFoldLineRightIcon
                aria-hidden="true"
                v-show="!sidebarState.isOpen"
                :class="['hidden lg:block', iconSizeClasses]" />

            <XIcon
                aria-hidden="true"
                :class="['lg:hidden', iconSizeClasses]" />
        </Button>
    </div>
</template>
