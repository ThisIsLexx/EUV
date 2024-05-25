<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';
import debounce from 'lodash.debounce';
import { Cuento } from '@/types/cuento';
import { defineProps, watch } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Show from '@/Components/Custom/Show.vue';
import Separator from '@/Components/Separator.vue';
import Button from '@/Components/Custom/Button.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Spinner from '@/Components/Custom/Spinner.vue';
import { TrashIcon, PencilSquareIcon, ExclamationTriangleIcon } from '@heroicons/vue/24/outline';

import Modal from '@/Components/Custom/Modal.vue'

const emits = defineEmits(['closeModal']);

const props = defineProps({
    cuentos: Array<Cuento>,
});

let searchValue = ref('');
let searchMessage = "No se encontraron registros...";
let filteredCuentos = ref<Array<Cuento>>(props.cuentos);
let isLoading = ref(false);
let showModal = ref(false);

let cuentoEliminable = ref(null);

const filtrarCuentoBusqueda = debounce(async (value: string) => {
    isLoading.value = true;
    try {
        const response = await axios.get(route('cuento.filtrado-busqueda'), {
            params: {
                search: value
            }
        });
        filteredCuentos.value = response.data;
    } catch (error) {
        console.error('Error fetching cuentos:', error);
        searchMessage = "Error al buscar cuentos...";
    } finally {
        isLoading.value = false;
    }
}, 500);

watch(searchValue, (value) => {
    filtrarCuentoBusqueda(value);
});

function createCuento() {
    router.get('/cuento/create');
}

function deleteCuento(cuento: Cuento) {
    router.delete(route('cuento.destroy', cuento),
        {
            onSuccess: () => {
                showModal.value = false;
                filteredCuentos.value = props.cuentos;
            },
            onError: () => {
                console.log('Error al eliminar cuento');
            }
        }
    );
}

const editCuento = (id: number) => {
    router.get(`/cuento/${id}/edit`);
}
</script>

<template>
    <AppLayout title="Cuentos">
        <div>

            <!-- INICIO: Modal confirmación borrar cuento -->

            <Modal :showModal="showModal" size="lg" titulo="Eliminar cuento" @closeModal="showModal = false">
                <template v-slot:modal-content class="flex flex-col">
                    <div class="flex flex-col justify-center text-center items-center">
                        <ExclamationTriangleIcon class="w-16 h-16 text-orange-400 animate-pulse"/>
                        <span>
                            Esta acción eliminará de forma permanente el cuento <strong>"{{ cuentoEliminable.titulo }}"</strong>.
                        </span>
                        Este proceso es irreversible, desea continuar?
                    </div>
                </template>
                <template v-slot:action-button>
                    <button @click="deleteCuento(cuentoEliminable)" class="bg-indigo-500 hover:bg-indigo-500/90 text-white shadow-sm rounded-md px-2">
                        Eliminar cuento
                    </button>
                </template>
            </Modal>


            <!-- END: Modal confirmación borrar cuento -->

            <div class="p-5">
                <section class="flex content-end justify-between">
                    <h1>Listado de cuentos</h1>
                    <form @submit.prevent="createCuento">
                        <Button message="Crear nuevo cuento" type="submit" button="primary" />
                    </form>
                </section>
                <Separator />
                <!-- INICIO: Barra de busqueda -->
                <div class="flex justify-between mt-4">
                    <input type="text" v-model="searchValue"
                        class="transition duration-100 rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-200 w-72"
                        placeholder="Buscar cuento...">
                </div>
                <!-- FIN: Barra de busqueda -->
            </div>
            <!-- INICIO: Listado de cuentos -->
            <div class="m-5" v-if="filteredCuentos.length > 0">
                <table class="table-auto min-w-full divide-y divide-gray-300 bg-gray-200 shadow-md rounded-md">
                    <thead>
                        <tr class="">
                            <th scope="col" class="px-5 py-4 text-left text-xs font-medium uppercase">Id</th>
                            <th scope="col" class="px-5 py-4 text-left text-xs font-medium uppercase">Titulo del cuento
                            </th>
                            <th scope="col" class="px-5 py-4 text-left text-xs font-medium uppercase">Contenido</th>
                            <th scope="col" class="px-5 py-4 text-left text-xs font-medium uppercase">
                                <span>Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300 bg-gray-100">
                        <tr v-for="cuento in filteredCuentos" :key="cuento.id">
                            <td class="px-5 py-3 text-left text-sm">
                                <Show route="cuento/{{ $cuento.id }}/show" :id="cuento.id" />
                            </td>
                            <td class="px-5 py-3 text-left text-sm">{{ cuento.titulo }}</td>
                            <td class="px-5 py-3 text-left text-sm">{{ cuento.contenido.length > 30 ?
                                cuento.contenido.substring(0,50)+"..." : cuento.contenido }}</td>
                            <td class="px-5 py-3 text-left text-sm">
                                <div class="flex space-x-2">
                                    <!-- INICIO: Formulario editar cuento -->
                                    <form @submit.prevent="editCuento(cuento.id)">
                                        <button class="text-sky-600 hover:text-sky-500">
                                            <div class="flex content-end h-full">
                                                <PencilSquareIcon class="w-4 h-4" />
                                                <span>
                                                    Editar
                                                </span>
                                            </div>
                                        </button>
                                    </form>
                                    <!-- END: Formulario editar cuento -->

                                    <!-- INICIO: Formulario para eliminar cuento -->
                                    <button @click="showModal = true; cuentoEliminable = cuento" class="text-red-600 hover:text-red-500">
                                        <div class="flex content-end h-full">
                                            <TrashIcon class="w-4 h-4" />
                                            <span>
                                                Eliminar
                                            </span>
                                        </div>
                                    </button>
                                    <!-- END: Formulario para eliminar cuento -->
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-center p-5 border-2 m-5 rounded-md shadow-sm" v-else>
                <Spinner v-if="isLoading" />
                <span v-else>{{ searchMessage }}</span>
            </div>
            <!-- END: Listado de cuentos -->
        </div>
    </AppLayout>
</template>
