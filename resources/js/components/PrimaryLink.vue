<template>
    <Link :href="href" class="bg-orange-400 inline-flex text-white font-semibold px-5 py-2 rounded-full shadow-md shadow-orange-300">
        {{ label }}
    </Link>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";

defineProps({
    href: String,
    label: String
})
</script>
