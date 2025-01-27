<template>
  <div class="group mb-2">
    <div class="mb-2 flex items-center justify-between px-3 py-2 rounded-md cursor-pointer hover:bg-neutral-200/40 transition-all ease-in-out" @click="toggleDropdown">
      <div class="flex items-center gap-3 text-sm text-neutral-600">
        <slot name="icon" />
        {{ title }}
      </div>
      <ChevronDownIcon class="transition-transform" :class="{ 'rotate-180' : isOpen }" />
    </div>
    <transition
        name="slide-fade"
        enter-active-class="transition duration-300 ease-out"
        leave-active-class="transition duration-200 ease-in"
    >
      <div
          v-if="isOpen"
          class="pl-12 space-y-2 mt-2"
      >
        <div class="flex flex-col gap-2">
          <slot name="items" />
        </div>
      </div>
    </transition>
  </div>
</template>
<script setup>
import { ChevronDownIcon, DashboardIcon } from "@radix-icons/vue";
import { ref } from "vue";

defineProps({
  title: {
    type: String,
    required: true
  }
})

const isOpen = ref(false)

const toggleDropdown = () => {
  isOpen.value = !isOpen.value
}
</script>

<style scoped>
.slide-fade-enter-from {
  opacity: 0;
  transform: translateY(-10px);
}
.slide-fade-enter-to {
  opacity: 1;
  transform: translateY(0);
}
.slide-fade-leave-from {
  opacity: 1;
  transform: translateY(0);
}
.slide-fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>