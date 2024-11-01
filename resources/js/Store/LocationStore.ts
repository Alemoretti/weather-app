import { defineStore } from 'pinia'
import axios from 'axios'
import { useWeatherApi } from '@/Composables/useWeatherApi'
import { Location, LocationState, Errors } from '@/types'

export const useLocationStore = defineStore('location', {
  state: (): LocationState => ({
    locations: [],
    errors: {} as Errors
  }),
  actions: {
    async fetchLocations(): Promise<void> {
      const { fetchLocations } = useWeatherApi()
      try {
        this.locations = await fetchLocations()
      } catch (error) {
        console.error('Error fetching locations:', error)
      }
    },
    async addLocation(locationData: Partial<Location>): Promise<void> {
      const { postLocation } = useWeatherApi()
      try {
        const location = await postLocation(locationData)
        this.locations.push(location)
        this.errors = {}
      } catch (errors) {
        if (axios.isAxiosError(errors) && errors.response) {
          this.errors = errors.response.data.errors as Errors
        } else {
          console.error('Unexpected error:', errors)
        }
      }
    },
    async deleteLocation(locationId: number): Promise<void> {
      const { deleteLocation } = useWeatherApi()
      try {
        await deleteLocation(locationId)
        this.locations = this.locations.filter((location: Location) => location.id !== locationId)
      } catch (error) {
        console.error('Error deleting location:', error)
      }
    }
  },
  getters: {
    getLocations: (state: LocationState): Location[] => state.locations,
    getLocationById: (state: LocationState) => (id: number): Location | undefined => state.locations.find(location => location.id === id),
    getLocationCount: (state: LocationState): number => state.locations.length,
    getErrors: (state: LocationState): Errors => state.errors
  }
})