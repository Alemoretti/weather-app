<template>
  <div class="bg-indigo-500 bg-opacity-25 p-6 lg:p-8 pb-0 lg:pb-0">
    <h2 class="text-lg font-medium text-gray-900">
      {{ displayLocation }}
    </h2>
  </div>
</template>
  
  <script>
  export default {
    name: 'LocationHeader',
    props: {
      city: {
        type: String,
        required: true
      },
      state: {
        type: String,
        required: true
      }
    },
    computed: {
    displayLocation() {
      if (this.city && this.state) {
        return `${this.city}, ${this.state}`;
      } else if (this.city) {
        return this.city;
      } else if (this.state) {
        return this.state;
      } else {
        return '';
      }
    }
  }
  };
  </script>