<script setup>
import { AcademicCapIcon, ChevronDoubleRightIcon, ChevronRightIcon, PaperAirplaneIcon, PencilIcon, RocketLaunchIcon } from '@heroicons/vue/24/outline';
</script>

<template>
    <div>

        <div class="p-6 lg:p-8 bg-indigo-600 text-center">

            <h1 class="mt-8 text-7xl font-medium text-gray-900">
                Bienvenido a 
                <h1 class="font-extrabold text-indigo-300">
                    Érase una vez!
                </h1>
            </h1>
    
        </div>

        <!-- Espacio para listado de actividades-->
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            
            <!-- Lado izquierdo-->
            <div class="bg-indigo-100 rounded-xl flex items-center">
                <img src="\images\typing.png">
                <!-- <a href="https://storyset.com/communication">Communication illustrations by Storyset</a> -->
            </div>
            
            <!-- Lado derecho-->
            <!-- Contiene los espacios para los textos y sus "enlaces" correspondientes-->
            <div class="space-y-3">

                <!-- Division para el espacio de Cursos-->
                <div class="bg-indigo-100 rounded-xl p-3">

                    <div class="flex items-center">

                        <AcademicCapIcon class="stroke-indigo-500 h-20 w-20"></AcademicCapIcon>

                        <h2 class="ms-3 text-4xl font-semibold text-indigo-500">
                            Cursos
                        </h2>

                    </div>

                    <p class="mt-4 text-gray-900 text-lg leading-normal font-medium p-5">
                        Los tutores podrán asignar textos a sus alumnos para apoyar el desarrollo de las habilidades de los alumnos.
                        Los alumnos podrán ingresar a cursos que les brindaran apoyo en el desarrollo de sus habilidades de escritura.
                    </p>

                    <button type="button" class="font-semibold mt-4 text-base inline-flex items-center text-indigo-500 hover:text-indigo-800">
                        <PaperAirplaneIcon class="h-6 w-12 inline-flex items-center"></PaperAirplaneIcon>
                        Explorar cursos disponibles
                    </button>
                
                </div>

                <!-- Division para el espacio de cuentos -->
                <div class="bg-indigo-100 rounded-xl p-3">

                    <div class="flex items-center">

                        <PencilIcon class="stroke-indigo-500 h-20 w-20"></PencilIcon>

                        <h2 class="ms-3 text-4xl font-semibold text-indigo-500">
                            Cuentos
                        </h2>

                    </div>

                    <p class="mt-4 text-gray-900 text-lg leading-normal font-medium p-5">
                        Pon a prueba tus habilidades de escritura con el modo "Cuentos" donde podrás encontrar una seleccián de historias con las cuales pondrás a volar la imaginación.
                    </p>

                    <button type="button" class="font-semibold mt-4 text-base inline-flex items-center text-indigo-500 hover:text-indigo-800">
                        <PaperAirplaneIcon class="h-6 w-12 inline-flex items-center"></PaperAirplaneIcon>
                        Explorar cuentos disponibles
                    </button>

                </div>

                <!-- Division para el espacio de Modo Practica-->
                <div class="bg-indigo-100 rounded-xl p-3">

                    <div class="flex items-center">

                        <RocketLaunchIcon class="stroke-indigo-500 h-20 w-20"></RocketLaunchIcon>

                        <h2 class="ms-3 text-4xl font-semibold text-indigo-500">
                            Modo practica
                        </h2>

                    </div>

                    <p class="mt-4 text-gray-900 text-lg font-medium leading-normal p-5">
                        Mejora tu habilidad y vocabulario dentro de este modo con una serie de palabras las cuales aumentaran su dificultad conforme aumente tu desempeño.
                    </p>

                    <button type="button" class="font-semibold mt-4 text-base inline-flex items-center text-indigo-500 hover:text-indigo-800">
                        <PaperAirplaneIcon class="h-6 w-12 inline-flex items-center"></PaperAirplaneIcon>
                        Comienza a practicar
                    </button>

                </div>
            
            </div>
            
        </div>
        
    </div>
</template>
