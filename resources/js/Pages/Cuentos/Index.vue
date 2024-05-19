<script setup lang="ts">

import { ref } from 'vue';
import { Cuento } from '@/types/cuento';
import Separator from '@/Components/Separator.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    cuentos: {
        type: Array<Cuento>,
        required: true
    },
});

const createCuento = () => {
    router.get('/cuento/create');
}

function deleteCuento(id: number) {
    router.delete(`/cuento/${id}`);
}

const editCuento = (id: number) => {
    router.get(`/cuento/${id}/edit`);
}

</script>

<template>
    <AppLayout title="Cuentos">
        <div>
            <div class="p-5">
                <section class="flex content-end justify-between">
                    <h1>Listado de cuentos</h1>
                    <form @submit.prevent="createCuento">
                        <button class="border-2 p-2 rounded-md">
                            Crear nuevo cuento
                        </button>
                    </form>
                </section>
                <Separator />
            </div>
            <!-- IN: Listado de cuentos -->
            <div class="p-5 border-2 m-5 rounded-md">
                <table class="min-w-full divide-y divide-gray-300 overflow-x-auto">
                    <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Id</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Titulo del cuento</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Contenido</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                <span>Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="cuento in cuentos" :key="cuento.id">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ cuento.id }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ cuento.titulo }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ cuento.contenido.substring(0,40) + "..." }}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                <div class="flex space-x-2">
                                    <!-- IN: Formulario editar cuento -->
                                    <form @submit.prevent="editCuento(cuento.id)">
                                        <button>
                                            Editar
                                        </button>
                                    </form>
                                    <!-- END: Formulario editar cuento -->

                                    <!-- IN: Formulario para eliminar cuento -->
                                    <form @submit.prevent="deleteCuento(cuento.id)">
                                        <button>
                                            Eliminar
                                        </button>
                                    </form>
                                    <!-- END: Formulario para eliminar cuento -->
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END: Listado de cuentos -->
        </div>
    </AppLayout>
</template>
