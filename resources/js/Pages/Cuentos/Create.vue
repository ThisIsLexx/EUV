<script setup lang="ts">
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Separator from '@/Components/Separator.vue';


const form = reactive({
    titulo: null,
    contenido: null,
});

function submitForm() {
    router.post('/cuento', form);
}

</script>

<template>
    <AppLayout title="Crear Cuento">
        <div class="m-5">
            <h1>Crear Cuento</h1>
            <Separator />

            <form @submit.prevent="submitForm" >
                <div class="mb-4">
                    <label for="titulo">Titulo del cuento:</label>
                    <input type="text" name="titulo" v-model="form.titulo">

                    <label for="contenido">Contenido del cuento:</label>
                    <textarea name="contenido" v-model="form.contenido"></textarea>
                </div>
                <button type="submit" class="border-2 p-5 rounded-md">
                    Crear cuento
                </button>
            </form>

        </div>
    </AppLayout>
</template>
