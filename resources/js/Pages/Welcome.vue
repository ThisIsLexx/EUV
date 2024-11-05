<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { AcademicCapIcon } from '@heroicons/vue/24/outline';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}

function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: "smooth" });
    }
}

</script>

<template>

    <Head title="Bienvenida" />
    <div class="relative w-full">
        <nav class="fixed z-10 w-full bg-white md:absolute md:bg-transparent">
            <div class="container m-auto px-2 md:px-12 lg:px-7">
                <div class="flex flex-wrap items-center justify-between py-3 gap-6 md:py-4 md:gap-0">
                    <div class="w-full px-6 flex justify-between lg:w-max md:px-0">
                        <a href="https://github.com/ThisIsLexx/EUV" aria-label="logo"
                            class="flex space-x-2 items-center">
                            <!-- <img src="https://tailus.io/sources/blocks/food-delivery/preview/images/icon.png"
                                class="w-12" alt="tailus logo" width="144" height="133"> -->
                            <span class="text-2xl font-bold text-indigo-500 flex items-center gap-2 group hover:text-indigo-400">
                                <AcademicCapIcon class="w-8 h-8 text-indigo-500 group-hover:text-indigo-400" />
                                <span>
                                    Érase Una Vez
                                </span>
                            </span>
                        </a>

                        <button aria-label="humburger" id="hamburger" class="relative w-10 h-10 -mr-2 lg:hidden">
                            <div aria-hidden="true" id="line"
                                class="inset-0 w-6 h-0.5 m-auto rounded bg-white transtion duration-300"></div>
                            <div aria-hidden="true" id="line2"
                                class="inset-0 w-6 h-0.5 mt-2 m-auto rounded bg-white transtion duration-300"></div>
                        </button>
                    </div>

                    <div
                        class="hidden w-full lg:flex flex-wrap justify-end items-center space-y-6 p-6 rounded-xl bg-white md:space-y-0 md:p-0 md:flex-nowrap md:bg-transparent lg:w-7/12">

                        <div class="w-full space-y-2 lg:space-y-0 md:w-max">
                            <span class="flex space-x-2 items-center font-semibold text-sm">
                                <div @click="scrollToSection('servicios')"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-m text-indigo-500 uppercase tracking-widest hover:bg-indigo-400 hover:text-white hover:cursor-pointer focus:bg-indigo-200 active:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-300">
                                    Servicios
                                </div>
                                <Link :href="route('register')" v-if="!$page.props.auth.user"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-m text-indigo-500 uppercase tracking-widest hover:bg-indigo-400 hover:text-white focus:bg-indigo-200 active:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-300">
                                    Registrarme
                                </Link>
                                <Link :href="route('login')" v-if="canLogin"
                                    class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-m text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-300">
                                    Acceder
                                </Link>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="relative bg-white">
            <div class="container m-auto px-6 pt-32 md:px-12 lg:pt-[4.8rem] lg:px-7">
                <div class="flex items-center flex-wrap px-2 md:px-0">
                    <div class="relative lg:w-6/12 lg:py-24 xl:py-32">
                        <h1 class="font-bold text-4xl text-gray-800 md:text-5xl lg:w-10/12">Tu aventura en la
                            <span class="text-indigo-400">mecanografía</span> comienza aquí.
                        </h1>

                        <div class="pt-12 flex space-x-4">
                            <transition appear name="slide-fade">
                                <Link :href="route('login')"
                                    class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-m text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-300">
                                Iniciar
                                </Link>
                            </transition>
                            <transition appear name="slide-fade">
                                <a @click="scrollToSection('acerca')"
                                    class="inline-flex items-center px-4 py-2 bg-white-800 border-indigo-800 border-2 border-transparent rounded-md font-semibold text-m text-indigo-800 uppercase tracking-widest hover:bg-indigo-400 focus:bg-indigo-700 focus:text-white hover:text-white active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-300 hover:cursor-pointer">
                                    Ver Más
                                </a>
                            </transition>
                        </div>
                    </div>

                    <transition appear name="slide-fade" :style="{ transitionDelay: '200ms' }">
                        <div class="ml-auto -mb-24 lg:-mb-56 lg:w-6/12">
                            <img src="/images/landing/e-learning.png" class="relative" alt="laptop" loading="lazy"
                                width="4500" height="4500">
                        </div>
                    </transition>

                </div>
            </div>
        </div>
    </div>

    <!-- component -->
    <div class="mt-36 py-16 bg-white shadow-2xl shadow-black z-10" id="acerca">
        <div class="container m-auto px-6 text-gray-600 md:px-12 xl:px-6">
            <div class="space-y-6 md:space-y-0 md:flex md:gap-6 lg:items-center lg:gap-12">
                <div class="md:5/12 lg:w-5/12">
                    <img src="/images/landing/laptop.png" alt="image" loading="lazy" width="" height="">
                </div>
                <div class="md:7/12 lg:w-6/12 text-justify">
                    <h2 class="text-2xl text-indigo-700 font-bold md:text-4xl">Bienvenidos a Érase Una Vez</h2>
                    <p class="mt-6 text-gray-600">En Érase Una Vez, creemos que la lectura y la mecanografía son
                        habilidades fundamentales que enriquecen la vida de los estudiantes. Nuestra plataforma está
                        diseñada para ofrecer una experiencia única que combina la mejora del uso del teclado con el
                        fomento de la lectura y la expansión del vocabulario.</p>
                    <p class="mt-4 text-gray-600">Aquí, los tutores y maestros pueden crear textos adaptados a
                        diferentes niveles de dificultad, permitiendo a los alumnos avanzar a su propio ritmo. Nos
                        apasiona ayudar a los educadores a enriquecer sus clases y a los estudiantes a descubrir el
                        placer de escribir y leer. Con Érase Una Vez, cada palabra cuenta y cada lección es una
                        aventura.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- component -->
    <div class="py-16 bg-indigo-500" id="servicios">
        <div class="container m-auto px-6 text-gray-500 md:px-12 xl:px-0">
            <div class="mx-auto grid gap-6 md:w-3/4 lg:w-full lg:grid-cols-3">
                <transition appear name="slide-fade">
                    <div
                        class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 transition-all duration-300 ease-in-out hover:scale-105">
                        <div class="mb-12 space-y-4">
                            <h3 class="text-2xl font-semibold text-indigo-900">Creación de Textos Personalizados</h3>
                            <p class="mb-6 text-justify">Los maestros pueden diseñar textos en tres niveles de
                                dificultad: baja, media y difícil. Esto permite que cada estudiante trabaje en su nivel,
                                asegurando un aprendizaje efectivo y motivador.</p>
                        </div>
                        <img src="https://tailus.io/sources/blocks/end-image/preview/images/graphic.svg"
                            class="w-2/3 ml-auto mr-24 -mb-12" alt="illustration" loading="lazy" width="900"
                            height="600">
                    </div>
                </transition>
                <transition appear name="slide-fade">
                    <div
                        class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 transition-all duration-300 ease-in-out hover:scale-105">
                        <div class="mb-12 space-y-4">
                            <h3 class="text-2xl font-semibold text-indigo-900">Cursos Interactivos</h3>
                            <p class="mb-6 text-justify">Los alumnos pueden inscribirse en cursos impartidos por sus
                                tutores, quienes podrán asignarles textos específicos. Esta estructura permite un
                                seguimiento del progreso y una atención personalizada.</p>
                        </div>
                        <img src="/images/landing/purple-writer.png" class="w-2/3 ml-auto mr-16" alt="illustration"
                            loading="lazy" width="900" height="600">
                    </div>
                </transition>
                <transition appear name="slide-fade">
                    <div
                        class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 transition-all duration-300 ease-in-out hover:scale-105">
                        <div class="mb-12 space-y-4">
                            <h3 class="text-2xl font-semibold text-indigo-900">Mejora de la Mecanografía</h3>
                            <p class="mb-6 text-justify">A través de ejercicios diseñados para practicar la escritura,
                                los usuarios pueden mejorar su velocidad y precisión en el teclado, habilidades que son
                                esenciales en la era digital.</p>
                        </div>
                        <img src="/images/landing/writing.png" class="w-2/3 ml-auto mr-16" alt="illustration"
                            loading="lazy" width="900" height="600">
                    </div>
                </transition>


            </div>
        </div>
    </div>

    <!-- component -->
    <footer>

        <body class="bg-white">
            <div class="flex flex-col mx-3 bg-white rounded-lg">
                <div class="w-full draggable">
                    <div class="container flex flex-col mx-auto">
                        <div class="flex flex-col items-center w-full my-20">
                            <div class="flex flex-col items-center gap-6 mb-8">
                                <div
                                    class="flex flex-wrap items-center justify-center gap-5 lg:gap-12 gap-y-3 lg:flex-nowrap text-dark-grey-900">
                                    <a @click="scrollToSection('acerca')" class="text-gray-600 transition-all duration-300 ease-in-out hover:text-indigo-600 hover:cursor-pointer">Acerca de</a>
                                    <a @click="scrollToSection('servicios')" class="text-gray-600 transition-all duration-300 ease-in-out hover:text-indigo-600 hover:cursor-pointer">Servicios</a>
                                    <Link :href="route('login')" class="text-gray-600 hover:text-indigo-600">Acceder
                                    </Link>
                                </div>
                                <div class="flex items-center gap-8">
                                    <a href="https://github.com/ThisIsLexx/EUV"
                                        class="text-grey-700 hover:text-grey-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M12 3C7.0275 3 3 7.13211 3 12.2284C3 16.3065 5.5785 19.7648 9.15375 20.9841C9.60375 21.0709 9.76875 20.7853 9.76875 20.5403C9.76875 20.3212 9.76125 19.7405 9.7575 18.9712C7.254 19.5277 6.726 17.7332 6.726 17.7332C6.3165 16.6681 5.72475 16.3832 5.72475 16.3832C4.9095 15.8111 5.78775 15.8229 5.78775 15.8229C6.6915 15.887 7.16625 16.7737 7.16625 16.7737C7.96875 18.1847 9.273 17.777 9.7875 17.5414C9.8685 16.9443 10.1003 16.5381 10.3575 16.3073C8.35875 16.0764 6.258 15.2829 6.258 11.7471C6.258 10.7399 6.60675 9.91659 7.18425 9.27095C7.083 9.03774 6.77925 8.0994 7.263 6.82846C7.263 6.82846 8.01675 6.58116 9.738 7.77462C10.458 7.56958 11.223 7.46785 11.988 7.46315C12.753 7.46785 13.518 7.56958 14.238 7.77462C15.948 6.58116 16.7017 6.82846 16.7017 6.82846C17.1855 8.0994 16.8818 9.03774 16.7917 9.27095C17.3655 9.91659 17.7142 10.7399 17.7142 11.7471C17.7142 15.2923 15.6105 16.0725 13.608 16.2995C13.923 16.5765 14.2155 17.1423 14.2155 18.0071C14.2155 19.242 14.2043 20.2344 14.2043 20.5341C14.2043 20.7759 14.3617 21.0647 14.823 20.9723C18.4237 19.7609 21 16.3002 21 12.2284C21 7.13211 16.9703 3 12 3Z"
                                                fill="currentColor" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <p class="text-base font-normal leading-7 text-center text-grey-700">
                                    Universidad de Guadalajara | Centro Universitario de Ciencias Exactas e Ingenierías
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </footer>
</template>
