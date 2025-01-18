<template>
    <button class="bg-orange-400 inline-flex text-white font-semibold px-5 py-2 rounded-full shadow-md shadow-orange-300">
        {{ label }}
    </button>
</template>

<script setup>
defineProps({
    label: String,
})
</script>
