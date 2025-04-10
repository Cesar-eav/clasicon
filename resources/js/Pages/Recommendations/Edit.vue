<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { useForm } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

// Obtener la recomendación existente
const recommendation = usePage().props.recommendation

// Estado para almacenar la nueva imagen seleccionada
const newImage = ref(null)

// Inicializar el formulario con los datos existentes
const form = useForm({
    title: recommendation.title,
    description: recommendation.description,
    category: recommendation.category,
    lat: recommendation.lat,
    lng: recommendation.lng,
    image: null // Inicialmente sin imagen nueva
})

// Función para manejar el cambio de imagen
function handleImageChange(event) {
    newImage.value = event.target.files[0]
    form.image = newImage.value
}

// Función para enviar el formulario
function submitForm() {
    console.log("FORMULARIO");
    console.log("GUARDANDO");
    console.log("Form data:", form.data());
    form.post(route('recommendations.update', recommendation.id), {
        onSuccess: () => form.reset(),
        onError: () => newImage.value = null // Resetea la imagen si hay error
    })
}

const categorias = ['nature', 'monument', 'streetart', 'architecture', 'culture', 'museum', 'picada']

</script>

<template>
    <AuthenticatedLayout title="Editar Recomendación">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight">Editar Recomendación</h2>
        </template>

        <div class="p-6 bg-white  rounded-md shadow-md">
            <form @submit.prevent="submitForm" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="title"
                        class="block text-sm font-medium text-gray-700">Títulos</label>
                    <input type="text" v-model="form.title" id="title"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                        required>
                </div>

                <div class="mb-4">
                    <label for="description"
                        class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea v-model="form.description" id="description" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 "></textarea>
                </div>

                <div class="flex flex-row mb-4 gap-5 ">

                    <div class="w-1/3">
                        <label for="category" class="block text-sm font-medium text-gray-700">
                            Categoría actual: <p class="uppercase inline font-bold">{{ form.category }}</p>
                        </label>

                        <select v-model="form.category" id="category"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 ">

                            <!-- Opciones dinámicas que se mostrarán al hacer clic -->
                            <option v-for="categoria in categorias" :key="categoria.id" :value="categoria">
                                {{ categoria }}
                            </option>
                        </select>
                    </div>

                    <div class="w-1/3 ">
                        <label class="block text-sm font-medium text-gray-700">
                            Latitud
                        </label>

                        <input type="text" v-model="form.lat" id="lat"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>

                    </div>

                    <div class="w-1/3 text-">
                        <label class="block text-sm font-medium text-gray-700">
                            Longitud
                        </label>
                        <input type="text" v-model="form.lng" id="lng"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                            required>
                    </div>

                </div>

                <!-- Mostrar la imagen actual si existe -->
                <div v-if="recommendation.image" class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Imagen Actual</label>
                    <img :src="`/storage/${recommendation.image}`" alt="Current Image"
                        class="w-32 h-32 object-cover rounded-md mt-2">
                </div>

                <!-- Campo para subir una nueva imagen -->
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Cambiar
                        Imagen</label>
                    <input type="file" id="image" @change="handleImageChange"
                        class="mt-1 block w-full text-gray-700">
                    <p v-if="newImage" class="text-sm text-gray-600 mt-2">Nueva imagen seleccionada: {{ newImage.name }}
                    </p>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
