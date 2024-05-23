<script setup lang="ts">
import { ref } from 'vue';
import { Cuento } from '@/types/cuento';
import Separator from '@/Components/Separator.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps, watch } from 'vue';
import debounce from 'lodash.debounce';
import axios from 'axios';
import Spinner from '@/Components/Custom/Spinner.vue';
import Button from '@/Components/Custom/Button.vue';
import Show from '@/Components/Custom/Show.vue';

// defineProps({
//     cuentos: {
//         type: Array<Cuento>,
//         required: true
//     },
// });

interface Props {
    cuentos: Array<Cuento>,
}

const props = defineProps<Props>();

let searchValue = ref('');
let searchMessage = "No se encontraron registros...";
let filteredCuentos = ref<Array<Cuento>>(props.cuentos);
let isLoading = ref(false);

const filtrarCuentoBusqueda = debounce(async (value: string) => {
    isLoading.value = true;
    try {
        const response = await axios.get('/api/cuentos', {
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
                        <Button message="Crear nuevo cuento" type="primary" />
                    </form>
                </section>
                <Separator />
                <!-- INICIO: Barra de busqueda -->
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <input type="text" v-model="searchValue" class="transition delay-150 ease-in-out border-2 p-2 rounded-md" placeholder="Buscar cuento...">
                    </div>
                </div>
                <!-- FIN: Barra de busqueda -->
            </div>
            <!-- INICIO: Listado de cuentos -->
            <div class="m-5" v-if="filteredCuentos.length > 0">
                <table class="table-auto min-w-full divide-y divide-gray-300 bg-gray-200 shadow-sm rounded-md">
                    <thead>
                        <tr class="">
                            <th scope="col" class="px-5 py-3 text-left text-xs font-medium uppercase">Id</th>
                            <th scope="col" class="px-5 py-3 text-left text-xs font-medium uppercase">Titulo del cuento</th>
                            <th scope="col" class="px-5 py-3 text-left text-xs font-medium uppercase">Contenido</th>
                            <th scope="col" class="px-5 py-3 text-left text-xs font-medium uppercase">
                                <span>Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        <tr v-for="cuento in filteredCuentos" :key="cuento.id">
                            <td class="px-5 py-3 text-left text-sm"> <Show route="cuento/{{ $cuento.id }}/show" :id="cuento.id" /></td>
                            <td class="px-5 py-3 text-left text-sm">{{ cuento.titulo }}</td>
                            <td class="px-5 py-3 text-left text-sm">{{ cuento.contenido.length > 30 ? cuento.contenido.substring(0,50)+"..." : cuento.contenido }}</td>
                            <td class="px-5 py-3 text-left text-sm">
                                <div class="flex space-x-2">
                                    <!-- INICIO: Formulario editar cuento -->
                                    <form @submit.prevent="editCuento(cuento.id)">
                                        <button class="text-sky-600 hover:text-sky-500">
                                            Editar
                                        </button>
                                    </form>
                                    <!-- END: Formulario editar cuento -->

                                    <!-- INICIO: Formulario para eliminar cuento -->
                                    <form @submit.prevent="deleteCuento(cuento.id)">
                                        <button class="text-red-600 hover:text-red-500">
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
            <div class="flex justify-center p-5 border-2 m-5 rounded-md shadow-sm" v-else>
                <Spinner v-if="isLoading" />
                <span v-else>{{ searchMessage }}</span>
            </div>
            <!-- END: Listado de cuentos -->
        </div>
    </AppLayout>
</template>
