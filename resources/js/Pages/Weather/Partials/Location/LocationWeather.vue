<template>
  <div>
    <LocationHeader
      :city="city"
      :state="state"
    />
    <ForecastData :forecast="forecast" />
  </div>
</template>

<script>
import LocationHeader from '@/Pages/Weather/Partials/Location/LocationHeader.vue';
import ForecastData from '@/Pages/Weather/Partials/Forecast/ForecastData.vue';

export default {
  name: 'LocationWeather',
  components: {
    LocationHeader,
    ForecastData
  },
  props: {
    name: {
      type: String,
      required: true
    },
    forecast: {
      type: Object,
      required: true
    }
  },
  computed: {
    city() {
      return this.name.split(', ')[0] || '';
    },
    state() {
      return this.name.split(', ')[1] || '';
    }
  }  
};
</script>