<template>
  <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
    <ApplicationLogo />
    <h1 class="mt-4 text-2xl font-bold text-indigo-700">
      Weather App
    </h1>
    <div class="mt-6">
      <a
        href="/login"
        class="text-lg font-semibold text-gray-700 hover:text-gray-900"
      >
        Login
      </a>
      <a
        href="/register"
        class="ml-4 text-lg font-semibold text-gray-700 hover:text-gray-900"
      >
        Register
      </a>
    </div>
  </div>
</template>
  
  <script setup lang="ts">
  import ApplicationLogo from '@/Components/ApplicationLogo.vue';
  </script>