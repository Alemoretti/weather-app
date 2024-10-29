<template>
  <div class="bg-indigo-500 bg-opacity-25 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 p-6 lg:p-8">
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
          <h2 class="text-xl font-semibold text-gray-900">
            {{ date }}
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
    }
  };
  </script>