<script setup>
import InputError from '@/Components/InputError.vue'
import Label from '@/Components/Label.vue'
import Button from '@/Components/Button.vue'
import Input from '@/Components/Input.vue'
import { Link, useForm, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
})

const user = usePage().props.auth.user

const form = useForm({
    name: user.name,
    email: user.email,
    about: user.about || '', // Inicializar con una cadena vacía si no hay valor
    profile_picture: null, // Añadimos la propiedad para la imagen de perfil
})

const profilePicture = ref(null) // Referencia para el input de imagen

// Función para manejar la selección de la imagen
function handleProfilePictureChange(event) {
    form.profile_picture = event.target.files[0]
}

// Función para enviar el formulario
function submitForm() {
    const data = new FormData();
    data.append('name', form.name);
    data.append('email', form.email);
    data.append('about', form.about);

    if (form.profile_picture) {
        data.append('profile_picture', form.profile_picture);
    }

    form.post(route('profile.update'), {
        preserveScroll: true,
        onSuccess: () => profilePicture.value = null // Reseteamos el input de la imagen si es necesario
    });
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Profile Information
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="submitForm" class="mt-6 space-y-6" enctype="multipart/form-data">
            <div>
                <Label for="name" value="Name" />

                <Input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <Label for="email" value="Email" />

                <Input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="email" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <Label for="about" value="Sobre ti" />
                <textarea id="about" rows="5" class="mt-1 block w-full" v-model="form.about" required
                    autocomplete="about"></textarea>
                <InputError class="mt-2" :message="form.errors.about" />
            </div>

            <div>
                <Label for="profile_picture" value="Profile Picture" />

                <input id="profile_picture" type="file" class="mt-1 block w-full" ref="profilePicture"
                    @change="handleProfilePictureChange" />

                <InputError class="mt-2" :message="form.errors.profile_picture" />
            </div>

            <div v-if="props.mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    Your email address is unverified.
                    <Link :href="route('verification.send')" method="post" as="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Click here to re-send the verification email.
                    </Link>
                </p>

                <div v-show="props.status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <Button class="!bg-black" :disabled="form.processing">Save</Button>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>