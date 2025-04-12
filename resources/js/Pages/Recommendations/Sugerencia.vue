<template>
    <AuthenticatedLayout title="Nueva Recomendación">
      <div class="text-center">
        <h2 class="text-3xl font-semibold leading-tight mt-24">¡Sugierenos tu clasicón! </h2>
        <h2 class="text-xl font-semibold leading-tight ">Elige la forma rápida o la detallada.</h2>
      </div>

  
      <div class="p-6 m-2 bg-white gap-20 text-white rounded-md shadow-md md:flex mb-10">
        <form @submit.prevent="submitForm" enctype="multipart/form-data" class="bg-[#3c888d] p-5">
          <p class="text-center font-bold mb-3">FORMA DETALLADA</p>
  
          <div class="mb-4">
            <label for="title" class="block text-sm font-bold ">Título</label>
            <input required type="text" v-model="form.detailed_title" id="title"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  text-gray-500">
          </div>
          <div class="mb-4">
            <label for="detailed_category" class="block text-sm font-bold  ">Categoría (Picada, Museo, Arquitectura, Centro Cultural, Street Art, Naturaleza u otra) </label>
            <select required v-model="form.detailed_category" id="detailed_category"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-500">
              <option value="">Seleccione una categoría</option>
              <option value="nature">Naturaleza</option>
              <option value="monument">Monumentos</option>
              <option value="streetart">StreetArt</option>
              <option value="architecture">Arquitectura</option>
              <option value="culture">Cultura</option>
              <option value="museum">Museos</option>
              <option value="picada">Picadas</option>
              <option value="picada">Otra</option>
            </select>
          </div>
          <div class="flex mb-4">
            <input required type="text" v-model="form.detailed_ciudad" id="detailed_ciudad"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  text-gray-500"
              placeholder="Ciudad">
            <input required type="text" v-model="form.detailed_lat" id="detailed_lat"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  text-gray-500"
              placeholder="Latitud">
            <input required type="text" v-model="form.detailed_lng" id="detailed_lng"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  text-gray-500"
              placeholder="Longitud ">
          </div>
          <label for="detailed_title" class="block text-sm font-medium ">Opcionales</label>
          <div class="flex mb-4">
            <input type="text" v-model="form.detailed_autor" id="detailed_autor"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  text-gray-500"
              placeholder="Autor">
            <input type="text" v-model="form.detailed_enlace" id="detailed_enlace"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  text-gray-500"
              placeholder="Enlace">
          </div>
          <div class="mb-4">
            <label for="detailed_description" class="block text-sm font-bold ">
              Descripción
            </label>
            <textarea required v-model="form.detailed_description" id="detailed_description" rows="4"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  text-gray-500"
              maxlength="1000"></textarea>

          <p class="text-sm text-right"
            :class="{ 'text-red-500': form.detailed_description.length >= 950, 'text-gray-500': form.detailed_description.length < 950 }">
            {{ 1000 - form.detailed_description.length }} caracteres restantes
          </p>
        </div>
        <div class="mb-4">
          <label for="detailed_tags" class="block text-sm font-medium ">Etiquetas
            (Ejemplo:
            diversion, paseo, mural, valparaíso).</label>
          <input type="text" v-model="form.detailed_tags" id="detailed_tags"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  text-gray-500">
        </div>
        <div class="mb-4">
          <label for="detailed_image" class="block text-sm font-medium ">Subir
            Imagen</label>
          <input required type="file" id="detailed_image" @change="handleImageChange"
            class="mt-1 block w-full text-gray-500 dark:text-gray-400">
        </div>
        <div class="flex justify-start">
          <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md">Enviar
          </button>
        </div>
      </form>

      <div class="bg-[#3c888d] p-5 mt-2 md:mt-0 text-white">
        <p class="text-center  font-bold mb-3">FORMA RÁPIDA</p>
        <form @submit.prevent="submitFormQuick" enctype="multipart/form-data">
          <div class="mb-4 ">
            <label for="quick_title" class="block text-sm font-medium ">Título
            </label>
            <input required type="text" v-model="form.quick_title" id="quick_title"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-800">
          </div>
          <div class="mb-4 ">
            <label for="quick_city" class="block text-sm font-medium ">Ciudad
            </label>
            <input required type="text" v-model="form.quick_city" id="quick_city"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-800">
          </div>
          <label for="quick_description" class="block text-sm font-medium ">Descripción
          </label>
          <textarea required v-model="form.quick_description" id="quick_description" rows="4" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-800"
            maxlength="1000"></textarea>
          <div class="mb-4 mt-2">
            <label for="quick_image" class="block text-sm font-medium">Subir
              Imagen (Opcional)</label>
            <input type="file" id="quick_image" @change="handleImageChangeQuick"
              class="mt-1 block w-full ">
          </div>
          <div class="flex justify-start">
            <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md">Enviar
            </button>
          </div>
        </form>
      </div>
    </div>

  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  // Campos para la FORMA DETALLADA
  detailed_title: '',
  detailed_ciudad: '',
  detailed_lat: '',
  detailed_lng: '',
  detailed_enlace: '',
  detailed_autor: '',
  detailed_description: '',
  detailed_category: '',
  detailed_image: null,
  detailed_tags: '',

  // Campos para la FORMA RÁPIDA
  quick_title: '',
  quick_city:'',
  quick_description: '',
  quick_image: null,
})

const handleImageChange = (event) => {
  form.detailed_image = event.target.files[0];
}

const handleImageChangeQuick = (event) => {
  form.quick_image = event.target.files[0];
}

const submitForm = () => {
  const formData = new FormData();
  formData.append('title', form.detailed_title);
  formData.append('ciudad', form.detailed_ciudad);
  formData.append('lat', form.detailed_lat);
  formData.append('lng', form.detailed_lng);
  formData.append('enlace', form.detailed_enlace);
  formData.append('autor', form.detailed_autor);
  formData.append('description', form.detailed_description);
  formData.append('category', form.detailed_category);
  formData.append('image', form.detailed_image);
  formData.append('tags', form.detailed_tags);
  form.post(route('sugerencia.store'), {
    onSuccess: () => {
      form.reset();
      console.log("GUARDADO EXITOSO EN VUE");
      alert("¡Clasicón enviado exitosamente!");
    },
    onError: (errors) => {
      console.error("ERRORES RECIBIDOS DEL SERVIDOR EN VUE:", errors);
    },
    onFinish: () => {
      console.log("FINALIZADO EL PROCESO DE ENVÍO DEL FORMULARIO EN VUE");
    },
    data: formData,
    forceFormData: true,
  });
}

const submitFormQuick = () => {
  const formDataQuick = new FormData();
  formDataQuick.append('quick_title', form.quick_title);
  formDataQuick.append('quick_city', form.quick_city);
  formDataQuick.append('quick_description', form.quick_description);
  formDataQuick.append('quick_image', form.quick_image);

  form.post(route('recommendations.storequick'), {
    onSuccess: () => {
      form.reset();
      console.log("GUARDADO EXITOSO EN VUE");
      alert("¡Clasicón enviado exitosamente!");
    },
    onError: (errors) => {
      console.error("ERRORES RECIBIDOS DEL SERVIDOR EN VUE:", errors);
    },
    onFinish: () => {
      console.log("FINALIZADO EL PROCESO DE ENVÍO DEL FORMULARIO EN VUE");
    },
    data: formDataQuick,
    forceFormData: true,
  });
}
</script>