<script setup lang="ts">
import { ref } from 'vue';
import { Curso } from '@/types/curso';
import AppLayout from '@/Layouts/AppLayout.vue';
import { FaceFrownIcon } from '@heroicons/vue/24/outline';
import { Breadcrumb } from '@/types/breadcrumb';

/* Variable con los cursos */
const props = defineProps({
    cursos: {
        type: Array<Curso>,
        required: true,
    },
    breadcrumbs:{
        type: Array<Breadcrumb>,
        required: true,
    }
});

/*Funcion para colores de cursos*/
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

</script>

<template>
    <AppLayout :breadcrumbs="props.breadcrumbs">
        <transition appear name="left-to-right">
            <!-- Contenedor principal-->
            <div class="bg-indigo-600 bg-opacity-25 rounded-xl p-6">
                <!-- Caso de lista vacia -->
                <div v-if="!props.cursos.length" class="grid grid-cols-1 place-items-center">
                    <h1 class="font-extrabold text-4xl text-center">
                        Parece que aún no hay cursos disponibles, pronto habrá nuevos cursos que descubrir.
                    </h1>
                    <FaceFrownIcon class="stroke-indigo-500 size-64"></FaceFrownIcon>
                </div>
                <!-- Caso de lista con elementos -->
                <div v-else>
                    <div v-for="curso in props.cursos" :key="curso.id">
                        <div class="w-full rounded-xl grid grid-cols-3 items-center p-6 mt-3 mb-3 border-4 border-indigo-800"
                            :class="resolveCursoColor(curso.color)">
                            <!-- Columna para imagen-->
                            <div class="flex justify-center mr-6">
                                <img :src="'/images/curso_images/' + curso.color + '.jpg'" class="rounded-lg h-3/4 w-3/4 object-cover rounded-t-md transition-all duration-300 transform brightness-50 group-hover:brightness-100">
                            </div>
                            <!-- Columna para titulo y descripcion-->
                            <div class="p-6">
                                <h1 class="font-extrabold text-2xl">
                                    {{ curso.titulo }}
                                </h1>
                                <h1 class="text-slate-800 text-lg leading-normal font-medium">
                                    {{ curso.descripcion }}
                                </h1>
                            </div>
                            <!-- Columna para codigo-->
                            <div>
                                <h1 class="font-extrabold text-xl p-6 justify-self-center">
                                    Código:
                                    <span class="text-3xl underline">
                                        {{ curso.codigo }}
                                    </span>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin de contenedor-->
        </transition>
    </AppLayout>
</template>
