import axios from 'axios'
import { Location } from '@/types'

export const useWeatherApi = () => {
  const postLocation = async (locationData: Partial<Location>) => {
    try {
      const response = await axios.post<Location>('/api/locations', locationData)
      return response.data
    } catch (error) {
      if (axios.isAxiosError(error) && error.response) {
        throw error.response.data.errors
      } else {
        throw new Error('Unexpected error')
      }
    }
  }

  const fetchLocations = async () => {
    try {
      const response = await axios.get<Location[]>('/api/locations')
      return response.data
    } catch (error) {
      if (axios.isAxiosError(error) && error.response) {
        throw error.response.data.errors
      } else {
        throw new Error('Unexpected error')
      }
    }
  }

  const deleteLocation = async (locationId: number) => {
    try {
      await axios.delete(`/api/locations/${locationId}`)
    } catch (error) {
      if (axios.isAxiosError(error) && error.response) {
        throw error.response.data.errors
      } else {
        throw new Error('Unexpected error')
      }
    }
  }

  return {
    postLocation,
    fetchLocations,
    deleteLocation
  }
}