<script setup lang="ts">
import { defineProps } from 'vue';



const props = defineProps(
    {
        message: {
            type: String,
            required: true,
        },
        type: {
            type: String as () => "button" | "submit" | "reset",
            required: true,
        },
        button: {
            type: String as () => "primary" | "secondary" | "danger",
            default: "primary",
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        icon: {
            type: String,
            default: null,
        },
    }
);

let bgColor = '';

switch (props.button) {
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
    <button :type="`${type}`" :class="`text-white p-2 rounded-md shadow-sm hover:shadow-md btn ${bgColor}`" :disabled="disabled">
        <div v-if="icon">
            <{{ icon }} />
        </div>
        <i v-if="icon" :class="`${icon}`"></i>
        <span>{{ message }}</span>
    </button>
</template>
