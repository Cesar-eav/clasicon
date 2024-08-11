<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  companies: Array   
});

const open = ref(false);

const form = useForm({
  id: null,
  name: null,
  rut: null,
  email: null,
  phone: null,
  r_legal: null
});

function openModal(company = null, type = 'create') {
  if (type === 'edit' && company !== null) {
    form.id = company.id;
    form.name = company.name;
    form.rut = company.rut;
    form.email = company.email;
    form.phone = company.phone;
    form.r_legal = company.r_legal;
  } else {
    form.reset();
  }
  open.value = true;
}

function closeModal() {
  open.value = false;
}

function saveCompany() {
  if (form.id) {
    form.put(route('company.update', form.id), {
      onSuccess: () => {
        closeModal();
      }
    });
  } else {
    form.post(route('company.store'), {
      onSuccess: () => {
        closeModal();
      }
    });
  }
}

function deleteCompany(id) {
  form.delete(route('company.delete', id));
}
</script>
<template>
    <AuthenticatedLayout title="Empresa">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Empresas
            </h2>
        </template>

        <div class="space-y-6">
            <div class="p-6 overflow-hidden bg-white dark:bg-rounded-md shadow-md dark:bg-dark-eval-1">
                <div class="w-full">
                    <div class="bg-white dark:bg-gray-800 px-4">
                        <div class="w-full">
                            <div class="bg-white dark:bg-gray-900  py-4 md:py-7 px-4 md:px-8 xl:px-10">
                                <div class="sm:flex items-right justify-end">
                                    <button @click="openModal(null,'create')" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-black hover:bg-gray-600 focus:outline-none rounded">
                                        <p class="text-sm font-medium leading-none text-white">Agregar Empresa</p>
                                    </button>
                                </div>
                                <div class="mt-7 overflow-x-auto">
                                    <table class="w-full whitespace-nowrap">
                                        <thead class="dark:bg-black">
                                        <tr class="focus:outline-none dark:text-white dark:bg-black h-16 rounded">
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Id
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Nombre
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Email
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Teléfono
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tr class="h-3"></tr>
                                        <tbody>
                                            <tr v-for="(company,index) in companies.data" :key="company.id" class="focus:outline-none h-16 border border-gray-100 dark:border-gray-600 rounded pb-2 table-row">
                                                <td class="">
                                                    <div class="flex items-center pl-5">
                                                        <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">{{ company.id }}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center">
                                                        <p class="text-sm leading-none text-gray-600 dark:text-gray-200  ml-2">{{ company.name }}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center">
                                                        <p class="text-sm leading-none text-gray-600 dark:text-gray-200  ml-2">{{ company.email }}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center">
                                                        <p class="text-sm leading-none text-gray-600 dark:text-gray-200  ml-2">{{ company.phone }}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-4">
                                                    <button @click="deleteCompany(company.id)" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 dark:text-gray-200 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 dark:hover:bg-gray-700 dark:bg-gray-800 focus:outline-none mr-2">Eliminar</button>
                                                    <button @click="openModal(company,'edit')" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 dark:text-gray-200 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 dark:hover:bg-gray-700 dark:bg-gray-800 focus:outline-none">Editar</button>
                                                </td>
                                            </tr>
                                            <tr class="h-3">
                                                <td colspan="5"></td>
                                            </tr>
                                            <tr v-if="companies.length === 0">
                                                <td class="px-6 py-4 border-t" colspan="4">No Additionals found.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <Pagination class="mt-6" :links="companies.links" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Modal :show="open">
            <div class="container mx-auto">
                <div class="relative py-8 px-5 md:px-10 bg-white dark:bg-gray-800 dark:border-gray-700 shadow-md rounded border border-gray-400">
                    <h1 class="text-gray-800 dark:text-white font-lg font-bold tracking-normal leading-tight mb-4">Agregar empresa</h1>
                    <label for="name" class="text-gray-800 dark:text-white text-sm font-bold leading-tight tracking-normal">Nombre</label>
                    <input id="name" v-model="form.name" class="mb-5 mt-2 text-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder-gray-200 dark:border-gray-700 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Luis" />
                    <label for="email2" class="text-gray-800 dark:text-white text-sm font-bold leading-tight tracking-normal">Email</label>
                    <div class="relative mb-5 mt-2">
                        <input id="email2" v-model="form.email" class="text-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder-gray-200 dark:border-gray-700 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="correo@correo.cl" />
                    </div>
                    <label for="expiry" class="text-gray-800 dark:text-white text-sm font-bold leading-tight tracking-normal">Rut</label>
                    <div class="relative mb-5 mt-2">
                        <input id="expiry" v-model="form.rut" class="text-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder-gray-200 dark:border-gray-700 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="12345678-9" />
                    </div>
                    <label for="cvc" class="text-gray-800 dark:text-white text-sm font-bold leading-tight tracking-normal">Télefono</label>
                    <div class="relative mb-5 mt-2">
                        <input id="cvc" v-model="form.phone" class="mb-8 text-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder-gray-200 dark:border-gray-700 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="+56995774088" />
                    </div>
                    <label for="cvc" class="text-gray-800 dark:text-white text-sm font-bold leading-tight tracking-normal">Representante legal</label>
                    <div class="relative mb-5 mt-2">
                        <input id="cvc" v-model="form.r_legal" class="mb-8 text-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder-gray-200 dark:border-gray-700 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Luis" />
                    </div>
                    <div class="flex items-center justify-start w-full">
                        <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-black rounded text-white px-8 py-2 text-sm" @click="saveCompany()">Agregar</button>
                        <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" @click="closeModal()">Cancel</button>
                    </div>
                    <button class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600" @click="closeModal()" aria-label="close modal" role="button">
                        <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>