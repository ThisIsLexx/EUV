<!-- Spinner.vue -->
<template>
    <div class="loader"></div>
</template>

<style scoped>
.loader {
  border: 10px solid rgba(0, 0, 0, 0.1);
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border-left-color: #09f;
  animation: spin 1s ease infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}
</style>
