<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { Breadcrumb } from '@/types/breadcrumb';
import { Curso } from '@/types/curso';
import { ref, watch } from 'vue';
import { EllipsisVerticalIcon } from '@heroicons/vue/20/solid';
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
let showMenu = ref(false);
let currentCurso = ref(null);
let showSecondTransition = ref(false);

function unirseCurso() {
    form.post(route('curso.unirse', form), {
        onSuccess: () => {
            showModal.value = false;
            currentCurso.value = null;
            showMenu.value = false;
        }
    });
}

function verCurso(curso: Curso) {
    router.get(route('curso.show', curso));
}

function cancelarRegistro(curso_id: number) {
    router.post(route('curso.cancelar', curso_id));
    console.log('Cancelar registro', curso_id);
}

function toggleShowMenu(curso_id: number) {

    // console.log(currentCurso.value, curso_id);
    if (currentCurso.value !== curso_id) {
        showMenu.value = true;
        currentCurso.value = curso_id;
        return;
    }
    showMenu.value = !showMenu.value;
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
        <Modal :showModal="showModal" size="sm" titulo="Unirme a curso" @closeModal="showModal = false">
            <template v-slot:modal-content class="flex flex-col">
                <div class="flex flex-col justify-start">

                    <div class="flex flex-col">
                        <span>
                            Accediste como
                        </span>
                        <span class="text-gray-600 text-sm">
                            {{ $page.props.auth.user.name }} - {{ $page.props.auth.user.email }}
                        </span>
                    </div>

                    <Separator />

                    <label for="titulo" class="">Código del curso<span
                            class="text-red-500 font-semibold">*</span></label>
                    <span class="text-gray-600 text-sm mb-2">Pídele a tu tutor el código de la clase para ingresarlo aquí.</span>
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
                    class="mt-2 bg-indigo-500 hover:bg-indigo-500/90 text-white p-2 px-6 transition-all ease-in-out duration-300 rounded-md shadow-sm hover:shadow-md shadow-gray-400">Unirme a un curso</button>
            </div>
            <div v-else>
                <div class="p-5">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-semibold">Mis cursos</h2>
                        <div class="flex space-x-2">
                            <transition appear name="slide-fade">
                                <button @click="showModal = true; showMenu = false" type="button"
                                    class="bg-indigo-500 hover:bg-indigo-500/90 text-white p-2 rounded-md shadow-sm hover:shadow-md">
                                    Registrar nuevo curso
                                </button>
                            </transition>
                            <transition appear name="slide-fade">
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
                    <TransitionGroup name="list">
                        <div v-for="curso in mis_cursos" :key="curso.id" class="rounded-md relative border-2 group bg-white shadow-sm hover:shadow-md transition ease-in-out duration-300  hover:text-indigo-500 hover:shadow-indigo-500/30">
                            <!-- BEGIN: Más opciones -->
                            <div class="absolute top-0 right-0 p-2">
                                <div class="flex">
                                    <button @click="toggleShowMenu(curso.id)"
                                        class="transition-all ease-in-out duration-300 text-gray-500 hover:text-indigo-500/90 hover:scale-105 text-2xl p-2 z-40">
                                        <EllipsisVerticalIcon class="w-6 h-6" />
                                    </button>
                                </div>
                                <transition
                                    enter-active-class="transition ease-in-out duration-300"
                                    leave-active-class="transition ease-in-out duration-300"
                                    enter-from-class="opacity-0"
                                    leave-from-class="opacity-100"
                                    enter-to-class="opacity-100"
                                    leave-to-class="opacity-0"
                                    >
                                    <div v-if="showMenu && currentCurso === curso.id" class="absolute right-2 mt-2 w-40 bg-white rounded-md shadow-lg z-40">
                                        <ul class="py-1">
                                            <li>
                                                <div @click="cancelarRegistro(curso.id)" class="transition-all ease-in-out duration-200 block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300 cursor-pointer">
                                                    Cancelar registro
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </transition>
                            </div>


                            <!-- BEGIN: Imagen de curso -->
                            <div class="h-40 overflow-hidden">
                                <img src="/images/login.jpg" alt="Curso Cover" class="h-full w-full object-cover rounded-t-md transition-all duration-300 transform brightness-50 group-hover:brightness-100" />
                            </div>
                            <!-- END: Imagen de curso -->

                            <Separator margin="m-0"/>

                            <!-- BEGIN: Información del curso -->
                            <div class="py-2 px-5 cursor-pointer w-full" @click="verCurso(curso)">
                                <h3 class="text-lg font-semibold">{{ curso.titulo }}</h3>
                                <p class="text-sm">{{ curso.descripcion }}</p>
                            </div>
                            <!-- END: Información del curso -->
                        </div>
                    </TransitionGroup>
                </div>
            </div>
    </AppLayout>
</template>

<style>
+

.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}
</style>
