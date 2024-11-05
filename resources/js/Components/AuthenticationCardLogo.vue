<script setup>
import { Link } from '@inertiajs/vue3';
import { AcademicCapIcon } from '@heroicons/vue/24/outline';
</script>

<template>
    <Link :href="'/'">
        <div class="flex items-center justify-center">
            <AcademicCapIcon class="w-8 h-8 text-indigo-500" />
            <span class="ml-2 text-2xl font-semibold text-indigo-500">Érase una vez</span>
        </div>
    </Link>
</template>
