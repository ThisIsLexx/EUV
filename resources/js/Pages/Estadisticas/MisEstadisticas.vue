<script setup lang="ts">
import { onBeforeMount, onMounted, ref } from 'vue';
import { Breadcrumb } from '@/types/breadcrumb';
import AppLayout from '@/Layouts/AppLayout.vue';
import Separator from '@/Components/Separator.vue';
import VueApexCharts from "vue3-apexcharts";
import { Head } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    breadcrumbs: {
        type: Array<Breadcrumb>,
        required: true
    },
    user_id: {
        type: Number,
        required: true
    }
});

let mis_puntajes = ref({
    jugados: 0,
    aciertos: 0,
    fallas: 0,
    puntajes: 0
});

let puntajes_generales = ref({
    jugados: 0,
    aciertos: 0,
    fallas: 0,
    puntajes: 0
});

onMounted(() => {
    // Aqui se haria la peticion a la API para obtener los datos
    // y se asignarian a las variables
    axios.get(`/api/estadisticas/${props.user_id}`).then(response => {
        mis_puntajes.value = response.data.mis_puntajes;
        puntajes_generales.value = response.data.puntajes_generales;

        series_generales.value = [
            {
                name: "Mis estadisticas",
                data: [mis_puntajes?.value?.jugados, mis_puntajes?.value?.aciertos, mis_puntajes?.value?.fallas, mis_puntajes?.value?.puntajes],

            },
            {
                name: "Promedio de usuarios",
                data: [puntajes_generales.value.jugados, puntajes_generales.value.aciertos, puntajes_generales.value.fallas, puntajes_generales.value.puntajes]
            }
        ];


    }).catch(error => {
        console.log(error);
    });
});

let series_generales = ref([
    {
        name: "Mis estadisticas",
        data: [1,3,4,5]
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
