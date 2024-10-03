<script setup>
import { router } from '@inertiajs/vue3';
import { AcademicCapIcon, ChevronDoubleRightIcon, ChevronRightIcon, PaperAirplaneIcon, PencilIcon, RocketLaunchIcon } from '@heroicons/vue/24/outline';
</script>

<template>
    <transition appear name="left-to-right">
        <div>
            <div class="p-2 bg-indigo-600 text-center flex items-center justify-center">
                <div class="m-8 columns-xl">
                    <h1 class="mt-4 mb-2 text-6xl text-slate-50">
                        Bienvenido a <h1 class="mb-4 mt-2 font-extrabold text-6xl text-slate-50">Érase una vez!</h1>
                    </h1>
                </div>
            </div>
            <!-- Espacio para listado de actividades-->
            <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                <!-- Lado izquierdo-->
                <div class="bg-indigo-100/60 shadow-md transition-all duration-300 ease-in-out hover:bg-indigo-100 rounded-xl flex items-center">
                    <img src="\images\typing.png">
                    <!-- <a href="https://storyset.com/communication">Communication illustrations by Storyset</a> -->
                </div>
                <!-- Lado derecho-->
                <!-- Contiene los espacios para los textos y sus "enlaces" correspondientes-->
                <div class="space-y-3">
                    <!-- Division para el espacio de Cursos-->
                    <div class="bg-indigo-100/60 shadow-md transition-all duration-300 ease-in-out hover:bg-indigo-100 rounded-xl p-3">
                        <div class="flex items-center px-2 pt-2">
                            <AcademicCapIcon class="stroke-indigo-500 h-20 w-20"></AcademicCapIcon>
                            <h2 class="ms-3 text-4xl font-semibold text-indigo-500">
                                Cursos
                            </h2>
                        </div>
                        <p class="flex flex-col text-gray-900 text-lg leading-normal font-medium p-4 text-justify">
                            <span class="text-indigo-600 mt-2">
                                ¿Eres un tutor?
                            </span>
                            <span>
                                asigna textos a tus alumnos para apoyar el desarrollo de sus habilidades en
                                mecanografía.
                            </span>
                            <span class="text-indigo-600 mt-2">
                                ¿Eres un estudiante?
                            </span>
                            <span>
                                Los alumnos podrán ingresar a cursos que les brindaran apoyo en el desarrollo de sus habilidades
                                de escritura.
                            </span>
                        </p>
                        <button type="button"
                            class="font-semibold mt-4 text-base inline-flex items-center text-indigo-500 hover:text-indigo-800">
                            <PaperAirplaneIcon class="h-6 w-12 inline-flex items-center"></PaperAirplaneIcon>
                            Explorar cursos disponibles
                        </button>
                    </div>
                    <!-- Division para el espacio de cuentos -->
                    <div class="bg-indigo-100/60 shadow-md transition-all duration-300 ease-in-out hover:bg-indigo-100 rounded-xl p-3">
                        <div class="flex items-center px-2 pt-2">
                            <PencilIcon class="stroke-indigo-500 h-20 w-20"></PencilIcon>
                            <h2 class="ms-3 text-4xl font-semibold text-indigo-500">
                                Cuentos
                            </h2>
                        </div>
                        <p class="text-gray-900 text-lg leading-normal font-medium p-4 text-justify">
                            Pon a prueba tus habilidades de escritura con una amplia selección de cuentos previamente
                            seleccionados, encontrando historias con las cuales pondrás a volar  imaginación.
                        </p>
                        <button type="button"
                            class="font-semibold mt-4 text-base inline-flex items-center text-indigo-500 hover:text-indigo-800">
                            <PaperAirplaneIcon class="h-6 w-12 inline-flex items-center"></PaperAirplaneIcon>
                            Explorar cuentos disponibles
                        </button>
                    </div>
                    <!-- Division para el espacio de Modo Practica-->
                    <div class="bg-indigo-100/60 shadow-md transition-all duration-300 ease-in-out hover:bg-indigo-100 rounded-xl p-3">
                        <div class="flex items-center px-2 pt-2">
                            <RocketLaunchIcon class="stroke-indigo-500 h-20 w-20"></RocketLaunchIcon>
                            <h2 class="ms-3 text-4xl font-semibold text-indigo-500">
                                Modo practica
                            </h2>
                        </div>
                        <p class="text-gray-900 text-lg font-medium leading-normal p-4 text-justify">
                            Mejora tu habilidad y vocabulario dentro de este modo con una serie de palabras las cuales
                            aumentaran su dificultad conforme aumente tu desempeño.
                        </p>
                        <button type="button" @click="router.get(route('practice'))"
                            class="font-semibold mt-4 text-base inline-flex items-center text-indigo-500 hover:text-indigo-800">
                            <PaperAirplaneIcon class="h-6 w-12 inline-flex items-center"></PaperAirplaneIcon>
                            Comienza a practicar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
