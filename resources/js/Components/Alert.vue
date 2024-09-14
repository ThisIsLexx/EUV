<template>
    <transition
    appear
    enter-from-class="opacity-0 scale-95"
    enter-to-class="opacity-100 scale-100"
    enter-active-class="transition ease-out duration-300"
    leave-from-class="opacity-100 scale-100"
    leave-to-class="opacity-0 scale-95"
    leave-active-class="transition ease-in duration-300"

    >
        <div v-if="visible"
        :class="alertClass"
        class="fixed min-w-[420px] justify-start top-20 right-4 p-4 rounded shadow-xl z-40">

            <div class="flex items-center">
                <component :is="alertIcon" class="h-6 w-6 mr-2" />
                <span>{{ message }}</span>
            </div>
        </div>
    </transition>
</template>

<script setup lang="ts">
import { computed, ref, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { CheckCircleIcon, ExclamationCircleIcon, InformationCircleIcon, ExclamationTriangleIcon } from '@heroicons/vue/24/outline';

interface FlashProps {
    success?: string;
    danger?: string;
    warning?: string;
    info?: string;
}

interface PageProps {
    flash?: FlashProps;  // El flash puede no estar definido al inicio
}

const page = usePage<{ props: PageProps }>();
const visible = ref(false);
const message = ref('');
const type = ref('');

const alertIcon = computed(() => {
    switch (type.value) {
        case 'success':
            return CheckCircleIcon;
        case 'info':
            return InformationCircleIcon;
        case 'warning':
            return ExclamationTriangleIcon;
        case 'danger':
            return ExclamationCircleIcon;
        default:
            return InformationCircleIcon;
    }
});

const alertClass = computed(() => {
    switch (type.value) {
        case 'success':
            return 'bg-emerald-100/60 !text-emerald-800';
        case 'danger':
            return 'bg-red-100/60 !text-red-800';
        case 'warning':
            return 'bg-orange-100/60 !text-orange-800';
        case 'info':
            return 'bg-blue-100/60 !text-blue-800';
        default:
            return 'bg-gray-100/60 !text-gray-800';
    }
});

// Verifica si el flash message de éxito cambia
watch(() => page.props.flash, (flash: FlashProps) => {
    if (flash?.success) {
        message.value = flash.success;
        type.value = 'success';
        visible.value = true;
    } else if (flash?.info) {
        message.value = flash.info;
        type.value = 'info';
        visible.value = true;
    } else if (flash?.warning) {
        message.value = flash.warning;
        type.value = 'warning';
        visible.value = true;
    }

    if (visible.value) {
        setTimeout(() => {
            visible.value = false;
        }, 3000); // Ocultar después de 3 segundos
    }
}, { immediate: true });

</script>
