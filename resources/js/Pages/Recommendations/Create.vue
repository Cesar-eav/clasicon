<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faAdd, faAddressBook, faBook, faFilm, faTv, faGamepad, faMusic, faVideo } from '@fortawesome/free-solid-svg-icons'

// Estado para mostrar u ocultar el formulario y para la categoría seleccionada
const selectedCategory = ref(null)

// Formulario para crear una nueva recomendación
const form = useForm({
    title: '',
    description: '',
    category: '',
    image: null,  // Añadir este campo para la imagen
    tags: '',  // Añadir este campo para las etiquetas
})

// Función para seleccionar la categoría
function selectCategory(category) {
    console.log("CATEGORIA ", category )
    selectedCategory.value = category
    form.category = category
}

const translateCategory = (categoryName) => {
    const translations = {
        book: 'Libro',
        movie: 'Película',
        game: 'Juego',
        serie: 'Serie',
        music: 'Música',
        video: 'Video',
        documentary : 'Documental',
        podcast: 'Podcast',
        destination: 'Destino'
    };
    return translations[categoryName] || categoryName;
};
// Función para manejar la selección de la imagen
function handleImageChange(event) {
    form.image = event.target.files[0]  // Asignar la imagen seleccionada al formulario
}

// Función para enviar el formulario
function submitForm() {
    const formData = new FormData()
    formData.append('title', form.title)
    formData.append('description', form.description)
    formData.append('category', form.category)
    formData.append('image', form.image)  // Añadir la imagen al FormData
    formData.append('tags', form.tags)  // Añadir las etiquetas al FormData

    form.post(route('recommendations.store'), {
        onSuccess: () => {
            form.reset()
            selectedCategory.value = null
        },
        data: formData,
        forceFormData: true,  // Asegura que los datos se envían como FormData
    })
}

// Función para volver a la selección de categorías
function goBack() {
    selectedCategory.value = null
}

const getPronoun = (category) => {
  const feminineCategories = ['Película', 'Serie', 'Música', 'Documental', 'Podcast'];
  const translatedCategory = translateCategory(category); // Asegúrate de que la categoría esté traducida
  return feminineCategories.includes(translatedCategory) ? 'la' : 'lo';
};

const getPronoun2 = (category) => {
  const feminineCategories = ['Película', 'Serie', 'Música'];
  const translatedCategory = translateCategory(category); // Asegúrate de que la categoría esté traducida
  return feminineCategories.includes(translatedCategory) ? 'de la' : 'del';
};
</script>

<template>
    <AuthenticatedLayout title="Nueva Recomendación">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight mt-28">¿Qué quieres recomendar hoy?</h2>
        </template>

        <!-- Si no se ha seleccionado una categoría, muestra los íconos -->
        <div v-if="!selectedCategory" class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md text-center">
            <p class="text-lg mb-4">Selecciona una categoría:</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div @click="selectCategory('book')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'book']"
                        class="text-blue-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Libros</p>
                </div>
                <div @click="selectCategory('movie')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'film']"
                        class="text-green-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Películas</p>
                </div>
                <div @click="selectCategory('serie')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'tv']" class="text-red-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Series</p>
                </div>
                <div @click="selectCategory('game')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'gamepad']"
                        class="text-purple-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Juegos</p>
                </div>
                <div @click="selectCategory('music')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'music']"
                        class="text-yellow-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Música</p>
                </div>

                <!-- Nueva categoría: Videos -->
                <div @click="selectCategory('video')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'circle-play']"
                        class="text-pink-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Videos</p>
                </div>
                <!-- Nueva categoría: Destinos Turísticos -->
                <div @click="selectCategory('destination')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'location-dot']"
                        class="text-orange-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Destinos Turísticos</p>
                </div>
                <!-- Otras posibles categorías -->
                <div @click="selectCategory('documentary')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'file-video']"
                        class="text-teal-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Documentales</p>
                </div>
                <div @click="selectCategory('podcast')" class="cursor-pointer text-center">
                    <font-awesome-icon :icon="['fas', 'podcast']"
                        class="text-purple-500 h-16 w-16 mx-auto"></font-awesome-icon>
                    <p class="mt-2 text-sm">Podcasts</p>
                </div>
            </div>
        </div>

        <!-- Si se ha seleccionado una categoría, muestra el formulario -->
        <div v-else class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-semibold">  {{ translateCategory(selectedCategory) }}</h3>
                <button @click="goBack" class="bg-gray-600 text-white px-4 py-2 rounded-md">Volver</button>
            </div>
            <form @submit.prevent="submitForm" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                    <input type="text" v-model="form.title" id="title"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300"
                        required>
                </div>

                <div class="mb-4">
                    
                    <label for="description" class="block text-sm font-bold text-gray-900 dark:text-gray-300 ">
                    ¿Qué te gustó {{ getPronoun2(selectedCategory) }} {{translateCategory(selectedCategory)}}?
                </label>                                        
                   <label>
                ¿Por qué <span>{{ getPronoun(selectedCategory) }}</span> recomendarías? Otra persona te lo agradecerá.
                </label>

                    


                    <textarea v-model="form.description" id="description" rows="4" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300"
                        maxlength="1000"></textarea>
                    <p class="text-sm text-right"
                        :class="{ 'text-red-500': form.description.length >= 950, 'text-gray-500': form.description.length < 950 }">
                        {{ 1000 - form.description.length }} caracteres restantes
                    </p>
                </div>

                <div class="mb-4">
                    <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Etiquetas
                        (Ejemplo:
                        terror, novela, politica, etc).</label>
                    <input type="text" v-model="form.tags" id="tags"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300">
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subir
                        Imagen</label>
                    <input type="file" id="image" @change="handleImageChange" required
                        class="mt-1 block w-full text-gray-500 dark:text-gray-400">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Guardar
                        Recomendación</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
