<script setup>
import { ref } from 'vue'

defineProps({
  msg: String,
})

const count = ref(0)
</script>

<template>
      <li
        class="p-3 rounded-lg shadow bg-gray-100 hover:scale-105 transition-transform duration-200"
      >
      <div class="flex justify-between items-center">
        <h3 class="font-bold text-lg">{{ msg.title }} - {{ msg.published_year }}</h3>
        <span class="text-[10px] rounded-full bg-gray-700 text-white px-3 py-1">{{ msg.average_rating }}</span>
      </div>
        <p class="text-sm text-gray-700">{{ msg.author }}</p>
      </li>
</template>


