<script setup lang="ts">
import { ref } from 'vue';
import { Curso } from '@/types/curso';
import AppLayout from '@/Layouts/AppLayout.vue';

/* Variable con los cursos */
const props = defineProps({
    curso: {
        type: Object as () => Curso,
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
            <div class="bg-indigo-200 bg-opacity-25 rounded-xl grid grid-cols-3 items-center p-6">
                
                <!-- Caso de lista vacia -->
                <div>
                    <h1>VACIO</h1>
                </div>

                <!-- Caso de lista con elementos -->
                <div>

                    <!-- Columna para imagen-->
                    <div class="w-1/2 h-1/2 aspect-square items-center">
                        <img src="\images\typing.png" class="border border-black rounded-lg">
                    </div>

                    <!-- Columna para titulo y descripcion-->
                    <div>

                        <h1>

                            Titulo

                        </h1>

                        <h1>

                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem maiores, sit ut facere earum ab et quas atque aspernatur, possimus tenetur. Odit omnis delectus voluptatibus numquam officiis exercitationem doloremque! Necessitatibus?

                        </h1>

                    </div>
                    <!-- Columna para codigo-->
                    <h3>

                        codigo

                    </h3>
                    
                </div>

            </div>
            <!-- Fin de contenedor-->
        </div>

    </AppLayout>

</template>
