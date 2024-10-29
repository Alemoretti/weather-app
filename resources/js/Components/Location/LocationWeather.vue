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
    city: {
      type: String,
      required: true
    },
    state: {
      type: String,
      required: true
    },
    forecast: {
      type: Object,
      required: true
    }
  }
};
</script>