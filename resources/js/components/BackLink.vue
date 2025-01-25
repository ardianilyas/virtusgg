<template>
  <Link :href="href" class="inline-flex items-center gap-2 text-sm text-blue-400 hover:text-blue-500 transition-all ease-in-out mb-3">
    <ArrowLeft class="w-4" />
    <slot />
  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import { ArrowLeft } from "lucide-vue-next";

defineProps({
  href: {
    type: String,
    required: true,
  }
})
</script>