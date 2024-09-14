<!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
    <!--
      This example requires updating your template:

      ```
      <html class="h-full bg-white">
      <body class="h-full">
      ```
    -->
    <div>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog class="relative z-50 lg:hidden" @close="sidebarOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-900/80" />
                </TransitionChild>

                <div class="fixed inset-0 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                        enter-from="-translate-x-full" enter-to="translate-x-0"
                        leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0"
                        leave-to="-translate-x-full">
                        <DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
                            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0"
                                enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100"
                                leave-to="opacity-0">
                                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                                    <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                                        <span class="sr-only">Close sidebar</span>
                                        <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                                    </button>
                                </div>
                            </TransitionChild>
                            <!-- Sidebar component, swap this element with another sidebar if you like -->
                            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4">
                                <div class="flex h-16 shrink-0 items-center">
                                    <img class="h-8 w-auto"
                                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                        alt="Your Company" />
                                </div>
                                <nav class="flex flex-1 flex-col">
                                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                        <li>
                                            <ul role="list" class="-mx-2 space-y-1">
                                                <li v-for="item in navigation" :key="item.name">
                                                    <button @click="redirectToView(item.href)" type="button" class="w-full"
                                                        :class="[item.current ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                                                        <component :is="item.icon"
                                                            :class="[item.current ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600', 'h-6 w-6 shrink-0']"
                                                            aria-hidden="true" />
                                                        {{ item.name }}
                                                    </button>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <div class="text-xs font-semibold leading-6 text-gray-400">Your teams</div>
                                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                                                <li v-for="item in administrativo" :key="item.name">
                                                    <button @click="redirectToView(item.href)" type="button" class="w-full"
                                                        :class="[item.current ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                                                        <component :is="item.icon"
                                                            :class="[item.current ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600', 'h-6 w-6 shrink-0']"
                                                            aria-hidden="true" />
                                                        {{ item.name }}
                                                    </button>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="mt-auto">
                                            <a href="#"
                                                class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                <Cog6ToothIcon
                                                    class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600"
                                                    aria-hidden="true" />
                                                Settings
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4">
                <div class="flex h-16 shrink-0 items-center space-x-2">
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                        alt="Erase una vez" />
                    <h1 class="font-semibold text-indigo-700">EUV</h1>
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li v-for="item in navigation" :key="item.name">
                                    <button @click="redirectToView(item.href)" type="button" class="w-full"
                                        :class="[item.current ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                                        <component :is="item.icon"
                                            :class="[item.current ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600', 'h-6 w-6 shrink-0']"
                                            aria-hidden="true" />
                                        {{ item.name }}
                                    </button>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="text-xs font-semibold leading-6 text-gray-400">Administrativo</div>
                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                                <li v-for="item in administrativo" :key="item.name">
                                    <button @click="redirectToView(item.href)" type="button" class="w-full"
                                        :class="[item.current ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                                        <component :is="item.icon"
                                            :class="[item.current ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600', 'h-6 w-6 shrink-0']"
                                            aria-hidden="true" />
                                        {{ item.name }}
                                    </button>
                                </li>
                            </ul>
                        </li>
                        <li class="mt-auto">
                            <a href="#"
                                class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                <Cog6ToothIcon class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600"
                                    aria-hidden="true" />
                                Settings
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="lg:pl-72">
            <div
                class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
                    <span class="sr-only">Open sidebar</span>
                    <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                </button>

                <!-- Separator -->
                <div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true" />

                <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6 justify-end">

                    <div class="flex items-center w-full justify-between gap-x-4 lg:gap-x-6">

                        <!-- INICIO: Breadcrumbs -->
                        <Breadcrumbs :breadcrumbs="props.breadcrumbs" />
                        <!-- FIN: Breadcrumbs -->

                        <!-- Profile dropdown -->
                        <Menu as="div" class="relative">
                            <MenuButton class="-m-1.5 flex items-center p-1.5">
                                <span class="sr-only">Abrir menú de usuario</span>
                                <img class="h-8 w-8 rounded-full bg-gray-50"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="" />
                                <span class="hidden lg:flex lg:items-center">
                                    <span class="ml-4 text-sm font-semibold leading-6 text-gray-900"
                                        aria-hidden="true">{{ $page.props.auth.user.name }}</span>
                                    <ChevronDownIcon class="ml-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                                </span>
                            </MenuButton>
                            <transition enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95">
                                <MenuItems
                                    class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                                    <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                                        <a :href="item.href"
                                            :class="[active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900']">{{ item.name }}
                                        </a>
                                    </MenuItem>
                                    <form @submit.prevent="logout">
                                        <MenuItem as="button">
                                            <a class="hover:bg-gray-50 block px-3 py-1 text-sm leading-6 text-gray-900">
                                                Cerrar Sesión
                                            </a>
                                        </MenuItem>
                                    </form>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>
            <Alert />
            <main class="py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script setup lang="ts">

import { ref } from 'vue';
import axios from 'axios';
import Breadcrumbs from '@/Components/Custom/Breadcrumbs.vue';
import Alert from '@/Components/Alert.vue';
import { Breadcrumb } from '@/types/breadcrumb';

const props = defineProps({
    breadcrumbs: Array<Breadcrumb>,
});


const current_route = window.location.pathname;

import { Dialog, DialogPanel, Menu, MenuButton, MenuItem, MenuItems, TransitionChild, TransitionRoot, } from '@headlessui/vue';
import { Bars3Icon, BellIcon, CalendarIcon, ChartPieIcon, Cog6ToothIcon, DocumentDuplicateIcon, FolderIcon, HomeIcon, UsersIcon, XMarkIcon, } from '@heroicons/vue/24/outline';

import { ChevronDownIcon, MagnifyingGlassIcon } from '@heroicons/vue/20/solid';

import { router } from '@inertiajs/vue3';

function redirectToView(ruta : string) {
    router.get(route(ruta));
};

const logout = () => {
    router.post(route('logout'));
};
const navigation = [
    { name: 'Inicio', href: "dashboard", icon: HomeIcon, current: current_route === "/dashboard" },
    { name: 'Mis cursos', href: "curso.index", icon: UsersIcon, current: current_route === "/curso" },
    { name: 'Mis estadisticas', href: "estadisticas", icon: ChartPieIcon, current: false },
]
const administrativo = [
    { name: 'Listado de cuentos', href: "cuento.index", icon: HomeIcon, current: current_route === "/cuento" },
]
const userNavigation = [
    // { name: 'Cerrar sesión', href: "logout" },
]

const sidebarOpen = ref(false)

</script>
