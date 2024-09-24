<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Cuento } from '@/types/cuento';
import AppLayout from '@/Layouts/AppLayout.vue';
import Separator from '@/Components/Separator.vue';
import { Breadcrumb } from '@/types/breadcrumb';
import { Head, Link, router } from '@inertiajs/vue3';
import Modal from '@/Components/Custom/Modal.vue';

const props = defineProps({
    cuento: Object as () => Cuento,
    breadcrumbs: Array<Breadcrumb>,
});

let texto = ref('');
let tiempo = ref('00:00');
let palabras = ref<Array<string>>([]);
const $contenido = ref<HTMLElement | null>(null);
const $input = ref<HTMLInputElement | null>(null);

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
            console.log("juego terminado");
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

function gameOver() {
    const total_palabras = palabras.value.length;
    const palabras_correctas = $contenido.value?.querySelectorAll('word.correct').length;
    const score = (palabras_correctas / total_palabras) * 100;

    console.log({ total_palabras, palabras_correctas, score });
    showResultModal.value = true;
}

onMounted(() => {
    $contenido.value = document.querySelector('#contenido_juego');
    $input.value = document.querySelector('input');
    iniciarJuego();
    iniciarEventos();
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <Modal :showModal="showResultModal" size="lg" :titulo="`Resultados: ${cuento.titulo}`" @closeModal="showResultModal = false;">
            <template v-slot:modal-content>

            </template>

            <template v-slot:action-button>
            <button class="bg-indigo-500 hover:bg-indigo-500/90 text-white shadow-sm rounded-md px-2">
                Siguiente
            </button>
            </template>
        </Modal>

        <div class="flex flex-col px-20 w-full">
            <div class="flex flex-col w-full text-center justify-center">
                <h1 class="font-semibold text-2xl uppercase">{{ cuento.titulo }}</h1>
                <span class="text-xs uppercase font-semibold">
                    Tiempo transcurrido: {{ tiempo }}
                </span>
                <span class="text-xs uppercase font-semibold">
                    Mejor score: {{ texto }}
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
