<template>
  <div class="bg-indigo-500 bg-opacity-25 grid grid-cols-1 md:grid-cols-3 gap-6 pt-2 lg:gap-8 p-6 lg:p-8 lg:pt-2">
    <div
      v-for="(day, date) in forecast"
      :key="date"
    >
      <div class="flex items-center">
        <img
          :src="day.weather_icon"
          :alt="day.weather"
        >
        <div class="ms-3">
          <h2 class="text-sm font-semibold text-gray-900">
            {{ formatDate(day.date) }}
          </h2>
          <p class="text-gray-700">
            {{ day.weather }}
          </p>
          <p class="text-gray-700">
            Min: {{ day.min_temp }}
          </p>
          <p class="text-gray-700">
            Max: {{ day.max_temp }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script>
  export default {
    name: 'WeatherData',
    props: {
      forecast: {
        type: Object,
        required: true
      }
    },
    methods: {
      formatDate(date) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(date).toLocaleDateString('en-US', options);
      }
    }
  };
  </script>