<template>
  <div>
    <RegisterLocationForm @location-added="handleLocationAdded" />
    <div
      v-for="(location, index) in props.locations"
      :key="index"
      class="mt-4"
    >
      <LocationWeather
        :id="location.id"
        :name="location.name"
        :forecast="location.forecasts"
      />
    </div>
  </div>
</template>
  
<script setup>
import { defineEmits } from 'vue';
import RegisterLocationForm from '@/Pages/Weather/Partials/Location/LocationForm.vue';
import LocationWeather from '@/Pages/Weather/Partials/Location/LocationWeather.vue';
import { defineProps } from 'vue';

const props = defineProps({
  locations: {
    type: Array,
    default: () => []
  }
});

const emit = defineEmits(['location-added']);

const handleLocationAdded = (newLocation) => {
  emit('location-added', newLocation);
};
</script>