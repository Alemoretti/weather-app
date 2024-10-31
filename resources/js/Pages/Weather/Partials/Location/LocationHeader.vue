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
  import { Location } from '@/types';

  const props = defineProps({
    id: {
      type: Number,
      required: true
    }
  });

  const locationStore = useLocationStore();
  const location = computed<Location | undefined>(() => locationStore.getLocationById(props.id));

  // Computed property to format the location name for display removing comma
  const displayLocation = computed<string>(() => {
    if (location.value) {
      const nameParts = location.value.name.split(', ');
      return nameParts.filter(Boolean).join(', ');
    }
    return '';
  });
</script>