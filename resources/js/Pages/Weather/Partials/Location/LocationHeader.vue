<template>
  <div class="bg-indigo-500 bg-opacity-25 p-6 lg:p-8 pb-0 lg:pb-0">
    <h2 class="text-lg text-indigo-900 font-bold">
      {{ displayLocation }}
    </h2>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useLocationStore } from '@/Store/LocationStore';

const props = defineProps({
  id: {
    type: Number,
    required: true
  }
});

const locationStore = useLocationStore();
const location = computed(() => locationStore.getLocationById(props.id));

const displayLocation = computed(() => {
  if (location.value) {
    const nameParts = location.value.name.split(', ');
    const city = nameParts[0] || '';
    const state = nameParts.length > 1 ? nameParts[1] : '';
    if (city && state) {
      return `${city}, ${state}`;
    } else if (city) {
      return city;
    } else if (state) {
      return state;
    }
  }
  return 'Location not found';
});
</script>