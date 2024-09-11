<script setup lang="ts">

import AppLayout from '@/Layouts/AppLayout.vue';
import Separator from '@/Components/Separator.vue';
import Button from '@/Components/Custom/Button.vue';
import { PlayIcon } from '@heroicons/vue/20/solid';
import { Cuento } from '@/types/cuento';
import { Curso } from '@/types/curso';
import { Breadcrumb } from '@/types/breadcrumb';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { UserCircleIcon, ClipboardDocumentListIcon } from '@heroicons/vue/24/solid';

const props = defineProps({
    curso: {
        type: Object as () => Curso,
        required: true
    },
    breadcrumbs: {
        type: Array<Breadcrumb>,
        required: true
    },
    asignaciones: {
        type: Array<Cuento>,
        required: true
    },
    tutor: {
        required: true
    },
    personas: {
        required: true,
        default: null
    }
});

let activeTab = ref('tablero');

const startGame = (cuento: number) => {
    router.get(route('curso.play', cuento));
}

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
        default:
            return 'bg-gradient-to-r from-cyan-500 to-emerald-500';
    }
}

</script>

<template>
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
                                        Asignaciones
                                        <Separator/>
                                    </span>
                                    <div v-if="props.asignaciones.length" class="flex flex-col w-full space-y-2">
                                        <div v-for="asignacion in props.asignaciones" :key="asignacion.id"
                                            class="flex justify-between p-2 border border-gray-200 rounded-md transition-all duration-300 ease-in-out cursor-pointer hover:border-indigo-500 hover:text-indigo-600">
                                            <span class="flex justify-start items-center content-center w-full font-medium">
                                                <PlayIcon class="w-8 h-8 mr-2 opacity-70"/>
                                                {{ asignacion.titulo }}
                                            </span>
                                            <span class="font-semibold justify-end content-center">
                                            </span>
                                        </div>
                                    </div>
                                    <div v-else class="w-full flex flex-col justify-center items-center p-10">
                                        <ClipboardDocumentListIcon class="w-24 h-24 opacity-70"/>
                                        <span class="text-gray-700 mt-4">
                                            No hay asignaciones en este curso.
                                            <div v-if="$page.props.auth.user.email === props.tutor[1]" class="flex w-full justify-center mt-2">
                                                <Button type="button" message="Agregar asignación" redirect="curso.create"/>
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
                                        <div v-if="props.personas.length > 0">
                                            <div v-for="persona in props.personas" :key="persona.id" class="flex justify-between p-5 border-b transition-all duration-200 border-gray-200 hover:border-indigo-600 hover:text-indigo-600">
                                                <span class="flex justify-start items-center content-center w-full font-semibold">
                                                    <UserCircleIcon class="w-8 h-8 mr-2 opacity-70"/>
                                                    {{ persona.name }}
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
