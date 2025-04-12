<template>
  <AuthenticatedLayout title="Resultados">
    <div class="container mx-auto md:mt-36 mt-28">
      <h1 class="text-2xl font-bold mb-4">Resultados de la búsqueda para "{{ query }}"</h1>

      <div v-if="results.data.length > 0" class="space-y-4 ">
        <div v-for="result in results.data" :key="result.id" class="p-4 bg-gray-200 rounded-lg">
          <!-- <div class="inline-block bg-[#3c888d]  text-white text-center text-xs px-2 py-1 md:mb-2 rounded"> {{
            result.category }}</div> -->

          <div>

            <!-- GPS ESCRITORIO -->
            <div class="inline-flex">
              <a class="hidden md:block"
                :href="`https://www.google.com/maps/place/${result.lat},${result.lng}/@${result.lat},${result.lng},18z`"
                target="_blank">
                <font-awesome-icon icon="fa-solid fa-location-dot"
                  class="text-red-500 text-md hover:text-red-400 mr-2" />
              </a>
              <!-- GPS MOVIL -->
              <a class="block md:hidden" :href="`geo:${result.lat},${result.lng}?q=${result.lat},${result.lng}&z=18`"
                target="_blank">
                <font-awesome-icon icon="fa-solid fa-location-dot"
                  class="text-red-500 text-md hover:text-red-400 mr-2" />
              </a>
              <h2 class="text-xl text-[#3c888d] font-semibold">{{ result.title }}</h2>


            </div>
            <!-- Imagen en móviles -->
            <div class="w-full">
              <img :src="`/storage/${result.image}`" alt="Recommendation Image"
                class="w-full aspect-[3/4] object-cover rounded-b-lg shadow-md md:hidden border-2 border-gray-300">
            </div>

          </div>
                      <!-- Imagen en Escritorio -->

          <div class="inline-flex">
            <p>Clasicón de: <strong>{{ result.user.name }}</strong></p>

            <img
              :src="result.user && result.user.profile_picture ? 'storage/' + result.user.profile_picture : '/storage/images/Sin-perfil.jpg'"
              class="rounded-full w-8 h-8 mr-2 mb-2 ml-2 ">
          </div>

          <div class="flex">
            <img :src="`/storage/${result.image}`" alt="Recommendation Image"
              class="w-full object-cover rounded-md mb-4 md:w-48 md:h-full md:mr-4 md:mb-0 hidden md:block">

            <p class="bg-gray-300 p-5 rounded-lg">{{ result.description }}</p>
          </div>
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