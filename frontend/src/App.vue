
<script setup>
import { ref, onMounted } from 'vue'
import BooksList from './components/BooksList.vue'

const reviews = ref([])

const getBooks = async () => {
  reviews.value = []
  const res = await fetch('http://127.0.0.1:8000/api/books')
  reviews.value = await res.json()
}


onMounted(async () => {
  getBooks()
})

</script>

<template>
  <div class="max-w-xl mx-auto">
    <div class="w-full border-b border-gray-400 mb-6">
      <h2 class="text-3xl font-bold mb-4 uppercase">Books</h2>
    </div>
    <div v-if="reviews.length === 0">loading...</div>

    <ul v-else class="space-y-4 animate-blurred-fade-in">
      <BooksList v-for="item in reviews" :key="item.id" :msg="item" />
    </ul>
    <div class="text-center p-4">
      <button class="text-center bg-green-600 px-3 py-1 rounded-lg text-white text-xs" @click="getBooks">Refresh</button>
    </div>
  </div>
</template>
