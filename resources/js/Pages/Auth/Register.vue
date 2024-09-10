<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import { UserIcon, MailIcon, LockClosedIcon, UserAddIcon, IdentificationIcon } from '@heroicons/vue/outline'
import GuestLayout from '@/Layouts/Guest.vue'
import InputIconWrapper from '@/Components/InputIconWrapper.vue'
import Input from '@/Components/Input.vue'
import Label from '@/Components/Label.vue'
import ValidationErrors from '@/Components/ValidationErrors.vue'
import Button from '@/Components/Button.vue'

const form = useForm({
    name: '',
    email: '',
    about: '',
    password: '',
    password_confirmation: '',
    terms: false,
})

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    })
}
</script>

<template>
    <GuestLayout title="Register">
        <div
            class="flex flex-col md:flex-row md:justify-between items-center md:items-center w-full md:space-x-10 p-6 md:p-10 h-screen md:h-auto">
            
            <!-- Sección del logo y título: Alineado a la izquierda en escritorio -->
            <div class="hidden md:flex md:flex-col md:justify-center md:w-1/2 md:h-full space-y-4 md:space-y-6">
                <Link :href="user ? route('dashboard') : route('welcome')" class="inline-flex items-center gap-2">
                    <img src="/storage/Logo.png" class="w-32 h-auto md:w-60" alt="Logo Clasicon" />
                </Link>
                <h1 class="text-3xl font-bold text-gray-800">CLASICON.COM</h1>
                <p class="text-gray-600 text-base">Crea tu cuenta y únete a la comunidad.</p>
            </div>

            <!-- Sección del formulario: Más ancho que largo y centrado en escritorio -->
            <div class="w-full md:w-2/3 bg-white p-4 md:p-8 shadow-lg rounded-lg md:max-w-lg md:h-auto md:self-center md:mx-auto">
                <ValidationErrors class="mb-4" />

                <form @submit.prevent="submit" class="space-y-4">
                    <div class="space-y-2">
                        <Label for="name" value="Nombre" />
                        <InputIconWrapper>
                            <template #icon>
                                <UserIcon aria-hidden="true" class="w-5 h-5" />
                            </template>
                            <Input withIcon id="name" type="text" placeholder="Nombre" class="block w-full" v-model="form.name" required autofocus autocomplete="name" />
                        </InputIconWrapper>
                    </div>

                    <div class="space-y-2">
                        <Label for="email" value="Email" />
                        <InputIconWrapper>
                            <template #icon>
                                <MailIcon aria-hidden="true" class="w-5 h-5" />
                            </template>
                            <Input withIcon id="email" type="email" class="block w-full" placeholder="Email" v-model="form.email" required autocomplete="username" />
                        </InputIconWrapper>
                    </div>

                    <div class="space-y-2">
                        <Label for="password" value="Password" />
                        <InputIconWrapper>
                            <template #icon>
                                <LockClosedIcon aria-hidden="true" class="w-5 h-5" />
                            </template>
                            <Input withIcon id="password" type="password" class="block w-full" placeholder="Password" v-model="form.password" required autocomplete="new-password" />
                        </InputIconWrapper>
                    </div>

                    <div class="space-y-2">
                        <Label for="password_confirmation" value="Confirmar Password" />
                        <InputIconWrapper>
                            <template #icon>
                                <LockClosedIcon aria-hidden="true" class="w-5 h-5" />
                            </template>
                            <Input withIcon id="password_confirmation" type="password" class="block w-full" placeholder="Confirmar Password" v-model="form.password_confirmation" required autocomplete="new-password" />
                        </InputIconWrapper>
                    </div>

                    <div>
                        <Button class="justify-center gap-2 w-full !bg-black" :disabled="form.processing" v-slot="{ iconSizeClasses }">
                            <UserAddIcon aria-hidden="true" :class="iconSizeClasses" />
                            <span>Registrarse</span>
                        </Button>
                    </div>

                    <p class="text-sm text-gray-600 text-center md:text-left">
                        ¿Ya tienes una cuenta?
                        <Link :href="route('login')" class="text-blue-500 hover:underline">
                            Login
                        </Link>
                    </p>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>
