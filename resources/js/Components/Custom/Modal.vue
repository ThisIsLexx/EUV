<script setup lang="ts">
import Separator from '@/Components/Separator.vue'

defineEmits(['closeModal']);

defineProps({
    showModal: {
        type: Boolean,
        default: false,
    },
    size: {
        type: String,
        default: "lg", // sm, md, lg
    },
    titulo: {
        type: String,
        default: "Titulo",
    },
});

</script>

<template>
    <transition
                enter-active-class="ease-out duration-300"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="ease-in duration-200"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
    >
        <div class="absolute w-full bg-black bg-opacity-30 h-screen top-0 left-0 flex justify-center px-8 z-50" v-if="showModal">
            <transition
                enter-active-class="ease-out duration-300"
                enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                leave-active-class="ease-in duration-200"
                leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <div class="p-4 bg-white self-start mt-32 max-w-screen-md rounded-md" v-if="showModal"
                    :class="{ 'w-full' : size === 'lg' }"
                >
                    <h1>{{  titulo }}</h1>
                    <Separator />
                    <slot name="modal-content"/>
                    <div class="flex justify-end w-full space-x-1 mt-6">
                        <button  class="text-white p-2 rounded-md shadow-sm hover:shadow-md bg-gray-500 hover:bg-gray-500/90" @click="$emit('closeModal')">
                            <span>
                                Cerrar
                            </span>
                        </button>
                        <slot name="action-button"/>
                    </div>
                </div>
            </transition>
        </div>
    </transition>
</template>
