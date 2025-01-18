<template>
    <Link
        class="font-light hover:text-orange-500 transition-all ease-in-out"
        :href="href"
        :class="active ? 'text-orange-500' : 'text-neutral-600 '">
        {{ label }}
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    label: String,
    href: String,
    active: Boolean
})
</script>
