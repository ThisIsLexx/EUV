<script setup lang="ts">
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';

import { ArrowTopRightOnSquareIcon } from '@heroicons/vue/24/outline';

interface Props {
    id: string | number;
    route: string;
}

const props = defineProps<Props>();

function redirect() {
    router.get(props.route);
}

</script>

<template>
    <div @click="redirect" class="flex space-x-2 max-w-10 content-center items-center underline text-sky-600 hover:text-sky-600/80 hover:cursor-pointer">
        <span>
            <ArrowTopRightOnSquareIcon class="h-4 w-4" />
        </span>
        <span class="underline text-sky-600 hover:text-sky-600/80">
            {{ props.id }}
        </span>
    </div>
</template>
