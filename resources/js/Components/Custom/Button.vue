<script setup lang="ts">
import { defineProps } from 'vue';

interface Props {
    message: string;
    button: "button" | "submit" | "reset";
    type: string;
    disabled: boolean;
    icon: string;
}

const props = defineProps<Props>();

let bgColor = '';

switch (props.type) {
    case 'primary':
        bgColor = 'bg-indigo-500 hover:bg-indigo-500/90';
        break;
    case 'secondary':
        bgColor = 'bg-gray-500 hover:bg-gray-500/90';
        break;
    case 'danger':
        bgColor = 'bg-red-500 hover:bg-red-500/90';
        break;
    default:
        bgColor = 'bg-indigo-500 hover:bg-indigo-500/90';
        break;
}

</script>

<template>
    <button :type="`${button}`" :class="`text-white p-2 rounded-md shadow-sm hover:shadow-md btn btn-${type} ${bgColor}`" :disabled="disabled">
        <i v-if="props.icon" :class="`${props.icon}`"></i>
        <span>{{ message }}</span>
    </button>
</template>
