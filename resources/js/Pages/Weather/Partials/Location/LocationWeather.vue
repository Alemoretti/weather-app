<template>
  <div v-if="location">
    <button
      @click="deleteLocation"
      class="bg-red-600 text-white hover:bg-red-700 p-1"
    >
      REMOVE
    </button> 
    <LocationHeader :id="props.id" />   
    <ForecastData :forecast="location.forecasts" />
  </div>
  <div v-else>
    <p>Loading...</p>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { useLocationStore } from '@/Store/LocationStore';
import LocationHeader from '@/Pages/Weather/Partials/Location/LocationHeader.vue';
import ForecastData from '@/Pages/Weather/Partials/Forecast/ForecastData.vue';
import { Location } from '@/types';

const props = defineProps({
  id: {
    type: Number,
    required: true
  }
});

const locationStore = useLocationStore();
const location = computed<Location | undefined>(() => locationStore.getLocationById(props.id));

const deleteLocation = async () => {
  try {
    await locationStore.deleteLocation(props.id);
  } catch (error) {
    console.error('Error deleting location:', error);
  }
};
</script>