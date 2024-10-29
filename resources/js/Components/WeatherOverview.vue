<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import LocationWeather from '@/Components/Location/LocationWeather.vue';

const city = ref('');
const state = ref('');
const isLoading = ref(false);
const error = ref(null);
const locations = ref([]);

const submit = async () => {
  isLoading.value = true;
  error.value = null;
  const csrfToken = document.querySelector('meta[name="csrf-token"]');

  if (!csrfToken) {
    error.value = 'CSRF token not found';
    isLoading.value = false;
    return;
  }

  try {
    const response = await fetch('/api/weather/add', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({
        city: city.value,
        state: state.value,
        units: 'metric'
      }),
    });
    console.error(response.ok);
    if (!response.ok) {
      throw new Error('Bad response');
    }

    const data = await response.json();
    locations.value.push(data);
    console.log(data);
  } catch (err) {
    error.value = 'An error occurred when trying to fetch the data.';
    console.error(err);
  } finally {
    isLoading.value = false;
  }
};

</script>

<template>
  <div>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
      <ApplicationLogo class="block h-12 w-auto" />
      <form
        @submit.prevent="submit"
        class="mt-4"
      >
        <div class="flex space-x-4">
          <div class="flex-1">
            <label
              for="city"
              class="block text-sm font-medium"
            >City</label>
            <input
              v-model="city"
              type="text"
              id="city"
              name="city"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
            >
          </div>
          <div class="flex-1">
            <label 
              for="state" 
              class="block text-sm font-medium"
            >
              State
            </label>
            <input
              v-model="state"
              type="text"
              id="state"
              name="state"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
            >
          </div>
        </div>
        <div class="mt-4 flex items-center space-x-2">
          <button
            type="submit"
            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
          >
            Add location
          </button>
          <p class="text-sm text-gray-500">
            You can save up to 3 records
          </p>
        </div>
      </form>
    </div>
    <div
      v-for="(location, index) in locations"
      :key="index"
    >
      <LocationWeather
        :city="location.city || ''"
        :state="location.state || ''"
        :forecast="location.forecast"
      />
    </div>
  </div>
</template>
