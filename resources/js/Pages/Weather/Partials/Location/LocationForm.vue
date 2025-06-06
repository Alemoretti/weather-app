<template>
  <p
    v-if="count > 2"
    class="text-red-500"
  >
    You have reached the maximum number of locations. Please delete a location before adding more.
  </p>
  <form
    v-else
    class="mt-4 mb-10 border-b-2 pb-10"
    @submit.prevent="submit"
  >
    <h1 class="text-indigo-500 mb-4 font-bold">
      Insert the city and state of the location you want to add
    </h1>
    <div class="flex space-x-4">
      <div class="flex-1">
        <label
          for="city"
          class="block text-sm font-medium"
        >City</label>
        <input
          id="city"
          v-model="city"
          type="text"
          name="city"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
        >
        <div
          v-if="validationErrors.city"
          class="text-red-500 text-sm mt-1"
        >
          {{ validationErrors.city[0] }}
        </div>
      </div>
      <div class="flex-1">
        <label
          for="state"
          class="block text-sm font-medium"
        >State</label>
        <input
          id="state"
          v-model="state"
          type="text"
          name="state"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
        >
        <div
          v-if="validationErrors.state"
          class="text-red-500 text-sm mt-1"
        >
          {{ validationErrors.state[0] }}
        </div>
      </div>
    </div>
    <div class="mt-4 flex items-center space-x-2">
      <button
        type="submit"
        class="px-4 py-2 bg-indigo-600 text-white  hover:bg-indigo-700"
      >
        REGISTER
      </button>
      <p class="text-sm text-gray-500">
        You can register up to 3 locations
      </p>
    </div>
    <div
      v-if="isLoading"
      class="mt-4 flex justify-center"
    >
      <Spinner />
    </div>
  </form>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { useLocationStore } from '@/Store/LocationStore'
import Spinner from '@/Components/LoadingSpinner.vue'
import { Errors } from '@/types'

defineProps({
  count: {
    type: Number,
    required: true
  }
})

const locationStore = useLocationStore()
const city = ref<string>('')
const state = ref<string>('')
const isLoading = ref<boolean>(false)
const validationErrors = computed<Errors>(() => locationStore.getErrors)

const submit = async () => {
  isLoading.value = true

  try {
    await locationStore.addLocation({
      city: city.value || '',
      state: state.value || '',
      units: 'metric'
    })

    city.value = ''
    state.value = ''
  } catch (err) {
    console.error(err)
  } finally {
    isLoading.value = false
  }
}
</script>
