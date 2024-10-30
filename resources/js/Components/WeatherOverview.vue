<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import LocationWeather from '@/Components/Location/LocationWeather.vue';
import axios from 'axios';

const city = ref('');
const state = ref('');
const isLoading = ref(false);
const error = ref(null);
const locations = ref([]);

const submit = async () => {
  isLoading.value = true;
  error.value = null;
  const csrfToken = document.querySelector('meta[name="csrf-token"]');
  // check if log exists to send the request
  console.log('CSRF Token:', csrfToken ? csrfToken.getAttribute('content') : 'Not found');
  if (!csrfToken) {
    error.value = 'CSRF token not found';
    isLoading.value = false;
    return;
  }

  try {
    const response = await axios.put('/api/locations/create', {
      city: city.value || '',
      state: state.value || '',
      units: 'metric'
    }, {
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
        'Authorization': 'Bearer ' + csrfToken.getAttribute('content')
      },
      withCredentials: true
    });
    locations.value.push(response.data);

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
