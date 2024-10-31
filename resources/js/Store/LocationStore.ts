import { defineStore } from 'pinia'
import axios from 'axios'
import { Location, LocationState, Errors } from '@/types';

export const useLocationStore = defineStore('location', {
  state: (): LocationState => ({
    locations: [],
    errors: {} as Errors
  }),
  actions: {
    async fetchLocations(): Promise<void> {
      try {
        const response = await axios.get<Location[]>('/api/locations')
        this.locations = response.data
      } catch (error) {
        console.error('Error fetching locations:', error)
      }
    },
    async addLocation(locationData: Partial<Location>): Promise<void> {
      try {
        const response = await axios.post<Location>('/api/locations', locationData)
        this.locations.push(response.data)
        this.errors = {}
      } catch (error) {
        if (axios.isAxiosError(error) && error.response) {
          console.log(error.response.data)
        } else {
          console.error('Unexpected error:', error)
        }
        if (axios.isAxiosError(error) && error.response && error.response.status === 422) {
          if (axios.isAxiosError(error) && error.response) {
            this.errors = error.response.data.errors
          }
        } else {
          console.error('Error adding location:', error)
        }
      }
    },
    async deleteLocation(locationId: number): Promise<void> {
      try {
        await axios.delete(`/api/locations/${locationId}`)
        this.locations = this.locations.filter((location: Location) => location.id !== locationId)
      } catch (error) {
        console.error('Error deleting location:', error)
      }
    },
  },
  getters: {
    getLocations: (state: LocationState): Location[] => state.locations,
    getLocationById: (state: LocationState) => (id: number): Location | undefined => state.locations.find(location => location.id === id),
    getLocationCount: (state: LocationState): number => state.locations.length,
    getErrors: (state: LocationState): Errors => state.errors
  }
})