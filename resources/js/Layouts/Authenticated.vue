<script setup>
import { Head } from '@inertiajs/vue3'
import Sidebar from '@/Components/Sidebar/Sidebar.vue'
import Navbar from '@/Components/Navbar.vue'
import PageFooter from '@/Components/PageFooter.vue'
import { sidebarState } from '@/Composables'

defineProps({
    title: String
})
</script>

<template>
    <Head :title="title"></Head>

    <div
        class="min-h-screen text-gray-900 bg-gray-100  "
    >
        <!-- Sidebar -->
        <Sidebar />

        <div
            style="transition-property: margin; transition-duration: 150ms"
            :class="[
                'min-h-screen flex flex-col',
                {
                    'lg:ml-64': sidebarState.isOpen,
                    'md:ml-16': !sidebarState.isOpen,
                },
            ]"
        >
            <!-- Navbar -->
            <Navbar />

            <!-- Page Heading -->
            <header v-if="$slots.header">
                <div class="pt-2 px-2  pb-1 md:p-4">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 px-0 sm:px-6">
                <slot />
            </main>

            <PageFooter />
        </div>
    </div>
</template>
