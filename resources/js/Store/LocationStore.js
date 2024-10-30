import { defineStore } from 'pinia'
import axios from 'axios'

export const useLocationStore = defineStore('location', {
  state: () => ({
    locations: [],
    errors: {}
  }),
  actions: {
    async fetchLocations() {
      try {
        const response = await axios.get('/api/locations')
        this.locations = response.data
      } catch (error) {
        console.error('Error fetching locations:', error)
      }
    },
    async addLocation(locationData) {
        try {
          const response = await axios.post('/api/locations', locationData)
          this.locations.push(response.data)
          this.errors = {}
        } catch (error) {
            console.log(error.response.data)
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors
          } else {
            console.error('Error adding location:', error)
          }
        }
      },
    async deleteLocation(locationId) {
        try {
            await axios.delete(`/api/locations/${locationId}`)
            this.locations = this.locations.filter(location => location.id !== locationId)
        } catch (error) {
            console.error('Error deleting location:', error)
        }
    },
  },
  getters: {
    getLocations: (state) => state.locations,
    getLocationById: (state) => (id) => state.locations.find(location => location.id === id),
    getLocationCount: (state) => state.locations.length,
    getErrors: (state) => state.errors
  }
})