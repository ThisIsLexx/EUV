<script setup lang="ts">
import { ref } from 'vue';
import { Breadcrumb } from '@/types/breadcrumb';
import AppLayout from '@/Layouts/AppLayout.vue';
import Separator from '@/Components/Separator.vue';
import VueApexCharts from "vue3-apexcharts";
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    breadcrumbs: {
        type: Array<Breadcrumb>,
        required: true
    },
});



let series_generales = ref([
    {
        name: "Mis estadisticas",
        data: [2,3,4,5]
    },
    {
        name: "Promedio de usuarios",
        data: [2,4,5,3]
    }
]);

let opciones_generales = ref({
    chart: {
        type: 'area'
    },
    xaxis: {
        categories: ['Juegos totales', 'Aciertos totales', 'Fallas totales', 'Puntaje total']
    },
    colors: ['#2E93fA', '#66DA26', '#546E7A', '#E91E63', '#FF9800']
});

let opciones_cuentos = ref({
    chart: {
        type: 'bar'
    },
    xaxis: {
        categories: ['Cuentos jugados', 'Aciertos', 'Fallas', 'Puntaje']
    },
    colors: ['#2E93fA', '#66DA26', '#546E7A', '#E91E63', '#FF9800']
})

let series_baja = ref([
    {
        name: "Mis estadisticas",
        data: [1,3,5,1]
    },
    {
        name: "Promedio de usuarios",
        data: [2,4,5,3]
    }
]);

let series_media = ref([
    {
        name: "Mis estadisticas",
        data: [1,3,5,1]
    },
    {
        name: "Promedio de usuarios",
        data: [2,4,5,3]
    }
]);

let series_alta = ref([
    {
        name: "Mis estadisticas",
        data: [1,3,5,1]
    },
    {
        name: "Promedio de usuarios",
        data: [2,4,5,3]
    }
]);

</script>

<template>
    <Head title="Mis estadísticas" />
    <AppLayout :breadcrumbs="props.breadcrumbs">
    <div>
        <h1 class=" font-light uppercase">Mis Estadisticas</h1>
        <Separator />
        <div class="flex flex-col p-5 my-4 border-2 shadow-sm hover:shadow-md hover:shadow-indigo-500/30 transition duration-300 ease-in-out rounded-md w-auto">
            <h2 class="font-semibold uppercase text-sm">Estadisticas generales</h2>
            <div class="flex justify-center text-center w-full">
                <VueApexCharts width="600" type="area" :options="opciones_generales" :series="series_generales"></VueApexCharts>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div class="p-5 border-2 shadow-sm hover:shadow-md hover:shadow-indigo-500/30 transition duration-300 ease-in-out rounded-md w-auto">
                <h2 class="font-semibold uppercase text-sm">Cuentos dificultad baja</h2>
                <div class="flex justify-center text-center">
                    <VueApexCharts width="300" height="300" type="bar" :options="opciones_cuentos" :series="series_baja"></VueApexCharts>
                </div>
            </div>
            <div class="p-5 border-2 shadow-sm hover:shadow-md hover:shadow-indigo-300/30 transition duration-300 ease-in-out rounded-md w-auto">
                <h2 class="font-semibold uppercase text-sm">Cuentos dificultad media</h2>
                <div class="flex justify-center text-center">
                    <VueApexCharts width="300" height="300" type="bar" :options="opciones_cuentos" :series="series_media"></VueApexCharts>
                </div>
            </div>
            <div class="p-5 border-2 shadow-sm hover:shadow-md hover:shadow-indigo-300/30 transition duration-300 ease-in-out rounded-md w-auto">
                <h2 class="font-semibold uppercase text-sm">Cuentos dificultad alta</h2>
                <div class="flex justify-center text-center">
                    <VueApexCharts width="300" height="300" type="bar" :options="opciones_cuentos" :series="series_alta"></VueApexCharts>
                </div>
            </div>
        </div>
    </div>
    </AppLayout>
</template>
