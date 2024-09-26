<script setup>
import { Head, Link } from '@inertiajs/vue3';

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
</script>

<template>

    <Head title="Welcome" />
    <div class="relative w-full">
        <nav class="fixed z-10 w-full bg-white md:absolute md:bg-transparent">
            <div class="container m-auto px-2 md:px-12 lg:px-7">
                <div class="flex flex-wrap items-center justify-between py-3 gap-6 md:py-4 md:gap-0">
                    <div class="w-full px-6 flex justify-between lg:w-max md:px-0">
                        <a href="https://tailus.io/blocks/hero-section" aria-label="logo"
                            class="flex space-x-2 items-center">
                            <img src="https://tailus.io/sources/blocks/food-delivery/preview/images/icon.png"
                                class="w-12" alt="tailus logo" width="144" height="133">
                            <span class="text-2xl font-bold text-indigo-500"> Érase Una Vez </span>
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
                            <button type="button" title="Start buying"
                                class="w-full py-3 px-6 text-center rounded-md transition active:bg-white focus:bg-white sm:w-max">
                                <span class="block text-yellow-800 font-semibold text-sm">
                                    <Link v-if="canRegister" :href="route('register')"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/80 dark:focus-visible:ring-black">
                                    Register
                                    </Link>
                                </span>
                            </button>
                            <button type="button" title="Start buying"
                                class="w-full py-3 px-6 text-center rounded-md transition bg-indigo-500 hover:bg-indigo-600 active:bg-white focus:bg-white sm:w-max">
                                <span class="block text-yellow-900 font-semibold text-sm">
                                    <Link :href="route('login')"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-white/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-white/80 dark:focus-visible:ring-black">

                                    Log in
                                    </Link>
                                </span>
                            </button>
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
                            <span class="text-indigo-400">mecanografía</span> comienza aquí.</h1>    
                            
                        <div class="pt-12 flex space-x-4">
                            <button :type="type" class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-m text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                                Iniciar
                            </button>
                            
                            <button :type="type" class="inline-flex items-center px-4 py-2 bg-white-800 border-indigo-800 border-2 border-transparent rounded-md font-semibold text-m text-indigo-800 uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 focus:text-white hover:text-white active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                                Ver Más
                            </button>
                        </div>
                    </div>


                    <div class="ml-auto -mb-24 lg:-mb-56 lg:w-6/12">
                        <img src="/images/landing/purple-writer.png" class="relative" alt="laptop" loading="lazy"
                            width="4500" height="4500">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- component -->
    <div class="mt-36 py-16 bg-white">
        <div class="container m-auto px-6 text-gray-600 md:px-12 xl:px-6">
            <div class="space-y-6 md:space-y-0 md:flex md:gap-6 lg:items-center lg:gap-12">
                <div class="md:5/12 lg:w-5/12">
                    <img src="/images/landing/laptop.png" alt="image"
                        loading="lazy" width="" height="">
                </div>
                <div class="md:7/12 lg:w-6/12">
                    <h2 class="text-2xl text-indigo-700 font-bold md:text-4xl">Bienvenidos a Érase Una Vez</h2>
                    <p class="mt-6 text-gray-600">En Érase Una Vez, creemos que la lectura y la mecanografía son habilidades fundamentales que enriquecen la vida de los estudiantes. Nuestra plataforma está diseñada para ofrecer una experiencia única que combina la mejora del uso del teclado con el fomento de la lectura y la expansión del vocabulario.</p>
                    <p class="mt-4 text-gray-600">Aquí, los tutores y maestros pueden crear textos adaptados a diferentes niveles de dificultad, permitiendo a los alumnos avanzar a su propio ritmo. Nos apasiona ayudar a los educadores a enriquecer sus clases y a los estudiantes a descubrir el placer de escribir y leer. Con Érase Una Vez, cada palabra cuenta y cada lección es una aventura.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- component -->
    <div class="py-16 bg-indigo-500">
        <div class="container m-auto px-6 text-gray-500 md:px-12 xl:px-0">
            <div class="mx-auto grid gap-6 md:w-3/4 lg:w-full lg:grid-cols-3">
                <div class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8">
                    <div class="mb-12 space-y-4">
                        <h3 class="text-2xl font-semibold text-indigo-900">Creación de Textos Personalizados</h3>
                        <p class="mb-6">Los maestros pueden diseñar textos en tres niveles de dificultad: baja, media y difícil. Esto permite que cada estudiante trabaje en su nivel, asegurando un aprendizaje efectivo y motivador.</p>
                    </div>
                    <img src="https://tailus.io/sources/blocks/end-image/preview/images/graphic.svg"
                        class="w-2/3 ml-auto -mb-12" alt="illustration" loading="lazy" width="900" height="600">
                </div>
                <div class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8">
                    <div class="mb-12 space-y-4">
                        <h3 class="text-2xl font-semibold text-indigo-900">Cursos Interactivos</h3>
                        <p class="mb-6">Los alumnos pueden inscribirse en cursos impartidos por sus tutores, quienes podrán asignarles textos específicos. Esta estructura permite un seguimiento del progreso y una atención personalizada.</p>
                    </div>
                    <img src="https://tailus.io/sources/blocks/end-image/preview/images/ui-design.svg"
                        class="w-2/3 ml-auto" alt="illustration" loading="lazy" width="900" height="600">
                </div>
                <div class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8">
                    <div class="mb-12 space-y-4">
                        <h3 class="text-2xl font-semibold text-indigo-900">Mejora de la Mecanografía</h3>
                        <p class="mb-6">A través de ejercicios diseñados para practicar la escritura, los usuarios pueden mejorar su velocidad y precisión en el teclado, habilidades que son esenciales en la era digital.</p>
                    </div>
                    <img src="https://tailus.io/sources/blocks/end-image/preview/images/ux-design.svg"
                        class="w-2/3 ml-auto " alt="illustration" loading="lazy" width="900" height="600">
                </div>
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
                            <span class="mb-8">
                                <svg width="140" viewBox="0 0 419 95" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M121.4 69V25.32H132.6V30.68C133.72 28.5467 135.347 26.9733 137.48 25.96C139.613 24.8933 142.067 24.36 144.84 24.36C147.72 24.36 150.333 24.9733 152.68 26.2C155.08 27.3733 156.893 29 158.12 31.08C159.667 28.7867 161.587 27.1067 163.88 26.04C166.227 24.92 168.813 24.36 171.64 24.36C174.787 24.36 177.56 25.0533 179.96 26.44C182.413 27.8267 184.333 29.7733 185.72 32.28C187.107 34.7333 187.8 37.6133 187.8 40.92V69H175.8V43.48C175.8 40.9733 175.107 38.9733 173.72 37.48C172.387 35.9333 170.547 35.16 168.2 35.16C165.853 35.16 163.987 35.9333 162.6 37.48C161.267 38.9733 160.6 40.9733 160.6 43.48V69H148.6V43.48C148.6 40.9733 147.907 38.9733 146.52 37.48C145.187 35.9333 143.347 35.16 141 35.16C138.653 35.16 136.787 35.9333 135.4 37.48C134.067 38.9733 133.4 40.9733 133.4 43.48V69H121.4ZM217.377 69.96C213.057 69.96 209.11 68.9733 205.537 67C202.017 65.0267 199.19 62.3333 197.057 58.92C194.977 55.4533 193.937 51.5333 193.937 47.16C193.937 42.7333 194.977 38.8133 197.057 35.4C199.19 31.9867 202.017 29.2933 205.537 27.32C209.11 25.3467 213.057 24.36 217.377 24.36C221.697 24.36 225.617 25.3467 229.137 27.32C232.657 29.2933 235.457 31.9867 237.537 35.4C239.67 38.8133 240.737 42.7333 240.737 47.16C240.737 51.5333 239.67 55.4533 237.537 58.92C235.457 62.3333 232.657 65.0267 229.137 67C225.617 68.9733 221.697 69.96 217.377 69.96ZM217.377 59.16C220.63 59.16 223.27 58.04 225.297 55.8C227.324 53.56 228.337 50.68 228.337 47.16C228.337 43.6933 227.324 40.84 225.297 38.6C223.27 36.3067 220.63 35.16 217.377 35.16C214.124 35.16 211.457 36.3067 209.377 38.6C207.35 40.84 206.337 43.6933 206.337 47.16C206.337 50.68 207.35 53.56 209.377 55.8C211.457 58.04 214.124 59.16 217.377 59.16ZM268.065 69.48C262.785 69.48 258.678 68.0667 255.745 65.24C252.865 62.36 251.425 58.36 251.425 53.24V35.72H244.065V25.32H244.465C249.105 25.32 251.425 23.08 251.425 18.6V15.4H263.425V25.32H273.665V35.72H263.425V52.44C263.425 56.8667 265.905 59.08 270.865 59.08C271.612 59.08 272.545 59 273.665 58.84V69C272.865 69.1067 271.958 69.2133 270.945 69.32C269.932 69.4267 268.972 69.48 268.065 69.48ZM280.697 21.4V9.39999H292.697V21.4H280.697ZM280.697 69V25.32H292.697V69H280.697ZM323.158 69.96C318.838 69.96 314.891 68.9733 311.318 67C307.798 65.0267 304.971 62.3333 302.838 58.92C300.758 55.4533 299.718 51.5333 299.718 47.16C299.718 42.7333 300.758 38.8133 302.838 35.4C304.971 31.9867 307.798 29.2933 311.318 27.32C314.891 25.3467 318.838 24.36 323.158 24.36C327.478 24.36 331.398 25.3467 334.918 27.32C338.438 29.2933 341.238 31.9867 343.318 35.4C345.451 38.8133 346.518 42.7333 346.518 47.16C346.518 51.5333 345.451 55.4533 343.318 58.92C341.238 62.3333 338.438 65.0267 334.918 67C331.398 68.9733 327.478 69.96 323.158 69.96ZM323.158 59.16C326.411 59.16 329.051 58.04 331.078 55.8C333.105 53.56 334.118 50.68 334.118 47.16C334.118 43.6933 333.105 40.84 331.078 38.6C329.051 36.3067 326.411 35.16 323.158 35.16C319.905 35.16 317.238 36.3067 315.158 38.6C313.131 40.84 312.118 43.6933 312.118 47.16C312.118 50.68 313.131 53.56 315.158 55.8C317.238 58.04 319.905 59.16 323.158 59.16ZM353.588 69V25.32H364.788V30.68C365.908 28.5467 367.534 26.9733 369.668 25.96C371.801 24.8933 374.254 24.36 377.028 24.36C380.334 24.36 383.214 25.0533 385.668 26.44C388.174 27.8267 390.121 29.7733 391.508 32.28C392.894 34.7333 393.588 37.6133 393.588 40.92V69H381.588V43.48C381.588 40.9733 380.841 38.9733 379.348 37.48C377.854 35.9333 375.934 35.16 373.588 35.16C371.241 35.16 369.321 35.9333 367.828 37.48C366.334 38.9733 365.588 40.9733 365.588 43.48V69H353.588Z"
                                        fill="url(#paint0_linear_1001_3)" />
                                    <path
                                        d="M34.2138 5.86107C34.7122 4.28095 36.3972 3.40401 37.9773 3.90239L76.9347 16.1896C78.5148 16.688 79.3917 18.373 78.8934 19.9531L72.8993 38.9574C72.2692 40.9554 69.8371 41.7086 68.188 40.4165L52.7882 28.3503C52.2168 27.9025 51.5023 27.6772 50.7773 27.7161L31.2415 28.7635C29.1495 28.8757 27.5896 26.8634 28.2198 24.8654L34.2138 5.86107Z"
                                        fill="url(#paint1_linear_1001_3)" />
                                    <path
                                        d="M13.3226 80.1965C11.7071 80.5642 10.0994 79.5527 9.73164 77.9371L0.665552 38.1067C0.297829 36.4912 1.30938 34.8834 2.92491 34.5157L22.3551 30.093C24.3979 29.6281 26.2761 31.347 25.9936 33.4229L23.3549 52.808C23.2569 53.5274 23.4232 54.2578 23.8228 54.864L34.5917 71.1973C35.7449 72.9464 34.7957 75.3089 32.7529 75.7738L13.3226 80.1965Z"
                                        fill="url(#paint2_linear_1001_3)" />
                                    <path
                                        d="M87.9774 60.8205C89.0945 62.0441 89.008 63.9417 87.7843 65.0587L57.6148 92.5988C56.3911 93.7158 54.4936 93.6294 53.3766 92.4057L39.9419 77.6883C38.5294 76.141 39.0976 73.6592 41.0426 72.8806L59.2053 65.6098C59.8793 65.34 60.4326 64.835 60.7626 64.1883L69.6548 46.762C70.6071 44.8959 73.1303 44.5557 74.5427 46.103L87.9774 60.8205Z"
                                        fill="url(#paint3_linear_1001_3)" />
                                    <defs>
                                        <linearGradient id="paint0_linear_1001_3" x1="268" y1="0" x2="268" y2="86"
                                            gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#1A31A7" />
                                            <stop offset="1" stop-color="#7C3AED" />
                                        </linearGradient>
                                        <linearGradient id="paint1_linear_1001_3" x1="62.4802" y1="11.9181" x2="43.6919"
                                            y2="47.2867" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#1A31A7" />
                                            <stop offset="1" stop-color="#7C3AED" />
                                        </linearGradient>
                                        <linearGradient id="paint2_linear_1001_3" x1="4.27748" y1="52.74" x2="44.293"
                                            y2="51.0974" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#1A31A7" />
                                            <stop offset="1" stop-color="#7C3AED" />
                                        </linearGradient>
                                        <linearGradient id="paint3_linear_1001_3" x1="68.56" y1="82.2363" x2="47.3853"
                                            y2="48.2426" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#1A31A7" />
                                            <stop offset="1" stop-color="#7C3AED" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </span>
                            <div class="flex flex-col items-center gap-6 mb-8">
                                <div
                                    class="flex flex-wrap items-center justify-center gap-5 lg:gap-12 gap-y-3 lg:flex-nowrap text-dark-grey-900">
                                    <a href="javascript:void(0)" class="text-gray-600 hover:text-gray-900">About</a>
                                    <a href="javascript:void(0)" class="text-gray-600 hover:text-gray-900">Features</a>
                                    <a href="javascript:void(0)" class="text-gray-600 hover:text-gray-900">Blog</a>
                                    <a href="javascript:void(0)" class="text-gray-600 hover:text-gray-900">Resources</a>
                                    <a href="javascript:void(0)" class="text-gray-600 hover:text-gray-900">Partners</a>
                                    <a href="javascript:void(0)" class="text-gray-600 hover:text-gray-900">Help</a>
                                    <a href="javascript:void(0)" class="text-gray-600 hover:text-gray-900">Terms</a>
                                </div>
                                <div class="flex items-center gap-8">
                                    <a href="javascript:void(0)" class="text-grey-700 hover:text-grey-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M13.6348 20.7273V12.766H16.3582L16.7668 9.66246H13.6348V7.68128C13.6348 6.78301 13.8881 6.17085 15.2029 6.17085L16.877 6.17017V3.39424C16.5875 3.35733 15.5937 3.27273 14.437 3.27273C12.0216 3.27273 10.368 4.71881 10.368 7.37391V9.66246H7.63636V12.766H10.368V20.7273H13.6348Z"
                                                fill="currentColor" />
                                            <mask id="mask0_3320_6483" style="mask-type:luminance"
                                                maskUnits="userSpaceOnUse" x="7" y="3" width="10" height="18">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.6348 20.7273V12.766H16.3582L16.7668 9.66246H13.6348V7.68128C13.6348 6.78301 13.8881 6.17085 15.2029 6.17085L16.877 6.17017V3.39424C16.5875 3.35733 15.5937 3.27273 14.437 3.27273C12.0216 3.27273 10.368 4.71881 10.368 7.37391V9.66246H7.63636V12.766H10.368V20.7273H13.6348Z"
                                                    fill="white" />
                                            </mask>
                                            <g mask="url(#mask0_3320_6483)">
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0)" class="text-grey-700 hover:text-grey-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M21.8182 6.14597C21.1356 6.44842 20.4032 6.65355 19.6337 6.74512C20.4194 6.27461 21.0208 5.5283 21.3059 4.64176C20.5689 5.07748 19.7553 5.39388 18.8885 5.56539C18.1943 4.82488 17.207 4.36364 16.1118 4.36364C14.0108 4.36364 12.3072 6.06718 12.3072 8.16706C12.3072 8.46488 12.3408 8.75576 12.4058 9.03391C9.24436 8.87512 6.44106 7.36048 4.56485 5.05894C4.23688 5.61985 4.0503 6.27342 4.0503 6.97109C4.0503 8.29106 4.72246 9.45573 5.74227 10.1371C5.11879 10.1163 4.53239 9.94476 4.01903 9.65967V9.70718C4.01903 11.5498 5.33088 13.0876 7.07033 13.4376C6.75164 13.5234 6.41558 13.5709 6.06791 13.5709C5.82224 13.5709 5.58467 13.5465 5.35173 13.5002C5.83612 15.0125 7.2407 16.1123 8.90485 16.1424C7.60343 17.1622 5.96246 17.7683 4.18012 17.7683C3.87303 17.7683 3.57055 17.7498 3.27273 17.7162C4.95658 18.7974 6.95564 19.4278 9.10418 19.4278C16.1026 19.4278 19.9281 13.6312 19.9281 8.60397L19.9153 8.11145C20.6628 7.57833 21.3094 6.90851 21.8182 6.14597Z"
                                                fill="currentColor" />
                                            <mask id="mask0_3320_6484" style="mask-type:luminance"
                                                maskUnits="userSpaceOnUse" x="3" y="4" width="19" height="16">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M21.8182 6.14597C21.1356 6.44842 20.4032 6.65355 19.6337 6.74512C20.4194 6.27461 21.0208 5.5283 21.3059 4.64176C20.5689 5.07748 19.7553 5.39388 18.8885 5.56539C18.1943 4.82488 17.207 4.36364 16.1118 4.36364C14.0108 4.36364 12.3072 6.06718 12.3072 8.16706C12.3072 8.46488 12.3408 8.75576 12.4058 9.03391C9.24436 8.87512 6.44106 7.36048 4.56485 5.05894C4.23688 5.61985 4.0503 6.27342 4.0503 6.97109C4.0503 8.29106 4.72246 9.45573 5.74227 10.1371C5.11879 10.1163 4.53239 9.94476 4.01903 9.65967V9.70718C4.01903 11.5498 5.33088 13.0876 7.07033 13.4376C6.75164 13.5234 6.41558 13.5709 6.06791 13.5709C5.82224 13.5709 5.58467 13.5465 5.35173 13.5002C5.83612 15.0125 7.2407 16.1123 8.90485 16.1424C7.60343 17.1622 5.96246 17.7683 4.18012 17.7683C3.87303 17.7683 3.57055 17.7498 3.27273 17.7162C4.95658 18.7974 6.95564 19.4278 9.10418 19.4278C16.1026 19.4278 19.9281 13.6312 19.9281 8.60397L19.9153 8.11145C20.6628 7.57833 21.3094 6.90851 21.8182 6.14597Z"
                                                    fill="white" />
                                            </mask>
                                            <g mask="url(#mask0_3320_6484)">
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0)" class="text-grey-700 hover:text-grey-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M12 3C7.0275 3 3 7.13211 3 12.2284C3 16.3065 5.5785 19.7648 9.15375 20.9841C9.60375 21.0709 9.76875 20.7853 9.76875 20.5403C9.76875 20.3212 9.76125 19.7405 9.7575 18.9712C7.254 19.5277 6.726 17.7332 6.726 17.7332C6.3165 16.6681 5.72475 16.3832 5.72475 16.3832C4.9095 15.8111 5.78775 15.8229 5.78775 15.8229C6.6915 15.887 7.16625 16.7737 7.16625 16.7737C7.96875 18.1847 9.273 17.777 9.7875 17.5414C9.8685 16.9443 10.1003 16.5381 10.3575 16.3073C8.35875 16.0764 6.258 15.2829 6.258 11.7471C6.258 10.7399 6.60675 9.91659 7.18425 9.27095C7.083 9.03774 6.77925 8.0994 7.263 6.82846C7.263 6.82846 8.01675 6.58116 9.738 7.77462C10.458 7.56958 11.223 7.46785 11.988 7.46315C12.753 7.46785 13.518 7.56958 14.238 7.77462C15.948 6.58116 16.7017 6.82846 16.7017 6.82846C17.1855 8.0994 16.8818 9.03774 16.7917 9.27095C17.3655 9.91659 17.7142 10.7399 17.7142 11.7471C17.7142 15.2923 15.6105 16.0725 13.608 16.2995C13.923 16.5765 14.2155 17.1423 14.2155 18.0071C14.2155 19.242 14.2043 20.2344 14.2043 20.5341C14.2043 20.7759 14.3617 21.0647 14.823 20.9723C18.4237 19.7609 21 16.3002 21 12.2284C21 7.13211 16.9703 3 12 3Z"
                                                fill="currentColor" />
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0)" class="text-grey-700 hover:text-grey-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 18 18" fill="none">
                                            <path
                                                d="M16.2 0H1.8C0.81 0 0 0.81 0 1.8V16.2C0 17.19 0.81 18 1.8 18H16.2C17.19 18 18 17.19 18 16.2V1.8C18 0.81 17.19 0 16.2 0ZM5.4 15.3H2.7V7.2H5.4V15.3ZM4.05 5.67C3.15 5.67 2.43 4.95 2.43 4.05C2.43 3.15 3.15 2.43 4.05 2.43C4.95 2.43 5.67 3.15 5.67 4.05C5.67 4.95 4.95 5.67 4.05 5.67ZM15.3 15.3H12.6V10.53C12.6 9.81004 11.97 9.18 11.25 9.18C10.53 9.18 9.9 9.81004 9.9 10.53V15.3H7.2V7.2H9.9V8.28C10.35 7.56 11.34 7.02 12.15 7.02C13.86 7.02 15.3 8.46 15.3 10.17V15.3Z"
                                                fill="currentColor" />
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0)" class="text-grey-700 hover:text-grey-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.60063 2.18182H16.3991C19.3873 2.18182 21.8183 4.61281 21.8182 7.60074V16.3993C21.8182 19.3872 19.3873 21.8182 16.3991 21.8182H7.60063C4.6127 21.8182 2.18182 19.3873 2.18182 16.3993V7.60074C2.18182 4.61281 4.6127 2.18182 7.60063 2.18182ZM16.3993 20.0759C18.4266 20.0759 20.0761 18.4266 20.0761 16.3993H20.0759V7.60074C20.0759 5.57348 18.4265 3.92405 16.3991 3.92405H7.60063C5.57336 3.92405 3.92405 5.57348 3.92405 7.60074V16.3993C3.92405 18.4266 5.57336 20.0761 7.60063 20.0759H16.3993ZM6.85714 12.0001C6.85714 9.16424 9.16418 6.85714 12 6.85714C14.8358 6.85714 17.1429 9.16424 17.1429 12.0001C17.1429 14.8359 14.8358 17.1429 12 17.1429C9.16418 17.1429 6.85714 14.8359 6.85714 12.0001ZM8.62798 12C8.62798 13.8593 10.1407 15.3719 12 15.3719C13.8593 15.3719 15.372 13.8593 15.372 12C15.372 10.1406 13.8594 8.6279 12 8.6279C10.1406 8.6279 8.62798 10.1406 8.62798 12Z"
                                                fill="currentColor" />
                                            <mask id="mask0_3320_6487" style="mask-type:luminance"
                                                maskUnits="userSpaceOnUse" x="2" y="2" width="20" height="20">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M7.60063 2.18182H16.3991C19.3873 2.18182 21.8183 4.61281 21.8182 7.60074V16.3993C21.8182 19.3872 19.3873 21.8182 16.3991 21.8182H7.60063C4.6127 21.8182 2.18182 19.3873 2.18182 16.3993V7.60074C2.18182 4.61281 4.6127 2.18182 7.60063 2.18182ZM16.3993 20.0759C18.4266 20.0759 20.0761 18.4266 20.0761 16.3993H20.0759V7.60074C20.0759 5.57348 18.4265 3.92405 16.3991 3.92405H7.60063C5.57336 3.92405 3.92405 5.57348 3.92405 7.60074V16.3993C3.92405 18.4266 5.57336 20.0761 7.60063 20.0759H16.3993ZM6.85714 12.0001C6.85714 9.16424 9.16418 6.85714 12 6.85714C14.8358 6.85714 17.1429 9.16424 17.1429 12.0001C17.1429 14.8359 14.8358 17.1429 12 17.1429C9.16418 17.1429 6.85714 14.8359 6.85714 12.0001ZM8.62798 12C8.62798 13.8593 10.1407 15.3719 12 15.3719C13.8593 15.3719 15.372 13.8593 15.372 12C15.372 10.1406 13.8594 8.6279 12 8.6279C10.1406 8.6279 8.62798 10.1406 8.62798 12Z"
                                                    fill="white" />
                                            </mask>
                                            <g mask="url(#mask0_3320_6487)">
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <p class="text-base font-normal leading-7 text-center text-grey-700">
                                    2023 Motion Tailwind CSS Library. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </footer>
</template>