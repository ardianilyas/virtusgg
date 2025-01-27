<template>
  <Link :href="href" class="text-neutral-500 hover:text-neutral-700 text-sm">
    {{ label }}
  </Link>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3"

defineProps({
  href: {
    type: String,
    required: true
  },
  label: {
    type: String,
    required: true
  }
})
</script>