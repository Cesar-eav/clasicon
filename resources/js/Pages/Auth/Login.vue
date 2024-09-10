<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import { MailIcon, LockClosedIcon, LoginIcon } from '@heroicons/vue/outline'
import InputIconWrapper from '@/Components/InputIconWrapper.vue'
import Button from '@/Components/Button.vue'
import Checkbox from '@/Components/Checkbox.vue'
import GuestLayout from '@/Layouts/Guest.vue'
import Input from '@/Components/Input.vue'
import Label from '@/Components/Label.vue'
import ValidationErrors from '@/Components/ValidationErrors.vue'

defineProps({
    canResetPassword: Boolean,
    status: String,
})

const form = useForm({
    email: '',
    password: '',
    remember: false
})

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    })
}
</script>

<template>
    <GuestLayout title="Log in">
        <div class="flex flex-col md:flex-row md:justify-between items-center w-full md:space-x-10 p-6 md:p-10 h-screen md:h-auto">
            <!-- Sección del logo: Ajustado en móvil y escritorio -->
            <div class="hidden md:flex md:flex-col md:justify-center md:w-1/2 md:h-full space-y-4 md:space-y-6">
                <Link :href="route('welcome')" class="inline-flex items-center gap-2">
                    <img src="/storage/Logo.png" class="w-32 h-auto md:w-48" alt="Logo Clasicon" />
                </Link>
                <h1 class="text-3xl font-bold text-gray-800">Bienvenido de nuevo a Clasicon</h1>
                <p class="text-gray-600 text-base">Inicia sesión y sigue compartiendo tus recomendaciones.</p>
            </div>

            <!-- Sección del formulario: Más ancho que largo y centrado en escritorio -->
            <div class="w-full md:w-1/2 bg-white p-4 md:p-8 shadow-lg rounded-lg md:max-w-lg md:h-auto md:self-center md:mx-auto">
                <ValidationErrors class="mb-4" />

                <form @submit.prevent="submit" class="space-y-4">
                    <div class="space-y-2">
                        <Label for="email" value="Email" />
                        <InputIconWrapper>
                            <template #icon>
                                <MailIcon aria-hidden="true" class="w-5 h-5" />
                            </template>
                            <Input withIcon id="email" type="email" class="block w-full" placeholder="Email" v-model="form.email" required autofocus autocomplete="username" />
                        </InputIconWrapper>
                    </div>

                    <div class="space-y-2">
                        <Label for="password" value="Password" />
                        <InputIconWrapper>
                            <template #icon>
                                <LockClosedIcon aria-hidden="true" class="w-5 h-5" />
                            </template>
                            <Input withIcon id="password" type="password" class="block w-full" placeholder="Password" v-model="form.password" required autocomplete="current-password" />
                        </InputIconWrapper>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                        </label>

                        <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-blue-500 hover:underline">
                            ¿Olvidaste tu contraseña?
                        </Link>
                    </div>

                    <div>
                        <Button class="justify-center gap-2 w-full !bg-black" :disabled="form.processing" v-slot="{iconSizeClasses}">
                            <LoginIcon aria-hidden="true" :class="iconSizeClasses" />
                            <span>Log in</span>
                        </Button>
                    </div>

                    <p class="text-sm text-gray-600 text-center md:text-left">
                        ¿Aún no tienes una cuenta?
                        <Link :href="route('register')" class="text-blue-500 hover:underline">
                            Registrate
                        </Link>
                    </p>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>
