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

let palabras = [];
const $contenido = ref<HTMLElement | null>(null);
const $input = ref<HTMLInputElement | null>(null);

function iniciarJuego() {
    // Definimos las palabras del texto
    palabras = props.cuento.contenido.split(' ').slice(0,32);

    // Mostramos las palabras en el DOM haciendo map para separar cada palabra y de
    // cada palabra, cada una de sus letras.
    $contenido.value.innerHTML = palabras.map((palabra, index) => {
        const letras = palabra.split('');

        return `<word>
            ${letras
                .map(letra => `<letter>${letra}</letter>`)
                .join('')
            }
        </word>
        `
    }).join('');

    const $primera_palabra = $contenido.value.querySelector('word');
    $primera_palabra.classList.add('font-semibold');
    $primera_palabra.querySelector('letter').classList.add('bg-gray-200');

}

function iniciarEventos() {
    document.addEventListener('keydown', () => {
        $input.value.focus();
    });
    document.addEventListener('keyup', (e) => {
        console.log(e.key);

        if (e.key === $primera_palabra.querySelector('letter').textContent) {
            texto.value = '';
        }

    });
}

onMounted(() => {
    $contenido.value = document.querySelector('#contenido_juego');
    $input.value = document.querySelector('input');
    iniciarJuego();
    iniciarEventos();
});
</script>

<template>
    <AppLayout :breadcrumbs="props.breadcrumbs">
        <div class="flex flex-col w-full text-center justify-center">
            <h1 class="font-semibold text-2xl uppercase">{{props.cuento.titulo}}</h1>
            <span class="text-xs uppercase font-semibold">
                Mejor score: {{ texto }}
            </span>
        </div>
        <Separator/>

        <div class="grid w-full h-full p-8 bg-gray-700 rounded-md shadow-md">
            <section id="juego">
                <p id="contenido_juego" class="uppercase"></p>
                <input v-model="texto" type="text" class="absolute top-0 left-0" autofocus>
            </section>
        </div>
    </AppLayout>
</template>
