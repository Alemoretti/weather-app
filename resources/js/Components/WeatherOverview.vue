<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import LocationWeather from '@/Components/Location/LocationWeather.vue';
import axios from 'axios';
import Spinner from '@/Components/Spinner/LoadingSpinner.vue';

const city = ref('');
const state = ref('');
const isLoading = ref(false);
const error = ref(null);
const locations = ref([]);
const validationErrors = ref({});

const submit = async () => {
  isLoading.value = true;
  error.value = null;
  validationErrors.value = {};
  const csrfToken = document.querySelector('meta[name="csrf-token"]');

  if (!csrfToken) {
    error.value = 'CSRF token not found';
    isLoading.value = false;
    return;
  }

  try {
    const response = await axios.post('/api/locations', {
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
    if (err.response && err.response.status === 401) {
      error.value = 'Unauthorized: Please log in.';
    } else if (err.response && err.response.status === 403) {
      error.value = 'Forbidden: You do not have permission to perform this action.';
    } else if (err.response && err.response.status === 422) {
      validationErrors.value = err.response.data.errors;      
    } else {
      error.value = 'An error occurred when trying to fetch the data.';
    }
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
        class="mt-4"
        @submit.prevent="submit"
      >
        <div class="flex space-x-4">
          <div class="flex-1">
            <label
              for="city"
              class="block text-sm font-medium"
            >City</label>
            <input
              id="city"
              v-model="city"
              type="text"
              name="city"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
            >
            <div
              v-if="validationErrors.city"
              class="text-red-500 text-sm mt-1"
            >
              {{ validationErrors.city[0] }}
            </div>            
          </div>
          <div class="flex-1">
            <label 
              for="state" 
              class="block text-sm font-medium"
            >
              State
            </label>
            <input
              id="state"
              v-model="state"
              type="text"
              name="state"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
            >
            <div
              v-if="validationErrors.state"
              class="text-red-500 text-sm mt-1"
            >
              {{ validationErrors.state[0] }}
            </div>            
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
      <div
        v-if="isLoading"
        class="mt-4 flex justify-center"
      >
        <Spinner />
      </div>      
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
