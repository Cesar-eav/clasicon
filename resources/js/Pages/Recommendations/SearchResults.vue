<template>
  <AuthenticatedLayout title="Resultados">
    <div class="container mx-auto md:mt-36 mt-28">
      <h1 class="text-2xl font-bold mb-4">Resultados de la búsqueda para "{{ query }}"</h1>

      <div v-if="results.data.length > 0" class="space-y-4 ">
        <div v-for="result in results.data" :key="result.id" class="p-4 bg-gray-200 rounded-lg">
          <div class="inline-block bg-[#3c888d]  text-white text-center text-xs px-2 py-1 md:mb-2 rounded"> {{
            result.category }}</div>

          <div>
            <Link :href="route('social.clasicon', result.id)" class="text-blue-500 inline-flex">
            <h2 class="text-xl font-semibold">{{ result.title }}</h2>
            </Link>

          </div>
          <div class="inline-flex">
          <p>Clasicón de: <strong>{{ result.user.name }}</strong></p>

          <img
            :src="result.user && result.user.profile_picture ? 'storage/' + result.user.profile_picture : '/storage/images/Sin-perfil.jpg'"
            class="rounded-full w-8 h-8 mr-2 mb-2 ml-2 ">
          </div>
          <p class="bg-gray-300 p-5 rounded-lg"><strong>"</strong>{{ result.description }}<strong>"</strong></p>
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