<script setup lang="ts">
import { ref } from 'vue';
import { Cuento } from '@/types/cuento';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Breadcrumb } from '@/types/breadcrumb';

const props = defineProps({
    cuento: Object as () => Cuento,
    breadcrumbs: Array<Breadcrumb>,
});

</script>

<template>
    <AppLayout :breadcrumbs="props.breadcrumbs">
        <h1 class="text-3xl">
            {{ props.cuento.titulo }}
        </h1>
    </AppLayout>
</template>
