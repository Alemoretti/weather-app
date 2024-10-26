<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Location from '@/Components/Location/Location.vue';
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <ApplicationLogo class="block h-12 w-auto" />
            <form class="mt-4">
                <div class="flex space-x-4">
                    <div class="flex-1">
                        <label for="city" class="block text-sm font-medium">City</label>
                        <input type="text" id="city" name="city" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" />
                    </div>
                    <div class="flex-1">
                        <label for="state" class="block text-sm font-medium">State</label>
                        <input type="text" id="state" name="state" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" />
                    </div>
                </div>
                <div class="mt-4 flex items-center space-x-2">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Add</button>
                    <p class="text-sm text-gray-500">You can save up to 3 records</p>
                </div>
            </form>
        </div>
        <Location />
    </div>
</template>
