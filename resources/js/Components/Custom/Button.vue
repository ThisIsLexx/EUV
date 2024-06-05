<script setup lang="ts">
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';
import { PlayIcon } from '@heroicons/vue/24/solid';

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
        redirect: {
            type: String,
            default: null,
            required: false,
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

function redirect () {
    router.get(route(props.redirect));
}

</script>

<template>
    <div v-if="props.redirect" @click="redirect()">
        <button :type="`${type}`" :class="`text-white p-2 rounded-md shadow-sm hover:shadow-md btn ${bgColor}`" :disabled="disabled">
            <div v-if="icon === 'PlayIcon'">
                <PlayIcon class="w-6 h-6" />
            </div>
            <span>{{ message }}</span>
        </button>
    </div>
    <div v-else>
        <button :type="`${type}`" :class="`text-white p-2 rounded-md shadow-sm hover:shadow-md btn ${bgColor}`" :disabled="disabled">
            <div v-if="icon === 'PlayIcon'">
                <PlayIcon class="w-6 h-6" />
            </div>
            <span>{{ message }}</span>
        </button>
    </div>
</template>
