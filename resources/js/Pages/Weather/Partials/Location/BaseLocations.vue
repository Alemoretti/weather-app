<template>
  <div>
    <LocationForm :count="count" />
    <div
      v-for="(location) in locations"
      :key="location.id"
      class="mt-4"
    >
      <LocationWeather :id="location.id" />
    </div>
  </div>
</template>
  
<script setup lang="ts">
import LocationForm from '@/Pages/Weather/Partials/Location/LocationForm.vue';
import LocationWeather from '@/Pages/Weather/Partials/Location/LocationWeather.vue';
import { onMounted, computed } from 'vue';
import { Location } from '@/types'
import { useLocationStore } from '@/Store/LocationStore';

const locationStore = useLocationStore();

onMounted(() => {
  locationStore.fetchLocations();
});

const locations = computed<Location[]>(() => locationStore.getLocations);
const count = computed<number>(() => locationStore.getLocationCount);
</script>