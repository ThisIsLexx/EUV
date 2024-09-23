<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Cuento } from '@/types/cuento';
import AppLayout from '@/Layouts/AppLayout.vue';
import Separator from '@/Components/Separator.vue';
import { Breadcrumb } from '@/types/breadcrumb';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({
    cuento: Object as () => Cuento,
    breadcrumbs: Array<Breadcrumb>,
});

let texto = ref('');
let palabras = ref<Array<HTMLElement | null>>([]);
const $contenido = ref<HTMLElement | null>(null);
const $input = ref<HTMLInputElement | null>(null);

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
    const $letra_actual = $palabra_actual.querySelector('letter.current');

    const { key } = event;
    if (key === ' ') {
        event.preventDefault();
        const $nextPalabra = $palabra_actual?.nextElementSibling as HTMLElement;
        if ($nextPalabra) {
            $palabra_actual.classList.remove('current');
            $nextPalabra.classList.add('current');

            const $nextLetra = $nextPalabra.querySelector('letter');
            if ($nextLetra) {
                $letra_actual.classList.remove('current');
                $nextLetra.classList.add('current');
            }
            $input.value!.value = '';
        } else {
            console.log("juego terminado");
            // TODO GAMEOVER
        }
    }
    if (key === 'Backspace') {
        if ($input.value.value === '') {
            event.preventDefault();
            const $prevPalabra = $palabra_actual?.previousElementSibling as HTMLElement;
            if ($prevPalabra) {
                $palabra_actual.classList.remove('current');
                $prevPalabra.classList.add('current');
                $input.value.innerText = $prevPalabra.textContent?.trim() || '';

                const $prevLetra = $prevPalabra.querySelector('letter');
                if ($prevLetra) {
                    $letra_actual.classList.remove('current');
                    $prevLetra.classList.add('current');
                }
                $input.value!.value = '';
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
                $letra.classList.add('current');
                const letra_a_comparar = palabra_actual[index];
                const es_correcta = letra.toLowerCase() === letra_a_comparar.toLowerCase();
                const letterClass = es_correcta ? 'correct' : 'incorrect';
                $letra.classList.add(letterClass);
            }
        });
        $letra_actual?.classList.remove('current', 'is-last');
        const inputLength = inputValue.length;
        const $nextActiveLetra = todas_las_letras[inputLength];
        if ($nextActiveLetra) {
            $nextActiveLetra.classList.add('current');
        } else {
            $letra_actual.classList.add('current', 'is-last');
            // TODO GAMEOVER
        }
    }
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
        <div class="flex flex-col w-full text-center justify-center">
            <h1 class="font-semibold text-2xl uppercase">{{ cuento.titulo }}</h1>
            <span class="text-xs uppercase font-semibold">
                Mejor score: {{ texto }}
            </span>
        </div>
        <Separator/>

        <div class="grid w-full h-full p-8 bg-gray-700 rounded-md shadow-md">
            <section id="juego">
                <p id="contenido_juego" class="uppercase flex flex-wrap gap-1"></p>
                <input v-model="texto" type="text" class="absolute top-0 left-0" autofocus>
            </section>
        </div>
    </AppLayout>
</template>

<style>

letter {
    position: relative;
    /* &.current::before {
        content: '|';
        position: absolute;
        left: -45%;
        animation: 1s blink infinite ease-in-out;
    }
    &.current.is-last::before {
        left: 45%;
    } */
}

letter.correct {
    color: white;
}

letter.incorrect {
    color: red;
}

word.current {
    text-decoration: underline;
}

/* @keyframes blink {
        0%, 25% {
            opacity: 1;
        }
        75% {
            opacity: 0;
        }
    } */

</style>
