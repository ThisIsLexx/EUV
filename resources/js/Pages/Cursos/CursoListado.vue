<script setup lang="ts">
import { ref } from 'vue';
import { Curso } from '@/types/curso';
import AppLayout from '@/Layouts/AppLayout.vue';

/* Variable con los cursos */
const props = defineProps({
    cursos: {
        type: Array<Curso>,
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

    <AppLayout>

        <div>

            <!-- Contenedor principal-->
            <div class="bg-indigo-200 bg-opacity-25 rounded-xl p-6">
                
                <!-- Caso de lista vacia -->
                <div v-if="!props.cursos.length">
                    <h1>Parece que aún no hay cursos disponibles, pronto habrá nuevos cursos que descubrir</h1>
                </div>

                <!-- Caso de lista con elementos -->
                <div v-else>
                
                    <div v-for="curso in props.cursos" :key="curso.id">

                        <div class="w-full rounded-xl grid grid-cols-3 items-center p-6 mb-6"
                            :class="resolveCursoColor(curso.color)">

                            <!-- Columna para imagen-->
                            <!-- Espacio de prueba-->
                            <div class="border border-black rounded-lg flex justify-center">
                                <img src="\images\typing.png" class="w-1/2 h-1/2 border border-black rounded-lg">
                            </div>

                            <!-- Columna para titulo y descripcion-->
                            <div class="border border-black rounded-lg p-6 justify-self-center">

                                <h1>

                                    Titulo:
                                    {{ curso.titulo }}

                                </h1>

                                <h1>

                                    {{ curso.descripcion }}

                                </h1>

                            </div>
                            

                            <!-- Columna para codigo-->
                            <h1 class="border border-black rounded-lg p-6 justify-self-end">

                                Código:
                                {{ curso.codigo }}
                                
                            </h1>

                        </div>

                    </div>

                </div>

            </div>
            <!-- Fin de contenedor-->
        </div>

    </AppLayout>

</template>
