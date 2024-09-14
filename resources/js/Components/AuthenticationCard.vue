<script setup lang="ts">
import { ref } from 'vue';
import Separator from './Separator.vue';

import { AcademicCapIcon, ChartBarIcon, ChatBubbleBottomCenterIcon } from '@heroicons/vue/20/solid';


let currentBanner = ref(0);

const banners = [
    {
        title: 'Cursos',
        description: 'Inscríbete en una variedad de cursos diseñados para mejorar tu lectura y escritura, evaluando tus resultados para mejorar tu precisión.',
        icon: AcademicCapIcon,
    },
    {
        title: 'Mecanografía',
        description: 'Aumenta tu velocidad y precisión en mecanografía con nuestros cursos interactivos.',
        icon: ChartBarIcon,
    },
    {
        title: 'Vocabulario',
        description: 'Amplía tu vocabulario de forma divertida con nuestros juegos interactivos, donde cada tecla pulsada te ayuda a mejorar tus habilidades lingüísticas.',
        icon: ChatBubbleBottomCenterIcon,
    },
];

const nextBanner = () => {
    currentBanner.value = currentBanner.value === banners.length - 1 ? 0 : currentBanner.value + 1;
};

// Recorrer entre los diferentes banners
setInterval(nextBanner, 4000);

</script>

<template>
    <div class="flex flex-col h-screen md:flex-row">
        <!-- BEGIN: Card inicio de sesión -->
        <div class="flex flex-col sm:justify-center w-3/5 items-center pt-6 sm:pt-0 px-20 z-10 bg-gray-100 shadow-[0_35px_120px_-15px_rgba(0,0,0,0.3)] shadow-black">
            <transition appear name="left-to-right" :style="{ transitionDelay: '300ms'}">
                <div>
                    <slot name="logo"/>
                </div>
            </transition>

            <transition appear name="left-to-right">
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-lg overflow-hidden sm:rounded-lg">
                    <slot />
                </div>
            </transition>
        </div>
        <!-- END: Card inicio de sesión -->

        <!-- BEGIN: Imagen de bienvenida -->
        <div class="flex flex-col gap-12 w-full bg-gray-100 justify-center items-end" style="background-image: url('images/login.jpg')">

            <div
                v-for="(banner, index) in banners"
                class="w-1/2 bg-white rounded-md p-5 transition-all duration-300 ease-in-out"
                :class="currentBanner === index ? 'scale-105 mr-10 shadow-sm shadow-black opacity-100' : 'opacity-75'"
            >
                <span>
                    <div class="flex transition-all duration-500 ease-in-out justify-start align-bottom">
                        <component :is="banner.icon" class="h-6 w-6 text-gray-800 mr-3"/>
                        <h1 class="text-2xl font-bold text-gray-800">{{ banner.title }}</h1>
                    </div>
                    <Separator/>
                    <p class="text-gray-600">{{ banner.description }}</p>
                </span>
            </div>
        </div>
        <!-- END: Imagen de bienvenida -->
    </div>
</template>

