<script setup lang="ts">

defineProps({
    margin: {
        type: String,
        required: false,
        default: "my-2"
    }
});

</script>

<template>
    <div class="border-b-2" :class="margin"></div>
</template>
