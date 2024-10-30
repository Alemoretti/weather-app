<template>
  <div>
    <LocationHeader
      :city="city"
      :state="state"
    />
    <WeatherData :forecast="forecast" />
  </div>
</template>

<script>
import LocationHeader from '@/Components/Location/LocationHeader.vue';
import WeatherData from '@/Components//Location/WeatherData.vue';

export default {
  name: 'LocationWeather',
  components: {
    LocationHeader,
    WeatherData
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