<script setup lang="ts">

import AppLayout from '@/Layouts/AppLayout.vue';
import Separator from '@/Components/Separator.vue';
import { Cuento } from '@/types/cuento';

const props = defineProps({
    titulo: {
        type: String,
        required: true
    },
    baja: {
        type: Array<Cuento>,
    },
    media: {
        type: Array<Cuento>,
    },
    alta: {
        type: Array<Cuento>,
    },
});

const forvalue = [1,2,3,4,5,6,7,8,9,10];

</script>

<template>
    <AppLayout>
        <div>
            <h1>{{props.titulo}}</h1>
        </div>
        <Separator/>

        <div class="flex flex-col">
            <!-- INICIO: CURSOS DIFICULTAD BAJA -->
            <div class="w-full" v-if="baja.length > 0">
                {{ console.log(baja) }}
                <div class="my-4 w-full bg-gradient-to-r from-cyan-500 to-emerald-500 text-white p-5 rounded-md mb-4">
                    <span class="font-semibold">
                        Cursos dificultad baja
                    </span>
                </div>
                <div class="flex relative space-x-4 overflow-x-auto w-full pb-6">
                    <div v-for="cuento in baja" class="min-w-96 p-5 rounded-md border-2 shadow-sm transition ease-in-out duration-300 hover:shadow-md">
                        {{cuento.titulo}}
                    </div>
                </div>
            </div>
            <!-- FIN: CURSOS DIFICULTAD BAJA -->

            <!-- INICIO: CURSOS DIFICULTAD MEDIA -->
            <div class="w-full" v-if="media.length > 0">
                <div class="my-4 w-full bg-gradient-to-r from-orange-500 to-yellow-500 text-white p-5 rounded-md mb-4">
                    <span class="font-semibold">
                        Cursos dificultad media
                    </span>
                </div>
                <div class="flex relative space-x-4 overflow-x-auto w-full pb-6">
                    <div v-for="cuento in media" class="min-w-96 p-5 rounded-md border-2 shadow-sm transition ease-in-out duration-300 hover:shadow-md">
                        {{cuento.titulo}}
                    </div>
                </div>
            </div>
            <!-- FIN: CURSOS DIFICULTAD MEDIA -->

            <!-- INICIO: CURSOS DIFICULTAD ALTA -->
            <div class="w-full" v-if="alta.length > 0">
                <div class="my-4 w-full bg-gradient-to-r from-red-500 to-fuchsia-500 text-white p-5 rounded-md mb-4">
                    <span class="font-semibold">
                        Cursos dificultad alta
                    </span>
                </div>
                <div class="flex relative space-x-4 overflow-x-auto w-full pb-6">
                    <div v-for="cuento in alta" class="min-w-96 p-5 rounded-md border-2 shadow-sm transition ease-in-out duration-300 hover:shadow-md">
                        {{cuento.titulo}}
                    </div>
                </div>
            </div>
            <!-- FIN: CURSOS DIFICULTAD ALTA -->
        </div>

    </AppLayout>
</template>
