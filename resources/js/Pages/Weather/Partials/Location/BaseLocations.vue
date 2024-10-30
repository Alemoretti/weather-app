<template>
  <div>
    <LocationForm />
    <div
      v-for="(location) in locations"
      :key="location.id"
      class="mt-4"
    >
      <LocationWeather :id="location.id" />
    </div>
  </div>
</template>
  
<script setup>
import LocationForm from '@/Pages/Weather/Partials/Location/LocationForm.vue';
import LocationWeather from '@/Pages/Weather/Partials/Location/LocationWeather.vue';
import { onMounted, computed } from 'vue';
import { useLocationStore } from '@/Store/LocationStore';


const locationStore = useLocationStore();

onMounted(() => {
  locationStore.fetchLocations();
});

const locations = computed(() => locationStore.getLocations);
</script>