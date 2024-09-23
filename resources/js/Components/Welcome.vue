<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import TextInput from './TextInput.vue';
import { AcademicCapIcon, PencilIcon, RocketLaunchIcon } from '@heroicons/vue/24/outline';
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

            <ApplicationLogo class="block h-12 w-auto" />

            <h1 class="mt-8 text-2xl font-medium text-gray-900">
                Bienvenido a Erase una vez
            </h1>
            


        </div>
        <!-- Espacio para listado de actividades(?)-->
        <!-- colores temporales-->
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            
            <div>
                <h1>seccion nueva??</h1>
                <h6>quiza una imagen como el ejemplo</h6>
            </div>

            <div>
                <div>
                    <div class="flex items-center">
                        <AcademicCapIcon class="stroke-cyan-500 h-24 w-24"></AcademicCapIcon>
                        <h2 class="ms-3 text-xl font-semibold text-gray-900">
                            <a href="https://laravel.com/docs">Cursos</a>
                        </h2>
                    </div>

                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse vel cumque ab doloremque recusandae illo nam enim impedit minus reiciendis ratione voluptatibus aspernatur odit, expedita consectetur eveniet! Assumenda, quae asperiores!
                    </p>

                    <p class="mt-4 text-sm">
                        <a href="https://laravel.com/docs" class="inline-flex items-center font-semibold text-indigo-700">
                            ENLACE????
                        </a>
                    </p>
                </div>

                <div>
                    <div class="flex items-center">
                        <PencilIcon class="stroke-cyan-100 h-12 w-12"></PencilIcon>
                        <h2 class="ms-3 text-xl font-semibold text-gray-900">
                            <a href="https://laracasts.com">Mecanografía</a>
                        </h2>
                    </div>

                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus quos ratione, totam minus pariatur tempore repellendus consectetur, unde vitae consequuntur quam alias rem, dolorem cupiditate consequatur sunt numquam ducimus et.
                    </p>

                    <p class="mt-4 text-sm">
                        <a href="https://laracasts.com" class="inline-flex items-center font-semibold text-indigo-700">
                            ENLACE????
                        </a>
                    </p>
                </div>

                <div>
                    <div class="flex items-center">
                        <RocketLaunchIcon class="stroke-cyan-200 h-16 w-16"></RocketLaunchIcon>
                        <h2 class="ms-3 text-xl font-semibold text-gray-900">
                            <a href="https://tailwindcss.com/">Vocaculario</a>
                        </h2>
                    </div>

                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi accusamus recusandae excepturi? Earum suscipit libero nemo consequuntur totam sed, quisquam odit incidunt magni cupiditate aliquid, nisi unde. Itaque, nostrum maiores.
                    </p>

                    <p class="mt-4 text-sm">
                        <a href="https://laracasts.com" class="inline-flex items-center font-semibold text-indigo-700">
                            ENLACE????
                        </a>
                    </p>
                </div>
                <!--
            <div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                    <h2 class="ms-3 text-xl font-semibold text-gray-900">
                        Authentication
                    </h2>
                </div>

                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                    Authentication and registration views are included with Laravel Jetstream, as well as support for user email verification and resetting forgotten passwords. So, you're free to get started with what matters most: building your application.
                </p>
            </div>
             -->
            </div>
            
        </div>
    </div>
</template>
