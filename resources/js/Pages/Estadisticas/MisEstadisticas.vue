<script setup lang="ts">
import { onBeforeMount, onMounted, ref } from 'vue';
import { Breadcrumb } from '@/types/breadcrumb';
import AppLayout from '@/Layouts/AppLayout.vue';
import Separator from '@/Components/Separator.vue';
import VueApexCharts from "vue3-apexcharts";
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { UserCircleIcon, PaperAirplaneIcon, ChartBarIcon } from '@heroicons/vue/24/solid';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    breadcrumbs: {
        type: Array<Breadcrumb>,
        required: true
    },
    user_id: {
        type: Number,
        required: true
    },
    user_clasification: {
        type: String,
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

let mis_puntajes_dificultad = ref({
    baja: {
        jugados: 0,
        aciertos: 0,
        fallas: 0,
        puntajes: 0
    },
    media: {
        jugados: 0,
        aciertos: 0,
        fallas: 0,
        puntajes: 0
    },
    alta: {
        jugados: 0,
        aciertos: 0,
        fallas: 0,
        puntajes: 0
    }
});

let puntajes_generales_dificultad = ref({
    baja: {
        jugados: 0,
        aciertos: 0,
        fallas: 0,
        puntajes: 0
    },
    media: {
        jugados: 0,
        aciertos: 0,
        fallas: 0,
        puntajes: 0
    },
    alta: {
        jugados: 0,
        aciertos: 0,
        fallas: 0,
        puntajes: 0
    }
});

function resolveClasificacion(clasificacion : string) {
    switch (clasificacion) {
        case 'baja':
            return 'bg-emerald-200 text-emerald-700';
        case 'media':
            return 'bg-yellow-200 text-yellow-700';
        case 'alta':
            return 'bg-red-200 text-red-700';
        default:
            return 'bg-emerald-200 text-emerald-700';
    }
}

onMounted(() => {
    // Aqui se haria la peticion a la API para obtener los datos
    // y se asignarian a las variables
    axios.get(`/api/estadisticas/${props.user_id}`).then(response => {
        mis_puntajes.value = response.data.mis_puntajes;
        puntajes_generales.value = response.data.puntajes_generales;

        console.warn(response.data);

        mis_puntajes_dificultad.value.baja = response.data.mis_puntajes_dificultad.baja;
        mis_puntajes_dificultad.value.media = response.data.mis_puntajes_dificultad.media;
        mis_puntajes_dificultad.value.alta = response.data.mis_puntajes_dificultad.alta;

        puntajes_generales_dificultad.value.baja = response.data.puntajes_generales_dificultad.baja;
        puntajes_generales_dificultad.value.media = response.data.puntajes_generales_dificultad.media;
        puntajes_generales_dificultad.value.alta = response.data.puntajes_generales_dificultad.alta;

        series_generales.value = [
            {
                name: "Mis estadisticas",
                data: [
                    parseFloat(mis_puntajes.value.jugados.toFixed(2)),
                    parseFloat(mis_puntajes.value.aciertos.toFixed(2)),
                    parseFloat(mis_puntajes.value.fallas.toFixed(2)),
                    parseFloat(mis_puntajes.value.puntajes.toFixed(2))
                ]
            },
            {
                name: "Promedio de usuarios",
                data: [
                    parseFloat(puntajes_generales.value.jugados.toFixed(2)),
                    parseFloat(puntajes_generales.value.aciertos.toFixed(2)),
                    parseFloat(puntajes_generales.value.fallas.toFixed(2)),
                    parseFloat(puntajes_generales.value.puntajes.toFixed(2))
                ]
            }
        ];

        series_baja.value = [
            {
                name: "Mis estadisticas",
                data: [
                    parseFloat(mis_puntajes_dificultad.value.baja.jugados.toFixed(2)),
                    parseFloat(mis_puntajes_dificultad.value.baja.aciertos.toFixed(2)),
                    parseFloat(mis_puntajes_dificultad.value.baja.fallas.toFixed(2)),
                    parseFloat(mis_puntajes_dificultad.value.baja.puntajes.toFixed(2))
                ]
            },
            {
                name: "Promedio de usuarios",
                data: [
                    parseFloat(puntajes_generales_dificultad.value.baja.jugados.toFixed(2)),
                    parseFloat(puntajes_generales_dificultad.value.baja.aciertos.toFixed(2)),
                    parseFloat(puntajes_generales_dificultad.value.baja.fallas.toFixed(2)),
                    parseFloat(puntajes_generales_dificultad.value.baja.puntajes.toFixed(2))
                ]
            }
        ];

        series_media.value = [
            {
                name: "Mis estadisticas",
                data: [
                    parseFloat(mis_puntajes_dificultad.value.media.jugados.toFixed(2)),
                    parseFloat(mis_puntajes_dificultad.value.media.aciertos.toFixed(2)),
                    parseFloat(mis_puntajes_dificultad.value.media.fallas.toFixed(2)),
                    parseFloat(mis_puntajes_dificultad.value.media.puntajes.toFixed(2))
                ]
            },
            {
                name: "Promedio de usuarios",
                data: [
                    parseFloat(puntajes_generales_dificultad.value.media.jugados.toFixed(2)),
                    parseFloat(puntajes_generales_dificultad.value.media.aciertos.toFixed(2)),
                    parseFloat(puntajes_generales_dificultad.value.media.fallas.toFixed(2)),
                    parseFloat(puntajes_generales_dificultad.value.media.puntajes.toFixed(2))
                ]
            }
        ];

        series_alta.value = [
            {
                name: "Mis estadisticas",
                data: [
                    parseFloat(mis_puntajes_dificultad.value.alta.jugados.toFixed(2)),
                    parseFloat(mis_puntajes_dificultad.value.alta.aciertos.toFixed(2)),
                    parseFloat(mis_puntajes_dificultad.value.alta.fallas.toFixed(2)),
                    parseFloat(mis_puntajes_dificultad.value.alta.puntajes.toFixed(2))
                ]
            },
            {
                name: "Promedio de usuarios",
                data: [
                    parseFloat(puntajes_generales_dificultad.value.alta.jugados.toFixed(2)),
                    parseFloat(puntajes_generales_dificultad.value.alta.aciertos.toFixed(2)),
                    parseFloat(puntajes_generales_dificultad.value.alta.fallas.toFixed(2)),
                    parseFloat(puntajes_generales_dificultad.value.alta.puntajes.toFixed(2))
                ]
            }
        ];

    }).catch(error => {
        console.log(error);
    });
});

let series_generales = ref([
    {
        name: "Mis estadisticas",
        data: [0,0,0,0]
    },
    {
        name: "Promedio de usuarios",
        data: [0,0,0,0]
    }
]);

let opciones_generales = ref({
    chart: {
        type: 'area',
        toolbar: {
        show: true,
        offsetX: 0,
        offsetY: 0,
        tools: {
            download: true,
            selection: false,
            zoom: false,
            zoomin: true,
            zoomout: true,
            pan: false,
            },
        },
    },
    xaxis: {
        categories: ['Juegos totales', 'Aciertos totales', 'Fallas totales', 'Puntaje total']
    },
    colors: ['#2E93fA', '#66DA26'],
});

let opciones_cuentos = ref({
    chart: {
        type: 'bar',
    },
    plotOptions: {
        bar: {
        horizontal: true
        }
    },
    xaxis: {
        categories: ['Cuentos jugados', 'Aciertos', 'Fallas', 'Puntaje']
    },
    colors: ['#2E93fA', '#66DA26']
})

let series_baja = ref([
    {
        name: "Mis estadisticas",
        data: [0,0,0,0]
    },
    {
        name: "Promedio de usuarios",
        data: [0,0,0,0]
    }
]);

let series_media = ref([
    {
        name: "Mis estadisticas",
        data: [0,0,0,0]
    },
    {
        name: "Promedio de usuarios",
        data: [0,0,0,0]
    }
]);

let series_alta = ref([
    {
        name: "Mis estadisticas",
        data: [0,0,0,0]
    },
    {
        name: "Promedio de usuarios",
        data: [0,0,0,0]
    }
]);

</script>

<template>
    <Head title="Mis estadísticas" />
    <AppLayout :breadcrumbs="props.breadcrumbs">
    <div>
        <h1 class=" font-light uppercase">Mis Estadisticas</h1>
        <Separator />

        <transition appear name="slide-fade">
            <div class="flex mt-4 border-2 shadow-sm hover:shadow-md hover:shadow-indigo-500/30 transition-all duration-300 ease-in-out rounded-md w-auto h-auto group">
                <div class="w-auto bg-gray-200 flex justify-center items-center">
                    <UserCircleIcon class="w-16 h-16 transition-all ease-in-out duration-300 text-gray-500 m-4 group-hover:text-indigo-400"  />
                </div>
                <div class="flex flex-col w-full p-4">
                    <div class="flex w-full justify-between">
                        <div>
                            <h2 class="font-semibold uppercase text-sm">
                                {{ $page.props.auth.user.name }}
                            </h2>
                        </div>
                        <div class="font-semibold">
                            Clasificación del usuario:
                            <span class="py-1 px-4 rounded-full" :class="resolveClasificacion(props.user_clasification)">
                                {{ props.user_clasification }}
                            </span>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500 mt-4 text-justify">
                        Para mejorar tu clasificación de usuario registrate en los diferentes cursos para jugar diversas asignaciones
                        y mejorar tus habilidades en mecanografia. Conforme consigas diferentes puntajes, tu clasificación irá mejorando
                        según tus habilidades. Nuestro sistema de clasificación podrá dar calificaciones a cada uno de tus puntajes para
                        evaluar tu desempeño, para posteriormente darte una clasificación de usuario:
                        <button type="button" @click="router.get(route('curso.index'))"
                            class="font-semibold text-sm inline-flex items-center text-indigo-500 hover:text-indigo-800">
                            Unirme a un curso
                        </button>
                    </span>
                </div>
            </div>
        </transition>

        <div v-if="mis_puntajes.jugados">
            <div class="flex flex-col p-5 my-4 border-2 shadow-sm hover:shadow-md hover:shadow-indigo-500/30 transition duration-300 ease-in-out rounded-md w-auto">
                <h2 class="font-semibold uppercase text-sm">Estadisticas generales</h2>
                <div class="flex justify-center text-center w-full">
                    <VueApexCharts width="800" height="300" type="area" :options="opciones_generales" :series="series_generales"></VueApexCharts>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="flex flex-col p-5 my-4 border-2 shadow-sm hover:shadow-md hover:shadow-indigo-500/30 transition duration-300 ease-in-out rounded-md w-auto">
                <h2 class="font-semibold uppercase text-sm">Estadisticas generales</h2>
                <div class="flex flex-col justify-center text-center w-full">
                    <ChartBarIcon class="w-16 h-16 text-gray-500 m-auto animate-pulse" />
                    <p class="text-gray-500 font-semibold">No tienes estadisticas generales</p>
                </div>
            </div>
        </div>
        <!-- <div class="grid grid-cols-3 gap-4">
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
        </div> -->
    </div>
    </AppLayout>
</template>
