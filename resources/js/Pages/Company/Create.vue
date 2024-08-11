<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'

</script>
<template>
        <AuthenticatedLayout title="Empresa">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Empresa - Crear
            </h2>
        </template>

        <div class="space-y-6">
            <div class="p-6 overflow-hidden bg-white dark:bg-rounded-md shadow-md dark:bg-dark-eval-1">
                <div class="w-full">
                    <div class="bg-white dark:bg-gray-800 px-4">
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>