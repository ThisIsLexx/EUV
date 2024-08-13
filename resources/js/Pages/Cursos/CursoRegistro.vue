<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { Breadcrumb } from '@/types/breadcrumb';
import { Curso } from '@/types/curso';
import { ref, onMounted } from 'vue';

import Separator from '@/Components/Separator.vue';
import Modal from '@/Components/Custom/Modal.vue';

const props = defineProps({
    titulo: {
        type: String,
        required: true
    },
    breadcrumbs: Array<Breadcrumb>,
    mis_cursos: Array<Curso>,
});


let showModal = ref(false);
let crearCurso = ref(false);

function unirseCurso() {
    form.post(route('curso.unirse', form), {
        onSuccess: () => {
            showModal.value = false;
        }
    });
}

function verCurso(curso: Curso) {
    router.get(route('curso.show', curso));
}

const form = useForm({
    codigo: null,
});

</script>

<template>
    <AppLayout :breadcrumbs="props.breadcrumbs">
        <div>
            <h1>{{props.titulo}}</h1>
        </div>
        <Separator />

        <!-- INICIO: Modal unirse a curso -->
        <Modal :showModal="showModal" size="lg" titulo="Unirme a curso" @closeModal="showModal = false">
            <template v-slot:modal-content class="flex flex-col">
                <div class="flex flex-col justify-center text-center items-center">
                    <label for="titulo" class="mb-2">Código del curso<span
                            class="text-red-500 font-semibold">*</span></label>
                    <input type="text" name="titulo"
                        class="transition duration-100 rounded-md border-gray-300 shadow-sm focus:ring-indigo-200 focus:border-indigo-200"
                        :class="{ 'border-red-600': form.errors.codigo }" v-model="form.codigo">
                    <div v-if="form.errors.codigo" class="text-red-500 text-xs uppercase mt-2">
                        {{ form.errors.codigo }}
                    </div>
                </div>
            </template>
            <template v-slot:action-button>
                <button @click="unirseCurso()"
                    class="bg-indigo-500 hover:bg-indigo-500/90 text-white shadow-sm rounded-md px-2">
                    Unirme
                </button>
            </template>
        </Modal>
        <!-- END: Modal unirse a curso -->

        <!-- INICIO: Modal creación de curso -->
        <Modal :showModal="crearCurso" size="lg" titulo="Crear nuevo curso" @closeModal="crearCurso = false">
            <template v-slot:modal-content class="flex flex-col">
                <div>

                </div>
            </template>
        </Modal>
        <!-- END: Modal creación de curso -->
        <div v-if="mis_cursos.length === 0"
            class="flex flex-col space-y-4 items-center justify-center content-center h-[384px] w-full">
            Vaya! Parece que no tienes cursos registrados...
            <button @click="showModal = true" type="button"
                class="mt-2 bg-indigo-500 hover:bg-indigo-500/90 text-white p-2 rounded-md shadow-sm hover:shadow-md">Registrarme!</button>
        </div>
        <div v-else>
            <div class="p-5">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Mis cursos</h2>
                    <div class="flex space-x-2">
                        <transition appear name="slide-fade">
                            <button @click="showModal = true" type="button"
                                class="bg-indigo-500 hover:bg-indigo-500/90 text-white p-2 rounded-md shadow-sm hover:shadow-md">
                                Registrar nuevo curso
                            </button>
                        </transition>
                        <transition appear name="slide-fade" :style="{ transitionDelay: '200ms' }">
                            <button @click="crearCurso = true" type="button"
                                class="bg-blue-500 hover:bg-blue-500/90 text-white p-2 rounded-md shadow-sm hover:shadow-md">
                                Crear nuevo curso
                            </button>
                        </transition>
                    </div>
                </div>
                <Separator />
            </div>
            <div class="w-full grid grid-cols-3 gap-2">
                <div v-for="curso in mis_cursos" :key="curso.id" class="rounded-md border-2">
                    <div class="bg-white shadow-sm hover:shadow-md p-5 cursor-pointer h-full w-full transition ease-in-out duration-300 hover:text-indigo-500 hover:shadow-indigo-500/30" @click="verCurso(curso)">
                        <h3 class="text-lg font-semibold">{{ curso.titulo }}</h3>
                        <p class="text-sm">{{ curso.descripcion }}</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
