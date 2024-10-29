<template>
  <div class="bg-indigo-500 bg-opacity-25 p-6 lg:p-8 pb-0 lg:pb-0">
    <h2 class="text-lg font-medium text-gray-900">
      {{ city }}, {{ state }}
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
    }
  };
  </script>