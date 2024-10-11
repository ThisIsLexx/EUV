<script setup lang="ts">
import { ref } from 'vue';
import { Cuento } from '@/types/cuento';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps, watch } from 'vue';
import debounce from 'lodash.debounce';
import axios from 'axios';
import { Breadcrumb } from '@/types/breadcrumb';
import { UserCircleIcon, ClipboardDocumentListIcon } from '@heroicons/vue/24/solid';

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
        <transition appear name="left-to-right">
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
                    <transition-group tag="ul" name="list">
                        <li href="#" v-for="cuento in filteredCuentos" :key="cuento.id"
                            class="ease-linear group flex justify-between my-1 bg-white rounded-lg border-2 border-gray-300 transition-all duration-300 transform hover:scale-[102%] ":class="{'hover:border-emerald-600': cuento.dificultad === 'baja', 'hover:border-yellow-600': cuento.dificultad === 'media', 'hover:border-orange-700': cuento.dificultad === 'alta'}" >
                            <div class="flex">
                                <!-- Color a la izquierda del contenedor -->
                                <div class="transition-all duration-300 ease-linear hidden sm:inline-block w-4 flex flex-shrink-0 rounded-l-md" :class="{'bg-emerald-500': cuento.dificultad === 'baja', 'bg-yellow-500': cuento.dificultad === 'media', 'bg-orange-600': cuento.dificultad === 'alta'}">
                                </div>

                                <!-- Texto de la card -->
                                <div class="pt-4 pb-6 px-4 flex flex-col">
                                    <h2 class="text-lg text-indigo-950 font-semibold">
                                        {{ cuento.titulo }}
                                    </h2>
                                    <p class=" font-normal text-sm text-gray-500">
                                        {{ cuento.contenido.length > 30 ? cuento.contenido.substring(0, 200) + "...":
                                            cuento.contenido }}
                                    </p>
                                </div>
                            </div>

                            <!-- Etiqueta de dificultad cuando la pantalla es mayor a sm -->
                            <div
                                class="m-4 py-1 px-2 h-fit rounded-full text-white text-xs font-medium self-start" :class="{'bg-emerald-500': cuento.dificultad === 'baja', 'bg-yellow-500': cuento.dificultad === 'media', 'bg-orange-600': cuento.dificultad === 'alta'}">
                                {{ cuento.dificultad }}
                            </div>
                        </li>
                    </transition-group>
                </div>
                <div v-else class="w-full h-[200px] flex flex-col items-center justify-center">
                    <ClipboardDocumentListIcon class="h-16 w-16 text-gray-500 mb-4" />
                    <p class="text-lg text-center text-gray-500">{{ searchMessage }}</p>
                </div>
            </div>
        </transition>
    </AppLayout>
</template>

<style scoped>
.list-move, /* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
  position: absolute;
}
</style>
