
<template>
<AuthenticatedLayout title="Resultados">
    <div class="container mx-auto mt-10">
      <h1 class="text-2xl font-bold mb-4">Resultados de la búsqueda para "{{ query }}"</h1>
  
      <div v-if="results.data.length > 0" class="space-y-4">
        <div v-for="result in results.data" :key="result.id" class="p-4 bg-gray-100 rounded-lg">
          <h2 class="text-xl font-semibold">{{ result.title }}</h2>
          <p>{{ result.description }}</p>
          <Link :href="route('social.clasicon', result.id)" class="text-blue-500">Ver más</Link>
        </div>
      </div>
  
      <div v-else>
        <p>No se encontraron resultados para "{{ query }}"</p>
      </div>
  
      <!-- Paginación -->
      <pagination :links="results.links"></pagination>
    </div>
  </AuthenticatedLayout>
  </template>
  
  <script setup>

import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

  
  const props = defineProps({
    query: String,
    results: Object
  })
  </script>
  