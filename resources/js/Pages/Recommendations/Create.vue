<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'


// Estado para mostrar u ocultar el formulario y para la categoría seleccionada
const selectedCategory = ref(null)

// Formulario para crear una nueva recomendación
const form = useForm({
    title: '',
    ciudad:'',
    lat:'',
    lng:'',
    enlace:'',
    autor:'',
    description: '',
    category: '',
    image: null,  // Añadir este campo para la imagen
    tags: '',  // Añadir este campo para las etiquetas
})

// Función para seleccionar la categoría
function selectCategory(category) {
    console.log("CATEGORIA SELECCIONADA EN VUE: ", category)
    selectedCategory.value = category
    form.category = category
}

const translateCategory = (categoryName) => {
    const translations = {
        nature: 'Naturaleza',
        movie: 'Película',
        game: 'Juego',
        serie: 'Serie',
        music: 'Música',
        video: 'Video',
        documentary: 'Documental',
        podcast: 'Podcast',
        destination: 'Destino',
        monument: 'Monumentos',
        streetart: 'StreetArt',
        architecture: 'Arquitectura',
        culture: 'Cultura',
        museum: 'Museos',
        picada: 'Picadas'
    };
    return translations[categoryName] || categoryName;
};
// Función para manejar la selección de la imagen
function handleImageChange(event) {
    console.log("IMAGEN SELECCIONADA EN VUE: ", event.target.files[0])
    form.image = event.target.files[0]  // Asignar la imagen seleccionada al formulario
}

// Función para enviar el formulario
function submitForm() {
    console.log("INICIANDO SUBMIT DEL FORMULARIO EN VUE")
    const formData = new FormData()
    formData.append('title', form.title)
    formData.append('ciudad', form.ciudad)
    formData.append('enlace', form.enlace)
    formData.append('autor', form.autor)
    formData.append('lng', form.lng)
    formData.append('lat', form.lat)
    formData.append('description', form.description)
    formData.append('category', form.category)
    formData.append('image', form.image)  // Añadir la imagen al FormData
    formData.append('tags', form.tags)  // Añadir las etiquetas al FormData

    console.log("DATOS DEL FORMULARIO ANTES DE ENVIAR (FormData):", Object.fromEntries(formData.entries()))

    form.post(route('recommendations.store'), {
        onSuccess: () => {
            form.reset()
            selectedCategory.value = null
            console.log("GUARDADO EXITOSO EN VUE")
        },
        onError: (errors) => {
            console.error("ERRORES RECIBIDOS DEL SERVIDOR EN VUE:", errors)
        },
        onFinish: () => {
            console.log("FINALIZADO EL PROCESO DE ENVÍO DEL FORMULARIO EN VUE")
        },
        data: formData,
        forceFormData: true,  // Asegura que los datos se envían como FormData
    })
}

// Función para volver a la selección de categorías
function goBack() {
    selectedCategory.value = null
}


</script>

<template>
    <AuthenticatedLayout title="Nueva Recomendación">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight mt-28">¿Qué quieres recomendar hoy?</h2>
        </template>

        <!-- Si no se ha seleccionado una categoría, muestra los íconos -->
        <div v-if="!selectedCategory" class="p-6 bg-white  rounded-md shadow-md text-center">
            <p class="text-lg mb-4">Selecciona una categoría:</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div @click="selectCategory('nature')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'leaf']"
                        class="text-blue-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Naturaleza</p>
                </div>
                <div @click="selectCategory('monument')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'archway']"
                        class="text-green-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Monumentos</p>
                </div>
                <div @click="selectCategory('streetart')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'spray-can']"
                        class="text-red-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Street Art</p>
                </div>
                <div @click="selectCategory('architecture')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'building']"
                        class="text-purple-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Arquitectura</p>
                </div>
                <div @click="selectCategory('culture')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'palette']"
                        class="text-yellow-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Cultura</p>
                </div>

                <div @click="selectCategory('museum')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'museum']"
                        class="text-pink-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Museos</p>
                </div>
                <div @click="selectCategory('picada')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'utensils']"
                        class="text-orange-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Picadas</p>
                </div>

            </div>
        </div>

        <!-- Si se ha seleccionado una categoría, muestra el formulario -->
        <div v-else class="p-6 bg-white  rounded-md shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-semibold"> {{ translateCategory(selectedCategory) }}</h3>
                <button @click="goBack" class="bg-gray-600 text-white px-4 py-2 rounded-md">Volver</button>
            </div>
            <form @submit.prevent="submitForm" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 ">Título</label>
                    <input type="text" v-model="form.title" id="title"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  "
                        required>
                </div>
                <div class="flex mb-4">
                    <input type="text" v-model="form.ciudad" id="ciudad"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  "
                        placeholder="Ciudad" required>

                    <input type="text" v-model="form.lat" id="lat"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  "
                        placeholder="Latitud">

                    <input type="text" v-model="form.lng" id="lng"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  "
                        placeholder="Longitud">
                </div>
                <label for="title" class="block text-sm font-medium text-gray-700 ">Opcionales</label>
                <div  class="flex mb-4">
                    

                    <input type="text" v-model="form.autor" id="autor"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  "
                        placeholder="Autor">

                        <input type="text" v-model="form.enlace" id="enlace"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  "
                        placeholder="Enlace">
                
                </div>


                <div class="mb-4">

                    <label for="description" class="block text-sm font-bold text-gray-900  ">
                        Descripción
                    </label>

                    <textarea required v-model="form.description" id="description" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  "
                        maxlength="1000"></textarea>
                    <p class="text-sm text-right"
                        :class="{ 'text-red-500': form.description.length >= 950, 'text-gray-500': form.description.length < 950 }">
                        {{ 1000 - form.description.length }} caracteres restantes
                    </p>
                </div>

                <div class="mb-4">
                    <label for="tags" class="block text-sm font-medium text-gray-700 ">Etiquetas
                        (Ejemplo:
                        diversion, paseo, mural, valparaíso).</label>
                    <input type="text" v-model="form.tags" id="tags"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500  ">
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 ">Subir
                        Imagen</label>
                    <input required type="file" id="image" @change="handleImageChange"
                        class="mt-1 block w-full text-gray-500 ">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Guardar
                        Recomendación</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
