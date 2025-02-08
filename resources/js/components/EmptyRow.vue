<template>
  <TableRow>
    <TableCell :colSpan="colSpan" class="text-center font-medium">
      <slot />
    </TableCell>
  </TableRow>
</template>

<script setup>
import { TableCell, TableRow } from "@/components/ui/table/index.js";

defineProps({
  colSpan: {
    type: String,
    required: true
  }
})
</script>