<script setup lang="ts">
import { onMounted, ref, computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import Separator from '@/Components/Separator.vue';
import Modal from '@/Components/Custom/Modal.vue';
import baja from '@/Components/Custom/baja.json';
import media from '@/Components/Custom/media.json';
import alta from '@/Components/Custom/alta.json';
import { ArrowPathRoundedSquareIcon } from '@heroicons/vue/24/outline';


const palabrasDificultadBaja = baja['palabras'];
const palabrasDificultadMedia = media['palabras'];
const palabrasDificultadAlta = alta['palabras'];

const $input = ref<HTMLInputElement | null>(null);
const palabras = ref<Array<string>>([]);
const texto = ref<string>('hola mundo');

const palabrasUsuario = ref<Array<string>>([]);

const tiempo_transcurrido = ref<number>(0);

const palabraActualIndex = ref<number>(0); // Indice de la palabra actual
const letraActualIndex = ref<number>(0); // Indice de la letra actual

const input_usuario = ref<string>('');
const showModal = ref<boolean>(false);
const PPM = ref<number>(0);

onMounted(() => {
    iniciarJuego();

});

const timer = ref<number | null>(null);

function startTimer() {
    stopTimer(); // Ensure any existing timer is stopped before starting a new one
    timer.value = window.setInterval(() => {
        tiempo_transcurrido.value++;
    }, 1000);
}

function stopTimer() {
    if (timer.value !== null) {
        clearInterval(timer.value);
        timer.value = null;
    }
}

const props = defineProps<{
    dificultad: string;
}>();

function iniciarJuego() {
    startTimer();
    $input.value?.focus();
    if (props.dificultad === 'baja') {
        palabras.value = shuffleArray(palabrasDificultadBaja).slice(0, 30);
    }
    else if (props.dificultad === 'media') {
        palabras.value = shuffleArray(palabrasDificultadMedia).slice(0, 30);
    }
    else if (props.dificultad === 'alta') {
        palabras.value = shuffleArray(palabrasDificultadAlta).slice(0, 30);
    }
    else {
        palabras.value = shuffleArray(palabrasDificultadBaja).slice(0, 30);
    }
}

function shuffleArray(array: Array<string>): Array<string> {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

function onKeyDown(event: KeyboardEvent) {
    $input.value?.focus();
    if (event.key === ' ') {
        event.preventDefault();
        if (input_usuario.value.trim() === palabras.value[palabraActualIndex.value]) {
            palabraActualIndex.value++;
            letraActualIndex.value = 0;
            input_usuario.value = ''; // Limpiar la entrada para la siguiente palabra
        }
    }
}

function onKeyUp(event: KeyboardEvent) {
    console.log('letraActualIndex', letraActualIndex.value);
    // Casos a ignorar / espacios y acentos
    if (event.key === ' ') return;
    if (event.key === 'Dead') return;

    // Lógica para implementación de tecla para borrar
    if (event.key === 'Backspace') {
        if (letraActualIndex.value > 0) {
            letraActualIndex.value--;
        } else if (palabraActualIndex.value > 0) {
            palabraActualIndex.value--;
            letraActualIndex.value = palabras.value[palabraActualIndex.value].length - 1;
            input_usuario.value = palabras.value[palabraActualIndex.value];
            palabrasUsuario.value.pop();
        }
        return;
    }

    const palabraActual = palabras.value[palabraActualIndex.value];
    letraActualIndex.value++;

    // Si se llega al final de la palabra actual

    if (!palabraActual) gameOver();

    if (letraActualIndex.value >= palabraActual.length) {
        palabraActualIndex.value++;
        letraActualIndex.value = 0;
        palabrasUsuario.value.push(input_usuario.value.trim());
        input_usuario.value = ''; // Limpiar la entrada para la siguiente palabra
    }

    if (palabraActualIndex.value >= palabras.value.length) {
        gameOver();
    }
}

function esLetraCorrecta(palabraIndex: number, letraIndex: number): boolean {
    const palabraActual = palabras?.value[palabraIndex];
    const letraUsuario = input_usuario.value[letraIndex]?.toLowerCase();
    const letraCorrecta = palabraActual[letraIndex]?.toLowerCase();
    return letraUsuario === letraCorrecta;
}

function esPalabraCorrecta(palabraIndex: number): boolean {
    return palabrasUsuario.value[palabraIndex]?.toLowerCase() === palabras.value[palabraIndex]?.toLowerCase();
}

const totalPalabrasCorrectas = computed(() => {
    return palabrasUsuario.value.filter((palabra, index) => esPalabraCorrecta(index)).length;
});

function gameOver(): void {
    try {
        stopTimer();
        PPM.value = (totalPalabrasCorrectas.value * 60) / tiempo_transcurrido?.value;
    }
    finally {
        showModal.value = true;
    }

}

function reinitGame() {
    stopTimer(); // Stop the existing timer
    palabrasUsuario.value = [];
    palabraActualIndex.value = 0;
    letraActualIndex.value = 0;
    tiempo_transcurrido.value = 0;
    iniciarJuego();
    startTimer();
    $input.value?.focus();
    showModal.value = false;
}

function endGame() {
    showModal.value = false;
    $input.value?.blur();
    router.get('/estadisticas');
}

</script>

<template @keydown="$input.value?.focus()">
    <Head title="Modo Práctica" />
    <AppLayout>
        <Modal :showModal="showModal" :closeButton="false" size="lg" titulo="Resultados del modo práctica" @closeModal="showModal = false;">
            <template v-slot:modal-content>

                <div class="flex flex-col w-full text-center justify-center">
                    <h1 class="font-semibold text-3xl uppercase">¡Felicidades!</h1>
                    <span class="text-base uppercase mt-2">
                        Has finalizado el <span class="text-indigo-500 font-bold"> modo práctica</span>
                    </span>
                    <span class="uppercase text-lg mt-2">
                        Estadísticas obtenidas
                    </span>
                    <hr>

                    <div class="flex w-full justify-between gap-2">
                        <span class="uppercase w-full text-justify mt-2">
                            Palabras totales: <span class="text-indigo-500 font-semibold">{{ palabras.length }}</span>
                        </span>
                        <span class="uppercase w-full text-justify mt-2">
                            Palabras correctas: <span class="text-indigo-500 font-semibold">{{ totalPalabrasCorrectas }}</span>
                        </span>
                    </div>
                    <div class="flex w-full justify-between gap-2">
                        <span class="uppercase w-full text-justify">
                            Tiempo transcurrido: <span class="text-indigo-500 font-semibold">{{ tiempo_transcurrido }} segundos</span>
                        </span>
                        <span class="uppercase w-full text-justify">
                            Palabras por minuto: <span class="text-indigo-500 font-semibold">{{ PPM.toFixed(2) }}</span>
                        </span>
                    </div>

                </div>
            </template>
            <template v-slot:action-button>
                <button type="button" class="bg-gray-500 hover:bg-gray-500/90 text-white shadow-sm rounded-md p-2"
                    @click="endGame">
                    Salir del modo práctica
                </button>
                <button type="button" class="bg-indigo-500 hover:bg-indigo-500/90 text-white shadow-sm rounded-md p-2"
                    @click="reinitGame">
                    Volver a jugar
                </button>
            </template>
        </Modal>
        <div class="flex flex-col px-20 w-full">
            <div class="flex flex-col w-full text-center justify-center">
                <h1 class="font-semibold text-2xl uppercase text-indigo-700 underline underline-offset-4">Modo práctica</h1>
                <span class="text-base uppercase font-semibold mt-4">
                    Tiempo transcurrido: <span class="text-indigo-500">{{ tiempo_transcurrido }}</span>
                </span>
            </div>
            <Separator/>
            <div class="grid w-full h-full p-8 bg-gray-700 text-gray-400 rounded-md shadow-md">
                <section id="juego">
                    <p id="contenido_juego" class="uppercase text-6xl transition-colors duration-100 ease-in-out flex flex-wrap w-full items-center justify-center gap-2">
                        <transition-group name="slide">
                            <span v-for="(palabra, palabraIndex) in palabras" v-show="palabraIndex === palabraActualIndex"
                                  :key="palabraIndex"
                                  class="word"
                                  :class="{
                                      'current': palabraIndex === palabraActualIndex,
                                      'correct': esPalabraCorrecta(palabraIndex),
                                      'incorrect': !esPalabraCorrecta(palabraIndex) && palabraIndex < palabraActualIndex
                                  }">
                                <span v-for="(letra, letraIndex) in palabra.split('')"
                                      :key="letraIndex"
                                      class="letter"
                                      :class="{
                                          'current': letraIndex === letraActualIndex && palabraIndex === palabraActualIndex,
                                          'correct': esLetraCorrecta(palabraIndex, letraIndex) && palabraIndex === palabraActualIndex,
                                          'incorrect': !esLetraCorrecta(palabraIndex, letraIndex) && palabraIndex === palabraActualIndex && letraIndex < letraActualIndex
                                      }">
                                    {{ letra }}
                                </span>
                            </span>
                        </transition-group>
                    </p>
                    <input v-model="input_usuario"
                           @keydown="onKeyDown"
                           @keyup="onKeyUp"
                           ref="$input"
                           type="text"
                           class="absolute top-0 left-0 opacity-0"
                           autofocus>
                </section>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
span.letter {
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

span.letter.correct {
    color: white;
}

span.letter.incorrect {
    color: red;
}

span.word {
    display: flex;
}

/* span.word.current {
    text-decoration: underline;
} */

span.word.correct {
    color: white;
}

span.word.incorrect {
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

.slide-enter-active {
    transition: all 0.5s ease;
}

.slide-enter-from {
    opacity: 0;
    transform: translateY(30px);
}

</style>
