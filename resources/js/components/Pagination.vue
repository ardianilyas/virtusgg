<template>
  <nav class="my-12 relative flex justify-center">
    <div class="flex justify-center items-center space-x-4">
      <Button v-if="links.prev_page_url">
        <Link preserve-scroll :href="links.prev_page_url"> Prev </Link>
      </Button>
      <p> {{ links.current_page }} / {{ links.last_page }} </p>
      <Button v-if="links.next_page_url">
        <Link preserve-scroll :href="links.next_page_url"> Next </Link>
      </Button>
    </div>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import { Button } from "@/components/ui/button/index.js";
defineProps({
  links: Object
})
</script>