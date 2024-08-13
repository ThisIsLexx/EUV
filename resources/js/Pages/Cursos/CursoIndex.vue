<script setup lang="ts">

import AppLayout from '@/Layouts/AppLayout.vue';
import Separator from '@/Components/Separator.vue';
import Button from '@/Components/Custom/Button.vue';
import { PlayIcon } from '@heroicons/vue/20/solid';
import { Cuento } from '@/types/cuento';
import { Curso } from '@/types/curso';
import { Breadcrumb } from '@/types/breadcrumb';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({
    curso: {
        type: Object as () => Curso,
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
    breadcrumbs: {
        type: Array<Breadcrumb>,
        required: true
    }
});

const forvalue = [1,2,3,4,5,6,7,8,9,10];

const startGame = (cuento: number) => {
    router.get(route('curso.play', cuento));
}

</script>

<template>
    <AppLayout :breadcrumbs="props.breadcrumbs">
        <div>
            <h1 class="font-semibold text-2xl uppercase">{{props.curso.codigo}}</h1>
            <span class="text-gray-600 text-sm uppercase">
                {{ props.curso.titulo }} - {{ props.curso.descripcion }}
            </span>
        </div>
        <Separator/>

        <div class="flex flex-col">
            <!-- INICIO: CURSOS DIFICULTAD BAJA -->
            <div class="w-full" v-if="baja.length > 0">
                <div class="my-4 w-full bg-gradient-to-r from-cyan-500 to-emerald-500 text-white p-5 rounded-md mb-4">
                    <span class="font-semibold">
                        Cursos dificultad baja
                    </span>
                </div>
                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 w-full">
                    <div v-for="cuento in baja" class="p-5 rounded-md border-2 shadow-sm transition ease-in-out duration-300 hover:shadow-md">
                        <div class="flex text-xs uppercase font-semibold">
                            {{cuento.titulo}}
                        </div>
                        <Separator/>
                        <div class="flex justify-end space-x-2">
                            <Button message="Ver estadísticas" type="button" button="secondary" />
                            <div @click="startGame(cuento.id)">
                                <Button message="Iniciar" type="button" button="primary" />
                            </div>
                        </div>
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
                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 w-full">
                    <div v-for="cuento in media" class="p-5 rounded-md border-2 shadow-sm transition ease-in-out duration-300 hover:shadow-md">
                        <div class="flex text-xs uppercase font-semibold">
                            {{cuento.titulo}}
                        </div>
                        <Separator/>
                        <div class="flex justify-end space-x-2">
                            <Button message="Ver estadísticas" type="button" button="secondary" />
                            <div @click="startGame(cuento.id)">
                                <Button message="Iniciar" type="button" button="primary" />
                            </div>
                        </div>
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
                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 w-full">
                    <div v-for="cuento in alta" class="p-5 rounded-md border-2 shadow-sm transition ease-in-out duration-300 hover:shadow-md">
                        <div class="flex text-xs uppercase font-semibold">
                            {{cuento.titulo}}
                        </div>
                        <Separator/>
                        <div class="flex justify-end space-x-2">
                            <Button message="Ver estadísticas" type="button" button="secondary" />
                            <div @click="startGame(cuento.id)">
                                <Button message="Iniciar" type="button" button="primary" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN: CURSOS DIFICULTAD ALTA -->
        </div>

    </AppLayout>
</template>
