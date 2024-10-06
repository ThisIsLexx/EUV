<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Cuento } from '@/types/cuento';
import AppLayout from '@/Layouts/AppLayout.vue';
import Spinner from '@/Components/Custom/Spinner.vue';
import Separator from '@/Components/Separator.vue';
import { Breadcrumb } from '@/types/breadcrumb';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Custom/Modal.vue';
import { Curso } from '@/types/curso';
import { Puntaje } from '@/types/puntaje';
import VueApexCharts from "vue3-apexcharts";
import axios from 'axios';

const props = defineProps({
    cuento: Object as () => Cuento,
    curso: Object as () => Curso,
    breadcrumbs: Array<Breadcrumb>,
    puntajes: Array<Puntaje>,
    promedioUsuarios: Object,
});

let texto = ref('');
let tiempo = ref('00:00');
let palabras = ref<Array<string>>([]);
const $contenido = ref<HTMLElement | null>(null);
const $input = ref<HTMLInputElement | null>(null);

let loadingData = ref(false);
let prediccion = ref('');

let timerInterval: number | null = null;
let secondsElapsed = 0;

let showResultModal = ref(false);

function iniciarJuego() {
    // Definimos las palabras del texto
    palabras.value = props.cuento.contenido.split(' ').slice(0, 32);

    // Mostramos las palabras en el DOM haciendo map para separar cada palabra y de
    // cada palabra, cada una de sus letras.
    if ($contenido.value) {
        $contenido.value.innerHTML = palabras.value.map((palabra) => {
            const letras = palabra.split('');
            return `<word>${letras.map(letra => `<letter>${letra}</letter>`).join('')}</word>`;
        }).join('');
    }
}

function iniciarEventos() {
    // Fijamos el focus en el input al presionar cualquier tecla
    document.addEventListener('keydown', () => {
        $input.value?.focus();
    });

    const $palabra_actual = $contenido.value?.querySelector('word');
    if ($palabra_actual) {
        $palabra_actual.classList.add('current');
    }
    const $letra_actual = $palabra_actual?.querySelector('letter');
    if ($letra_actual) {
        $letra_actual.classList.add('current');
    }

    if ($input.value) {
        $input.value.addEventListener('keydown', OnKeyDown);
        $input.value.addEventListener('keyup', OnKeyUp);
    }
}

function OnKeyDown(event) {
    const $palabra_actual = $contenido.value?.querySelector('word.current');
    const $letra_actual = $palabra_actual?.querySelector('letter.current');

    const { key } = event;
    if (key === ' ') {
        event.preventDefault();
        const $nextPalabra = $palabra_actual?.nextElementSibling as HTMLElement;
        if ($nextPalabra) {
            $palabra_actual.classList.remove('current');
            $nextPalabra.classList.add('current');

            const $nextLetra = $nextPalabra.querySelector('letter');
            if ($nextLetra) {
                $letra_actual?.classList.remove('current');
                $nextLetra.classList.add('current');
            }
            $input.value!.value = '';
        } else {
            gameOver();
        }
    }
    if (key === 'Backspace') {
        if ($input.value?.value === '') {
            event.preventDefault();
            const $prevPalabra = $palabra_actual?.previousElementSibling as HTMLElement;
            if ($prevPalabra) {
                $palabra_actual.classList.remove('current');
                $prevPalabra.classList.add('current');

                const $prevLetras = $prevPalabra.querySelectorAll('letter');
                const $lastLetra = $prevLetras[$prevLetras.length - 1];
                if ($lastLetra) {
                    $letra_actual?.classList.remove('current');
                    $lastLetra.classList.add('current');
                }
                $input.value!.value = $prevPalabra.textContent?.trim() || '';
            }
        }
    }
}

function OnKeyUp() {
    const $palabra_actual = $contenido.value?.querySelector('word.current');
    if ($palabra_actual) {
        // Agregamos la clase current a la palabra actual
        $palabra_actual.classList.add('current');

        const $letra_actual = $palabra_actual.querySelector('letter.current');
        if ($letra_actual) {
            $letra_actual.classList.add('current');
        }

        // Limitar la longitud del input al tamaño de la palabra actual
        const palabra_actual = $palabra_actual.textContent?.trim() || '';
        $input.value!.maxLength = palabra_actual.length;

        // Limpiar clases anteriores
        const todas_las_letras = $palabra_actual.querySelectorAll('letter');
        todas_las_letras.forEach(letra => letra.classList.remove('correct', 'incorrect'));

        // Comparar letras del input con la palabra actual
        const inputValue = $input.value!.value.split('');
        inputValue.forEach((letra, index) => {
            const $letra = todas_las_letras[index];
            if ($letra) {
                const letra_a_comparar = palabra_actual[index];
                const es_correcta = letra.toLowerCase() === letra_a_comparar.toLowerCase();
                const letterClass = es_correcta ? 'correct' : 'incorrect';
                $letra.classList.add(letterClass);
            }
        });

        // Quitar las clases current y is-last de la letra actual
        $letra_actual?.classList.remove('current', 'is-last');
        const inputLength = inputValue.length;
        const $nextActiveLetra = todas_las_letras[inputLength];
        if ($nextActiveLetra) {
            $nextActiveLetra.classList.add('current');
        } else {
            $letra_actual?.classList.add('current', 'is-last');
        }

        // Revisar si la palabra actual es correcta evaluando el input
        if ($input.value!.value.trim().toLowerCase() === palabra_actual.trim().toLowerCase()) {
            $palabra_actual.classList.add('correct');
            $palabra_actual.classList.remove('incorrect');
        } else {
            $palabra_actual.classList.add('incorrect');
            $palabra_actual.classList.remove('correct');
        }
    }
}

const form = useForm({
    total_palabras : palabras.value.length,
    palabras_correctas : 0,
    score : 0,
    tiempo : tiempo.value,
    cuento_id : props.cuento.id,
    curso_id: props.curso.id,
});

function gameOver() {
    form.total_palabras = palabras.value.length;
    form.palabras_correctas = $contenido.value?.querySelectorAll('word.correct').length;
    form.score = (form.palabras_correctas / form.total_palabras) * 100;

    // Definimos el objeto request
    const request = [
        form.palabras_correctas,
        form.total_palabras,
        form.score,
    ];
    setSeries(form.palabras_correctas, form.total_palabras - form.palabras_correctas, form.score, request);

    showResultModal.value = true;

    form.post(route('puntaje.store'));

}

onMounted(() => {
    $contenido.value = document.querySelector('#contenido_juego');
    $input.value = document.querySelector('input');
    iniciarJuego();
    iniciarEventos();
});

function hasHighScore(asignacion: number) {
    if (props.puntajes.length && props.puntajes.find(p => p.cuento_id === 3))
        return true;
    return false
}

function getHighScore(asignacion: number) {
    const puntajes = props.puntajes.filter(p => p.cuento_id === asignacion);
    if (puntajes.length) {
        return Math.max(...puntajes.map(p => p.puntaje));
    }
    return 0;
}

let options = {
    chart: {
        type: 'area'
    },
    xaxis: {
        categories: ['Aciertos', 'Errores', 'Score']
    }
};

let series = [];

function setSeries(aciertos: number, errores: number, score: number, request: any) {
    // Hacemos la petición POST para obtener la predicción
    loadingData.value = true;
    axios.post(route('clasificar'), request)
        .then(response => {
            // && response.data.clasificacion
            if (response.data ) {
                prediccion = response.data.clasificacion; // Guardamos la clasificación obtenida
                loadingData.value = false;
            } else {
                console.warn('No se recibió una clasificación válida en la respuesta');
            }
        })
        .catch(error => {
            console.error('Error al clasificar:', error);
    });

    series = [
        {
            name: "Tus estadísticas",
            data: [aciertos, errores, score]
        },
        {
            name: "Promedio de usuarios",
            data: [props.promedioUsuarios?.aciertos.toFixed(2), props.promedioUsuarios?.fallas.toFixed(2), props.promedioUsuarios?.puntajes.toFixed(2)]
        },
    ];
}

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <Modal :showModal="showResultModal" :closeButton="false" size="lg" :titulo="`Resultados: ${cuento.titulo}`" @closeModal="showResultModal = false;">
            <template v-slot:modal-content>
                <div v-if="loadingData">
                    <div class="flex flex-col w-full text-center justify-center">
                        <span class="text-base uppercase mt-2">
                            Espere un momento mientras se procesan los datos
                        </span>
                        <div class="w-full flex justify-center mt-4">
                            <Spinner/>
                        </div>
                    </div>
                </div>
                <div v-else class="flex flex-col w-full text-center justify-center">
                        <h1 class="font-semibold text-3xl uppercase">¡Felicidades!</h1>
                        <span class="text-base uppercase mt-2">
                            Has completado el cuento: <span class="text-indigo-500 font-bold">{{ cuento?.titulo }}</span>
                        </span>
                        <span class="uppercase mt-2">
                            Obtuviste un total de <span class="text-indigo-500 font-semibold">{{ form.score }}</span> puntos
                        </span>
                        <span v-if="prediccion" class="uppercase mt-2">
                            En este puntaje obtuviste una clasificación: <span class="text-indigo-500 font-semibold">{{ prediccion }}</span>
                        </span>
                        <div class="w-full p-2 border-2 border-indigo-200 rounded-md mt-4">
                            <VueApexCharts width="700" height="300" type="area" :options="options" :series="series"></VueApexCharts>
                        </div>
                </div>
            </template>
            <template v-slot:action-button>
                <button class="bg-indigo-500 hover:bg-indigo-500/90 text-white shadow-sm rounded-md p-2"
                    @click="router.get(route('curso.show', props.curso.id));"
                >
                    Siguiente
                </button>
            </template>
        </Modal>

        <div class="flex flex-col px-20 w-full">
            <div class="flex flex-col w-full text-center justify-center">
                <h1 class="font-semibold text-2xl uppercase text-indigo-700">{{ cuento.titulo }}</h1>
                <!-- <span class="text-xs uppercase font-semibold">
                    Tiempo transcurrido: {{ tiempo }}
                </span> -->
                <span class="text-xs uppercase font-semibold">
                    Mejor score:
                    <template v-if="hasHighScore(cuento.id)">
                        {{ getHighScore(cuento.id) }} puntos
                    </template>
                </span>
            </div>
            <Separator/>
            <div class="grid w-full h-full p-8 bg-gray-700 text-gray-400 rounded-md shadow-md">
                <section id="juego">
                    <p id="contenido_juego" class="uppercase text-2xl transition-colors duration-100 ease-in-out flex flex-wrap gap-2"></p>
                    <input v-model="texto" type="text" class="absolute top-0 left-0" autofocus>
                </section>
            </div>
        </div>
    </AppLayout>
</template>

<style>

letter {
    position: relative;
    &.current::before {
        content: '|';
        position: absolute;
        left: -30%;
        animation: 1s blink infinite ease-in-out;
        color: #c7d2fe;
    }
    &.current.is-last::before {
        left: 100%;
        color: #c7d2fe;
    }
}

letter.correct {
    color: white;
}

letter.incorrect {
    color: red;
}

word {
    display: flex;
}

word.current {
    text-decoration: underline;
}

word.incorrect {
    text-decoration: underline;
    text-decoration-color: red;
}

@keyframes blink {
    0%, 25% {
        opacity: 1;
    }
    75% {
        opacity: 0;
    }
}

</style>
