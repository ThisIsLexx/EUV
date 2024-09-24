<script setup>
import { AcademicCapIcon, ChevronDoubleRightIcon, ChevronRightIcon, PaperAirplaneIcon, PencilIcon, RocketLaunchIcon } from '@heroicons/vue/24/outline';
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

            <h1 class="mt-8 text-7xl font-medium text-gray-900">
                Bienvenido a 
                <h1 class="font-extrabold text-indigo-600">
                    Érase una vez!
                </h1>
            </h1>
    
        </div>

        <!-- Espacio para listado de actividades(?)-->

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            
            <!-- Lado izquierdo-->
            <div class="bg-indigo-600">
                <h1>IMAGEN</h1>
            </div>
            
            <!-- Lado derecho-->
            <!-- Contiene los espacios para los textos y sus "enlaces" correspondientes-->
            <div class="space-y-3">
                <!-- Division para el espacio de Cursos-->
                <div>
                    <div class="flex items-center">

                        <AcademicCapIcon class="stroke-indigo-500 h-24 w-24"></AcademicCapIcon>

                        <h2 class="ms-3 text-4xl font-semibold text-indigo-500">
                            Cursos
                        </h2>

                    </div>

                    <div class="columns-2 flex items-center px-0">
                        
                        <p class="mt-4 text-gray-900 text-sm leading-loose font-medium p-5 text-justify">
                            MENSAJE PARA TUTOR?? minus reiciendis ratione voluptatibus aspernatur odit, expedita consectetur eveniet! Assumenda, quae asperiores!
                        </p>

                        <p class="mt-4 text-gray-900 text-sm leading-loose font-medium p-5 text-justify">
                            MENSAJE PARA USUARIO?? minus reiciendis ratione voluptatibus aspernatur odit, expedita consectetur eveniet! Assumenda, quae asperiores!
                        </p>

                    </div>

                    <button type="button" class="font-semibold mt-4 text-sm inline-flex items-center text-indigo-500 hover:text-indigo-800">
                        <PaperAirplaneIcon class="h-6 w-12 inline-flex items-center"></PaperAirplaneIcon>
                        MENSAJE PARA IR A SECCION
                    </button>
                
                </div>

                <!-- Division para el espacio de cuentos -->
                <div>
                    <div class="flex items-center">

                        <PencilIcon class="stroke-indigo-500 h-24 w-24"></PencilIcon>

                        <h2 class="ms-3 text-4xl font-semibold text-indigo-500">
                            Cuentos
                        </h2>

                    </div>

                    <p class="mt-4 text-gray-900 text-sm leading-loose font-medium text-justify p-5">
                        MENSAJE PARA USUARIO?? minus pariatur tempore repellendus consectetur, unde vitae consequuntur quam alias rem, dolorem cupiditate consequatur sunt numquam ducimus et.
                    </p>

                    <button type="button" class="font-semibold mt-4 text-sm inline-flex items-center text-indigo-500 hover:text-indigo-800">
                        <PaperAirplaneIcon class="h-6 w-12 inline-flex items-center"></PaperAirplaneIcon>
                        MENSAJE PARA IR A SECCION
                    </button>

                </div>

                <!-- Division para el espacio de Modo Practica-->
                <div>
                    <div class="flex items-center">

                        <RocketLaunchIcon class="stroke-indigo-500 h-24 w-24"></RocketLaunchIcon>

                        <h2 class="ms-3 text-4xl font-semibold text-indigo-500">
                            Modo practica
                        </h2>

                    </div>

                    <p class="mt-4 text-gray-900 text-sm font-medium leading-loose text-justify p-5">
                        MENSAJE PARA USUARIO?? accusamus recusandae excepturi? Earum suscipit libero nemo consequuntur totam sed, quisquam odit incidunt magni cupiditate aliquid, nisi unde. Itaque, nostrum maiores.
                    </p>

                    <button type="button" class="font-semibold mt-4 text-sm inline-flex items-center text-indigo-500 hover:text-indigo-800">
                        <PaperAirplaneIcon class="h-6 w-12 inline-flex items-center"></PaperAirplaneIcon>
                        MENSAJE PARAIR A SECCION
                    </button>

                </div>
            
            </div>
            
        </div>
    </div>
</template>
