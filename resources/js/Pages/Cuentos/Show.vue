<script setup lang="ts">
import { ref } from 'vue';
import { Cuento } from '@/types/cuento';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    cuento: Object as () => Cuento,
});

</script>

<template>
    <AppLayout>
        <h1 class="text-3xl">
            {{ props.cuento.titulo }}
        </h1>
    </AppLayout>
</template>
