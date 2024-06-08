<script setup lang="ts">
import { ref } from 'vue';
import { Breadcrumb } from '@/types/breadcrumb';
import AppLayout from '@/Layouts/AppLayout.vue';
import Separator from '@/Components/Separator.vue';
import VueApexCharts from "vue3-apexcharts";

const props = defineProps({
    breadcrumbs: {
        type: Array<Breadcrumb>,
        required: true
    }
});



let series = ref([
    {
        name: "series-1",
        data: [30, 5, 45, 30, 3]
    }
]);

let options = ref({
    chart: {
        type: 'line'
    },
    xaxis: {
        categories: ['Aciertos', 'Errores', 'PPM', 'Tiempo', 'Intentos']
    }
});

let series2 = ref([
    {
        name: "series-1",
        data: [30, 40, 45, 50, 49]
    }
]);

let options2 = ref({
    chart: {
        type: 'area'
    },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May']
    },
    colors: ['#2E93fA', '#66DA26', '#546E7A', '#E91E63', '#FF9800']
});



</script>

<template>
    <AppLayout :breadcrumbs="props.breadcrumbs">
    <div>
        <h1 class=" font-light uppercase">Mis Estadisticas</h1>
        <Separator />
        <div class="flex flex-col p-5 my-4 border-2 shadow-sm hover:shadow-md hover:shadow-indigo-500/30 transition duration-300 ease-in-out rounded-md w-auto">
            <h2 class="font-semibold uppercase text-sm">Estadisticas generales</h2>
            <div class="flex justify-center text-center w-full">
                <VueApexCharts width="600" type="area" :options="options2" :series="series2"></VueApexCharts>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div class="p-5 border-2 shadow-sm hover:shadow-md hover:shadow-indigo-500/30 transition duration-300 ease-in-out rounded-md w-auto">
                <h2 class="font-semibold uppercase text-sm">Cursos dificultad fácil</h2>
                <div class="flex justify-center text-center">
                    <VueApexCharts width="400" type="bar" :options="options" :series="series"></VueApexCharts>
                </div>
            </div>
            <div class="p-5 border-2 shadow-sm hover:shadow-md hover:shadow-indigo-300/30 transition duration-300 ease-in-out rounded-md w-auto">
                <h2 class="font-semibold uppercase text-sm">Cursos dificultad media</h2>
                <div class="flex justify-center text-center">
                    <VueApexCharts width="400" type="bar" :options="options" :series="series"></VueApexCharts>
                </div>
            </div>
            <div class="p-5 border-2 shadow-sm hover:shadow-md hover:shadow-indigo-300/30 transition duration-300 ease-in-out rounded-md w-auto">
                <h2 class="font-semibold uppercase text-sm">Cursos dificultad dificil</h2>
                <div class="flex justify-center text-center">
                    <VueApexCharts width="400" type="bar" :options="options" :series="series"></VueApexCharts>
                </div>
            </div>
        </div>
    </div>
    </AppLayout>
</template>
