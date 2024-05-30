<template>
    <nav class="flex" aria-label="Breadcrumb">
        <ol role="list" class="flex items-center space-x-4">
            <li>
                <div>
                    <button @click="redirectToPage('dashboard')" class="text-gray-400 hover:text-gray-500" v-if="pages">
                        <HomeIcon class="h-5 w-5 flex-shrink-0" aria-hidden="true"  />
                        <span class="sr-only">Home</span>
                    </button>
                    <button @click="redirectToPage('dashboard')" class="text-indigo-500 hover:text-indigo-600" v-else>
                        <HomeIcon class="h-5 w-5 flex-shrink-0" aria-hidden="true"  />
                        <span class="sr-only">Home</span>
                    </button>
                </div>
            </li>
            <li v-for="page in pages" :key="page.name">
                <div class="flex items-center">
                    <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                    <button type="button" @click="redirectToPage(page.href)"
                        :class="page.current ? 'font-semibold text-indigo-500 hover:text-indigo-600' : 'font-normal'"
                        class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                        :aria-current="page.current ? 'page' : undefined">{{ page.name }}
                    </button>
                </div>
            </li>
        </ol>
    </nav>
</template>

<script setup lang="ts">
import { ChevronRightIcon, HomeIcon } from '@heroicons/vue/20/solid';
import { Breadcrumb } from '@/types/breadcrumb';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    breadcrumbs: Array<Breadcrumb>,
});

function redirectToPage(href: string) {
    router.get(route(href));
}

const pages = props.breadcrumbs;

</script>
