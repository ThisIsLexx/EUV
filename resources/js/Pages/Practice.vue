<script setup lang="ts">
import { onMounted, ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import Separator from '@/Components/Separator.vue';

const texto = ref('Hola, soy un ejemplo de texto');
const $input = ref<HTMLInputElement | null>(null);
const palabras = ref<Array<string>>([]);

const palabrasUsuario = ref<Array<string>>([]);

const tiempo_transcurrido = ref(0);

const palabraActualIndex = ref(0); // Indice de la palabra actual
const letraActualIndex = ref(0); // Indice de la letra actual

const input_usuario = ref('');

onMounted(() => {
    iniciarJuego();
    startTimer();
    $input.value?.focus();
});

function startTimer() {
    setInterval(() => {
        tiempo_transcurrido.value++;
    }, 1000);
}

function iniciarJuego() {
    palabras.value = texto.value.split(' ');
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

    const palabraActual = palabras.value[palabraActualIndex.value];
    const letraIndex = letraActualIndex.value;

    letraActualIndex.value++;

    // Si se llega al final de la palabra actual
    if (letraActualIndex.value >= palabraActual.length) {
        palabraActualIndex.value++;
        letraActualIndex.value = 0;
        palabrasUsuario.value.push(input_usuario.value.trim());
        input_usuario.value = ''; // Limpiar la entrada para la siguiente palabra
    }
}

function esLetraCorrecta(palabraIndex: number, letraIndex: number): boolean {
    const palabraActual = palabras?.value[palabraIndex];
    const letraUsuario = input_usuario.value[letraIndex]?.toLowerCase();
    const letraCorrecta = palabraActual[letraIndex]?.toLowerCase();
    return letraUsuario === letraCorrecta;
}

function esPalabraCorrecta(palabraIndex: number): boolean {
    return palabrasUsuario.value[palabraIndex] === palabras.value[palabraIndex];
}
</script>

<template @keydown="$input.value?.focus()">
    <Head title="Modo Práctica" />
    <AppLayout>
        <div class="flex flex-col px-20 w-full">
            <div class="flex flex-col w-full text-center justify-center">
                <h1 class="font-semibold text-2xl uppercase text-indigo-700 underline underline-offset-4">Modo práctica</h1>
                <span class="text-base uppercase font-semibold">
                    Tiempo transcurrido: <span class="text-indigo-500">{{ tiempo_transcurrido }}</span>
                </span>
                <span class="text-base uppercase font-semibold mt-4">
                    Palabra actual: <span class="text-indigo-500">{{ palabras[palabraActualIndex] }} </span>
                </span>
                <span class="text-base uppercase font-semibold mt-4">
                    Input:
                    {{ $input?.value }}
                </span>
            </div>
            <Separator/>
            <div class="grid w-full h-full p-8 bg-gray-700 text-gray-400 rounded-md shadow-md">
                <section id="juego">
                    <p id="contenido_juego" class="uppercase text-6xl transition-colors duration-100 ease-in-out flex flex-wrap w-full items-center justify-center gap-2">
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
</style>
