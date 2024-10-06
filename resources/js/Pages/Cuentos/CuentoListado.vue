<script setup lang="ts">
import { ref } from 'vue';
import { Cuento } from '@/types/cuento';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps, watch } from 'vue';
import debounce from 'lodash.debounce';
import axios from 'axios';
import { Breadcrumb } from '@/types/breadcrumb';

const props = defineProps({
    cuentos: Array<Cuento>,
    breadcrumbs: Array<Breadcrumb>,
});

let searchValue = ref('');
let searchMessage = "No se encontraron registros...";
let filteredCuentos = ref<Array<Cuento>>(props.cuentos);
let isLoading = ref(false);
let showModal = ref(false);



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

</script>

<template>
    <AppLayout>
        <div>

            <!-- INICIO: Barra de busqueda -->
            <div class="flex justify-between">
                <input type="text" v-model="searchValue"
                    class="transition duration-100 rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-200 w-72"
                    placeholder="Buscar cuento...">
            </div>
            <!-- FIN: Barra de busqueda -->


            <!-- INICIO: Listado de cuentos -->
            <div class="m-5" v-if="filteredCuentos.length > 0">
                <table class="table-auto min-w-full divide-y divide-gray-300 bg-indigo-500 shadow-md rounded-md">
                    <thead class="text-white">
                        <tr class="">
                            <th scope="col" class="px-5 py-4 text-left text-xs font-medium uppercase">Id</th>
                            <th scope="col" class="px-5 py-4 text-left text-xs font-medium uppercase">Titulo del cuento
                            </th>
                            <th scope="col" class="px-5 py-4 text-left text-xs font-medium uppercase">Contenido</th>
                            <th scope="col" class="px-5 py-4 text-left text-xs font-medium uppercase">Dificultad</th>
                            <th scope="col" class="px-5 py-4 text-left text-xs font-medium uppercase">
                                <span>Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300 bg-gray-100">
                        <tr v-for="cuento in filteredCuentos" :key="cuento.id" class="even:bg-gray-100/10 odd:bg-white">
                            <td class="px-5 py-3 text-left text-sm"> {{ cuento.id }} </td>
                            <td class="px-5 py-3 text-left text-sm">{{ cuento.titulo }}</td>
                            <td class="px-5 py-3 text-left text-sm">{{ cuento.contenido.length > 30 ?
                                cuento.contenido.substring(0, 50) + "..." : cuento.contenido }}</td>
                            <td class="px-5 py-3 text-left text-sm">
                                <span class="badge" :class="{'dificultad-baja': cuento.dificultad === 'baja', 'dificultad-media': cuento.dificultad === 'media', 'dificultad-alta': cuento.dificultad === 'alta'}">
                                    {{ cuento.dificultad }}
                                </span>
                            </td>

                            <td class="px-5 py-3 text-left text-sm">
                                <div class="flex space-x-2">
                                    VER
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
