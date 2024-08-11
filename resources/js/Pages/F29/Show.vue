<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { ref } from 'vue';
import Vue3Html2pdf from 'vue3-html2pdf';

defineProps({
    form29s: Array
});

const html2Pdf = ref(null);

function showF29() {
    if (html2Pdf.value) {
        html2Pdf.value.generatePdf();
    }
}

function sendF29(){
    
}

</script>
<template>
        <AuthenticatedLayout title="Empresa">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                F29 - Lista
            </h2>
        </template>

        <div class="space-y-6">
            <div class="p-6 overflow-hidden bg-white dark:bg-rounded-md shadow-md dark:bg-dark-eval-1">
                <div class="w-full">
                    <div class="bg-white dark:bg-gray-800 px-4">
                        <div class="w-full">
                            <div class="bg-white dark:bg-gray-900  py-4 md:py-7 px-4 md:px-8 xl:px-10">
                                <div class="sm:flex items-right justify-end">
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
                                                Nombre empresa
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Total
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                PPM
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                PPM 2
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Im. trabajadores
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Im. 2da categoría
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Fecha
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 dark:text-white dark:bg-black uppercase tracking-wider">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tr class="h-3"></tr>
                                        <tbody>
                                            <tr v-for="(form29,index) in form29s.data" :key="form29.id" class="focus:outline-none h-16 border border-gray-100 dark:border-gray-600 rounded pb-2 table-row">
                                                <td class="">
                                                    <div class="flex items-center pl-5">
                                                        <p class="text-base font-medium leading-none text-gray-700 dark:text-white mr-2">{{ form29.id }}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center">
                                                        <p class="text-sm leading-none text-gray-600 dark:text-gray-200  ml-2">{{ form29.company.name }}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center">
                                                        <p class="text-sm leading-none text-gray-600 dark:text-gray-200  ml-2">{{ form29.total_amount }}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center">
                                                        <p class="text-sm leading-none text-gray-600 dark:text-gray-200  ml-2">{{ form29.ppm }}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center">
                                                        <p class="text-sm leading-none text-gray-600 dark:text-gray-200  ml-2">{{ form29.ppm2 }}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center">
                                                        <p class="text-sm leading-none text-gray-600 dark:text-gray-200  ml-2">{{ form29.impuesto_unico_trabajadores }}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center">
                                                        <p class="text-sm leading-none text-gray-600 dark:text-gray-200  ml-2">{{ form29.impuesto_2da_categoria }}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center">
                                                        <p class="text-sm leading-none text-gray-600 dark:text-gray-200  ml-2">{{ form29.created_at }}</p>
                                                    </div>
                                                </td>
                                                <td class="pl-4">
                                                    <button @click="deleteCompany(company.id)" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 dark:text-gray-200 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 dark:hover:bg-gray-700 dark:bg-gray-800 focus:outline-none mr-2">Eliminar</button>
                                                    <button @click="showF29" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 dark:text-gray-200 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 dark:hover:bg-gray-700 dark:bg-gray-800 focus:outline-none mr-2">Ver</button>
                                                    <button @click="sendF29" class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 dark:text-gray-200 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 dark:hover:bg-gray-700 dark:bg-gray-800 focus:outline-none">Enviar</button>
                                                </td>
                                            </tr>
                                            <tr class="h-3">
                                                <td colspan="5"></td>
                                            </tr>
                                            <tr v-if="form29s.length === 0">
                                                <td class="px-6 py-4 border-t" colspan="4">No Additionals found.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <Pagination class="mt-6" :links="form29s.links" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
    <vue3-html2pdf
            :show-layout="false"
            :float-layout="true"
            :enable-download="true"
            :preview-modal="true"
            :paginate-elements-by-height="1400"
            filename="dpf"
            :pdf-quality="2"
            :manual-pagination="false"
            pdf-format="legal"
            pdf-orientation="portrait"
            pdf-content-width="800px"
            ref="html2Pdf"
        >
        <template  v-slot:pdf-content>
            <h1>Hola pdf preview</h1>
        </template>
    </vue3-html2pdf>
</template>