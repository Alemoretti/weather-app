<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Weather App
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg">
          <ApplicationLogo />
          <div class="p-6 lg:p-8 bg-white">
            <BaseLocations />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import BaseLocations from '@/Pages/Weather/Partials/Location/BaseLocations.vue';
</script>
