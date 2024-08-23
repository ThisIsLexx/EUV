<template>
    <div class="flex">
        <!-- BEGIN: Card inicio de sesión -->
        <div class="flex flex-col sm:justify-center w-1/3 items-center pt-6 sm:pt-0 px-20 z-10 bg-gray-100 shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]">
            <div>
                <slot name="logo" />
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-lg overflow-hidden sm:rounded-lg">
                <slot />
            </div>
        </div>
        <!-- END: Card inicio de sesión -->

        <!-- BEGIN: Imagen de bienvenida -->
        <div class="flex flex-col">
            <img src="images/login.jpg" alt="Imagen de bienvenida" class="object-cover backdrop-blur-lg w-full h-screen" />
        </div>
        <!-- END: Imagen de bienvenida -->
    </div>
</template>
