<script setup lang="ts">

import { ref, watch } from 'vue';
import debounce from 'lodash.debounce';
import { Curso } from '@/types/curso';
import { Cuento } from '@/types/cuento';
import { Puntaje } from '@/types/puntaje';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Breadcrumb } from '@/types/breadcrumb';
import Modal from '@/Components/Custom/Modal.vue';
import { PlayIcon } from '@heroicons/vue/20/solid';
import Separator from '@/Components/Separator.vue';
import Button from '@/Components/Custom/Button.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { UserCircleIcon, ClipboardDocumentListIcon } from '@heroicons/vue/24/solid';

const props = defineProps({
    curso: {
        type: Object as () => Curso,
        required: true,
    },
    breadcrumbs: {
        type: Array<Breadcrumb>,
        required: true,
    },
    asignaciones: {
        type: Array<Cuento>,
        required: true,
    },
    tutor: {
        required: true,
    },
    personas: {
        typew: Array<Object>,
        required: true,
        default: null,
    },
    cuentos: {
        type: Array<Cuento>,
        default: null,
    },
    puntajes: {
        type: Array<Puntaje>,
        default: null,
    }
});


let activeTab = ref('tablero');
let cuentoFilter = ref('');
let mostrarCuentos = ref(false);
let filteredCuentos = ref<Array<Cuento>>(props.cuentos);
let isLoading = ref(false);

function resolveCursoColor(color: string) {
    switch (color) {
        case 'blue':
            return 'bg-gradient-to-r from-sky-500 to-indigo-500';
        case 'emerald':
            return 'bg-gradient-to-r from-cyan-500 to-emerald-500';
        case 'red':
            return 'bg-gradient-to-r from-rose-500 to-red-500';
        case 'amber':
            return 'bg-gradient-to-r from-amber-500 to-yellow-500';
        case 'orange':
            return 'bg-gradient-to-r from-orange-500 to-yellow-500';
        case 'purple':
            return 'bg-gradient-to-r from-violet-500 to-purple-500';
        case 'gray':
            return 'bg-gradient-to-r from-gray-500 to-gray-800';
        case 'pink':
            return 'bg-gradient-to-r from-pink-500 to-rose-500';
        default:
            return 'bg-gradient-to-r from-cyan-500 to-emerald-500';
    }
}

function resolveClasificacion(clasificacion : string) {
    switch (clasificacion) {
        case 'baja':
            return 'bg-emerald-200 text-emerald-700';
        case 'media':
            return 'bg-yellow-200 text-yellow-700';
        case 'alta':
            return 'bg-red-200 text-red-700';
        default:
            return 'bg-emerald-200 text-emerald-700';
    }
}

const startGame = (cuento: number) => {
    router.get(route('curso.play', { cuento, curso: props.curso.id }));
}

watch(cuentoFilter, (value) => {
    filtrarCuentoBusqueda(value);
});

const filtrarCuentoBusqueda = debounce(async (value: string) => {
    isLoading.value = true;
    try {
        filteredCuentos.value = props.cuentos.filter((cuento: Cuento) => cuento.titulo.toLowerCase().includes(value.toLowerCase()));
    } catch (error) {
        console.error('Error fetching cuentos:', error);
    } finally {
        isLoading.value = false;
    }
}, 200);

let selectedCuentos = ref<Array<Cuento>>([]);

function Texts(cuento: number) {
    if (selectedCuentos.value.includes(props.cuentos.find((c) => c.id === cuento))) {
        selectedCuentos.value = selectedCuentos.value.filter((c) => c.id !== cuento);
    }
    else {
        selectedCuentos.value.push(props.cuentos.find((c) => c.id === cuento));
    }
}

const form = useForm({
    selectedCuentos: selectedCuentos,
});

function asignarCuentos() {
    form.selectedCuentos = selectedCuentos;
    form.post(route('curso.asignar', props.curso), {
        onSuccess: () => {
            mostrarCuentos.value = false;
            selectedCuentos.value = [];
            filteredCuentos.value = props.cuentos;
            form.reset();
            form.clearErrors();
        }
    });
}

function hasHighScore(asignacion: number) {
    if (props.puntajes && props.puntajes.find(p => p.cuento_id === props.asignaciones.find(a => a.id === asignacion).id))
        return true;
    return false
}

function getHighScore(asignacion: number) {
    const puntajes = props.puntajes.filter(p => p.cuento_id === asignacion);
    if (puntajes.length) {
        return Math.max(...puntajes.map(p => p.puntaje));
    }
    return 0;
}

</script>

<template>
    <Head :title="props.curso.titulo" />
    <AppLayout :breadcrumbs="props.breadcrumbs">

        <!-- BEGIN: Tabs de navegación -->
        <div class="flex w-full">
            <div class="flex border-b-2 border-gray-200 w-full">
                <div class="px-4 py-2 rounded-t-md text-sm transition-all ease-in-out duration-300 font-semibold  focus:outline-none cursor-pointer"
                :class="{ ' text-indigo-600 bg-gray-200':  activeTab === 'tablero' }"
                @click="activeTab = 'tablero'">
                    Tablero
                </div>
                <div class="px-4 py-2 rounded-t-md text-sm transition-all ease-in-out duration-300 font-semibold  focus:outline-none cursor-pointer"
                :class="{ ' text-indigo-600 bg-gray-200 ': activeTab === 'personas' }"
                @click="activeTab = 'personas'">
                    Personas
                </div>
            </div>
        </div>
        <!-- END: Tabs de navegación -->

        <Modal :showModal="mostrarCuentos" size="lg" titulo="Agregar asignaciones" @closeModal="mostrarCuentos = false; form.reset(); form.clearErrors(); selectedCuentos = []">
            <template v-slot:modal-content>
                <div class="p-5 w-full h-full">
                    <div>
                        <input type="text" v-model="cuentoFilter" placeholder="Buscar textos..."
                            class="transition duration-100 max-h-[32px] rounded-md border-gray-300 shadow-sm focus:ring-indigo-200 focus:border-indigo-200">
                    </div>
                    <Separator margin="mb-6 mt-2"/>
                    <div v-if="isLoading">
                        <div class="flex justify-center items-center w-full h-full">
                            <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-indigo-600"></div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="flex flex-col">
                            <span class="font-semibold text-xl">Textos disponibles <span v-if="form.errors.selectedCuentos" class="text-red-500 uppercase text-xl font-semibold animate-pulse">*</span></span>
                            <transition
                                enter-from-class="opacity-0"
                                enter-to-class="opacity-100"
                                enter-active-class="transition ease-out duration-300"
                                leave-active-class="transition ease-in duration-200"


                            >
                                <span v-if="form.errors.selectedCuentos" class="text-red-500 uppercase text-xs font-semibold">Necesitas seleccionar al menos un texto para asignarlo al curso!</span>
                            </transition>

                        </div>
                        <div v-if="filteredCuentos.length > 0" class="flex flex-col overflow-y-scroll h-[248px] px-5">
                            <div v-for="cuento in filteredCuentos" class="flex flex-col my-2" @click="Texts(cuento.id)">
                                <div class="flex justify-between group p-2 border items-center border-gray-200 rounded-md transition-all duration-300 ease-in-out cursor-pointer hover:border-indigo-500 hover:text-indigo-600"
                                    :class="{'border-indigo-500': selectedCuentos.some(c => c.id === cuento.id)}">
                                    <span>
                                        {{ cuento.titulo }} - Dificultad: {{ cuento.dificultad }}
                                    </span>
                                    <span class="h-5 w-5 bg-gray-300 rounded-full transition-all duration-300 ease-in-out group-hover:bg-indigo-400"
                                        :class="{'!bg-indigo-400': selectedCuentos.some(c => c.id === cuento.id)}"></span>
                                </div>
                            </div>
                        </div>
                        <div v-else class="w-full flex flex-col justify-center items-center p-10">
                            <ClipboardDocumentListIcon class="w-24 h-24 opacity-60"/>
                            <span class="text-gray-700 mt-4">
                                No hay textos disponibles para asignar en este momento.
                            </span>
                        </div>
                    </div>
                </div>
            </template>
            <template v-slot:action-button>
                <button @click="asignarCuentos()" class="bg-indigo-500 hover:bg-indigo-500/90 text-white shadow-sm rounded-md px-2">
                    Asignar textos
                </button>
            </template>

        </Modal>

        <div class="flex flex-col">
            <!-- INICIO: Index de curso -->
            <transition
                appear
                enter-from-class="opacity-0 scale-95"
                enter-to-class="opacity-100 scale-100"
                enter-active-class="transition ease-out duration-300"
            >
                <div v-if="activeTab === 'tablero'">
                     <div class="flex justify-center w-full">
                         <div class="my-4 w-5/6 md:w-4/6 lg:w-2/3 content-end text-white p-5 rounded-md min-h-[180px]"
                            :class="resolveCursoColor(props.curso.color)">
                             <div class="flex flex-col">
                                 <span class="font-semibold text-3xl">
                                     {{ props.curso.titulo }}
                                 </span>
                                 <span class="font-semibold text-xl">
                                     {{ props.curso.codigo }}
                                 </span>
                             </div>
                         </div>
                     </div>
                     <!-- BEGIN: Asignaciones del curso -->
                        <div class="flex justify-center w-full">
                            <div class="my-4 w-5/6 md:w-4/6 lg:w-2/3">
                                <div class="flex flex-col">
                                    <span class="font-medium text-3xl">
                                        <div class="flex justify-between">
                                            <span>
                                                Asignaciones
                                            </span>
                                            <div v-if="$page.props.auth.user.email === props.tutor[1] && props.asignaciones.length" class="text-sm">
                                                <Button type="button" @click="mostrarCuentos = true" message="Agregar asignación"/>
                                            </div>
                                            <!-- TODO: INFORMACIÓN EXTRA SOBRE COMO OBTENER PUNTAJES -->
                                            <!-- <div>
                                                <span class="bg-gray-200 rounded-full text-xs p-5" @click="asd = true; console.log(asd)">
                                                    ?
                                                </span>
                                            </div> -->
                                        </div>
                                        <Separator/>
                                    </span>
                                    <div v-if="props.asignaciones.length" class="flex flex-col w-full space-y-2">
                                        <div v-for="asignacion in props.asignaciones" :key="asignacion.id" @click="startGame(asignacion.id)"
                                            class="flex group justify-between p-2 border border-gray-200 rounded-md transition-all duration-300 ease-in-out cursor-pointer hover:border-indigo-500 ">
                                            <span class="flex justify-start items-center content-center w-full font-medium group-hover:text-indigo-600">
                                                <PlayIcon class="w-8 h-8 mr-2 opacity-70"/>
                                                {{ asignacion.titulo }}
                                            </span>
                                            <span class="flex group min-w-[298px] font-semibold items-center transition-all duration-300 ease-in-out justify-start border-l-2 px-5 hover:border-indigo-500 hover:bg-indigo-100 content-center text-sm">
                                                <span class="mr-1">
                                                    Mejor puntaje:
                                                </span>
                                                <span v-if="hasHighScore(asignacion.id)" class="group-hover:text-indigo-500 transition-all duration-300 ease-in-out">
                                                    {{ getHighScore(asignacion.id).toFixed(2) }} puntos
                                                </span>
                                                <span v-else class="group-hover:text-indigo-500 transition-all duration-300 ease-in-out">
                                                    Sin puntaje
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div v-else class="w-full flex flex-col justify-center items-center p-10">
                                        <ClipboardDocumentListIcon class="w-24 h-24 opacity-70"/>
                                        <span class="text-gray-700 mt-4">
                                            No hay asignaciones en este curso.
                                            <div v-if="$page.props.auth.user.email === props.tutor[1]" class="flex w-full justify-center mt-2">
                                                <Button type="button" @click="mostrarCuentos = true" message="Agregar asignación"/>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                     <!-- END: Asignaciones del curso -->
                </div>
            </transition>
            <!-- FIN: Index de curso -->

            <!-- INICIO: Index de personas -->
            <transition
                enter-from-class="opacity-0 scale-95"
                enter-to-class="opacity-100 scale-100"
                enter-active-class="transition ease-out duration-300"
            >
                <div v-if="activeTab === 'personas'">
                     <div class="flex justify-center w-full mt-10">
                         <div class="my-4 w-1/2 lg:w-2/3">
                             <div class="flex flex-col">
                                 <span class="font-medium text-3xl">
                                    Tutor del curso
                                    <Separator/>
                                    <span class="text-sm uppercase">
                                        <div class="flex justify-between p-5 border-b transition-all duration-200 border-gray-200 hover:border-indigo-600 hover:text-indigo-600">
                                                <span class="flex justify-start items-center content-center w-full font-semibold">
                                                    <UserCircleIcon class="w-8 h-8 mr-2 opacity-70"/>
                                                    {{ props.tutor[0] }}
                                                </span>
                                            </div>
                                    </span>
                                </span>
                                 <span class="font-medium text-3xl mt-10">
                                    Personas inscritas
                                    <Separator/>
                                    <span class="text-sm uppercase">
                                        <div v-if="props.personas != 0">
                                            <div v-for="persona in props.personas" :key="persona.id" class="flex justify-between p-5 border-b transition-all duration-200 border-gray-200 hover:border-indigo-600 hover:text-indigo-600">
                                                <span class="flex justify-start items-center content-center w-full font-semibold">
                                                    <UserCircleIcon class="w-8 h-8 mr-2 opacity-70"/>
                                                    {{ persona.name }}
                                                </span>
                                                <span class="py-1 px-4 rounded-full flex justify-center items-center" :class="resolveClasificacion(persona.dificultad)">
                                                    {{ persona.dificultad }}
                                                </span>
                                            </div>
                                        </div>
                                        <div v-else class="w-full flex flex-col justify-center items-center p-10">
                                            <ClipboardDocumentListIcon class="w-24 h-24 opacity-70"/>
                                            <span class="text-gray-700 mt-4 text-center">
                                                Ups! Al parecer no hay personas inscritas en este curso.
                                            </span>
                                        </div>
                                    </span>
                                 </span>
                             </div>
                         </div>
                     </div>
                </div>
            </transition>
            <!-- FIN: Index de personas -->
        </div>

    </AppLayout>
</template>
