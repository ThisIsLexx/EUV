<script setup lang="ts">

import AppLayout from '@/Layouts/AppLayout.vue';
import Separator from '@/Components/Separator.vue';

const props = defineProps({
    titulo: {
        type: String,
        required: true
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
            <div class="w-full">
                <div class="my-4 w-full bg-gradient-to-r from-cyan-500 to-emerald-500 text-white p-5 rounded-md mb-4">
                    <span class="font-semibold">
                        Cursos dificultad baja
                    </span>
                </div>
                <div class="flex relative space-x-4 overflow-x-auto w-full my-4">
                    <div v-for="valor in forvalue" class="min-w-96 p-5 rounded-md shadow-md">
                        {{valor}}
                    </div>
                </div>
            </div>
            <div class="w-full">
                <div class="my-4 w-full bg-gradient-to-r from-orange-500 to-yellow-500 text-white p-5 rounded-md mb-4">
                    <span class="font-semibold">
                        Cursos dificultad media
                    </span>
                </div>
                <div class="flex relative space-x-4 overflow-x-auto w-full">
                    <div class="min-w-96 p-5 rounded-md border-2 shadow-2xl">
                        asd
                    </div>
                </div>
            </div>
            <div class="w-full">
                <div class="my-4 w-full bg-gradient-to-r from-red-500 to-fuchsia-500 text-white p-5 rounded-md mb-4">
                    <span class="font-semibold">
                        Cursos dificultad alta
                    </span>
                </div>
                <div class="flex relative space-x-4 overflow-x-auto w-full">
                    <div class="min-w-96 p-5 rounded-md border-2 shadow-2xl">
                        asd
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
