<script setup lang="ts">

import { ref } from 'vue';
import { Cuento } from '@/types/cuento';
import Separator from '@/Components/Separator.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
defineProps({
    cuentos: {
        type: Array,
        required: true
    }
});

const createCuento = () => {
    router.get('/cuento/create');
}

</script>

<template>
    <AppLayout title="Cuentos">
        <div>
            <div v-for="cuento in cuentos" class="p-5 border-2 m-5 rounded-md">
                <h1>{{ cuento.titulo }}</h1>
            <Separator />
                <p>{{ cuento.contenido }}</p>
            </div>
        </div>
        <form @submit.prevent="createCuento">
            <DropdownLink as="button">
                Crear nuevo cuento
            </DropdownLink>
        </form>
    </AppLayout>
</template>
