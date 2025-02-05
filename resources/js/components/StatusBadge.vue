<template>
  <span :class="statusClass" class="px-2 py-1 text-xs rounded-full">
    <slot />
  </span>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  status: {
    required: true,
    type: String
  }
})

const statusClass = computed(() => {
  switch (props.status) {
    case 'accepted' : return 'bg-green-200 text-green-700';
    case 'pending' : return 'bg-yellow-200 text-yellow-700';
    case 'rejected' : return 'bg-red-200 text-red-700';
  }
})
</script>