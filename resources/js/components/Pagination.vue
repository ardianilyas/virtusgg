<template>
  <nav class="my-12 relative flex justify-center">
    <div class="flex justify-center space-x-4">
      <Link preserve-scroll v-if="links.prev_page_url != null" :href="links.prev_page_url" class="text-gray-800 hover:text-blue-600" :class="{ '!text-gray-500' : links.prev_page_url == null }"> Previous </Link>
      <p> {{ links.current_page }} / {{ links.last_page }} </p>
      <Link preserve-scroll v-if="links.next_page_url" :href="links.next_page_url" class="text-gray-800 hover:text-blue-600" :class="{ '!text-gray-500' : links.next_page_url == null }"> Next </Link>
    </div>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
defineProps({
  links: Object
})
</script>