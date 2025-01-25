<template>
  <Button class="mb-3">
    <PlusIcon />
    <slot />
  </Button>
</template>

<script setup>
import { PlusIcon } from "@radix-icons/vue";
import { Button } from "@/components/ui/button/index.js";
</script>