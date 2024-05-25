<script setup lang="ts">
import { router, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Separator from '@/Components/Separator.vue';
import Button from '@/Components/Custom/Button.vue';
import { errorMessages } from 'vue/compiler-sfc';

const form = useForm({
    titulo: null,
    contenido: null,
});

</script>

<template>
    <AppLayout title="Crear Cuento">
        <div class="m-20">
            <div class="border bg-white shadow-md p-5">
                <h1>Crear Cuento</h1>
                <Separator />
                <form @submit.prevent="form.post('/cuento')" class="mt-5">
                    <div class="mb-4">
                        <div class="flex flex-col space-y-2 mb-2">
                            <label for="titulo" :class="{'text-red-600' : form.errors.titulo}">Titulo del cuento:</label>
                            <input type="text" name="titulo"
                            class="transition duration-100 rounded-md border-gray-300 shadow-sm focus:ring-indigo-200 focus:border-indigo-200"
                            :class="{ 'border-red-600' : form.errors.titulo }"
                            v-model="form.titulo"
                            >
                            <div v-if="form.errors.titulo" class="text-red-500 text-xs uppercase">
                                {{ form.errors.titulo }}
                            </div>
                        </div>

                        <div class="flex flex-col space-y-2 mb-2">
                            <label for="contenido" :class="{ 'text-red-600' : form.errors.contenido }">Contenido del cuento:</label>
                            <textarea name="contenido"
                            class="transition duration-100 rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-200"
                            :class="{ 'border-red-600' : form.errors.contenido }"
                            v-model="form.contenido"></textarea>
                            <div v-if="form.errors.contenido" class="text-red-500 text-xs uppercase">
                                {{ form.errors.contenido }}
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end w-full space-x-1">
                        <Button message="Cancelar" type="button" button="secondary" redirect="cuento.index"/>
                        <Button message="Crear nuevo cuento" type="submit" button="primary" redirect="" />
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
