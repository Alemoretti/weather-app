<template>
  <div>
    <button
      @click="deleteLocation"
      class=" bg-red-600 text-white rounded-md hover:bg-red-700"
    >
      Delete Location
    </button> 
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
import axios from 'axios';

export default {
  name: 'LocationWeather',
  components: {
    LocationHeader,
    ForecastData
  },
  emits: ['locationDeleted'],
  props: {
    id: {
      type: Number,
      required: true
    },    
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
  },
  methods: {
    async deleteLocation() {
      try {
        await axios.delete(`/api/locations/${this.id}`);
        this.$emit('locationDeleted', this.id);
      } catch (error) {
        console.error('Error deleting location:', error);
      }
    }
  }
};
</script>