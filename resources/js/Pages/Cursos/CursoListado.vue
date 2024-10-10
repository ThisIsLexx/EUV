<script setup lang="ts">
import { ref } from 'vue';
import { Curso } from '@/types/curso';
import AppLayout from '@/Layouts/AppLayout.vue';
import { FaceFrownIcon } from '@heroicons/vue/24/outline';
import { Breadcrumb } from '@/types/breadcrumb';
import Separator from '@/Components/Separator.vue';

/* Variable con los cursos */
const props = defineProps({
    cursos: {
        type: Array<Curso>,
        required: true,
    },
    tutor: {
        type: Array,
        required: true,
    },
    breadcrumbs:{
        type: Array<Breadcrumb>,
        required: true,
    },
});

function getNameTutor(identificador : number){
    if(identificador > props.tutor.length){
        return "ERROR";
    }
    if(identificador = props.tutor[identificador-1].id){
        return props.tutor[identificador-1].name;
    }
}
</script>

<template>
    <AppLayout :breadcrumbs="props.breadcrumbs">
        <transition appear name="left-to-right">
            <!-- Contenedor principal-->
            <div class="p-6">
                <!-- Caso de lista vacia -->
                <div v-if="!props.cursos.length" class="grid grid-cols-1 place-items-center">
                    <h1 class="font-extrabold text-4xl text-center">
                        Parece que aún no hay cursos disponibles, pronto habrá nuevos cursos que descubrir.
                    </h1>
                    <FaceFrownIcon class="stroke-indigo-500 size-64"></FaceFrownIcon>
                </div>
                <!-- Fin de caso de lista vacia -->

                <!-- Caso de lista con elementos -->
                <div v-else>
                    <div v-for="curso in props.cursos" :key="curso.id">
                        <div class="w-full rounded-md grid grid-cols-[2fr_4fr_2fr] items-center mt-4 mb-4 bg-gray-100 transition-all duration-300 ease-in-out hover:scale-[102%] hover:shadow-md">
                            <!-- Columna para imagen-->
                            <div class="flex justify-start h-full">
                                <img :src="'/images/curso_images/' + curso.color + '.jpg'" loading="lazy" class="rounded-l-lg h-full w-full object-cover transition-all duration-300 transform brightness-50 group-hover:brightness-100">
                            </div>
                            <!-- Columna para titulo y descripcion-->
                            <div class="p-4 h-full">
                                <h1 class="font-extrabold text-2xl">
                                    {{ curso.titulo }}
                                </h1>
                                <Separator/>
                                <h1 class="text-slate-800 text-lg leading-normal font-medium">
                                    {{ curso.descripcion }}
                                </h1>
                                <h1 class=" font-medium text-base text-gray-500 justify-self-left">
                                    {{ getNameTutor(curso.user_id) }}
                                </h1>
                            </div>
                            <!-- Columna para codigo-->
                            <div class="grid items-end h-full">
                                <h1 class="font-extrabold text-lg p-5 justify-self-end">
                                    Código:
                                    <span class="text-xl text-indigo-500">
                                        {{ curso.codigo }}
                                    </span>
                                </h1>
                            </div>
                        </div>
                        <!-- Fin de contenedor de informacion del curso -->
                    </div>
                    <!-- Fin del for para mostrar cursos -->
                </div>
                <!-- Fin del caso de lista con elementos -->
            </div>
            <!-- Fin de contenedor-->
        </transition>
    </AppLayout>
</template>
