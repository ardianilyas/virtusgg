<template>
    <Link
        :href="href"
        class="mb-2 group flex items-center px-3 py-2 text-neutral-800 dark:text-neutral-100 text-sm font-light rounded-md hover:bg-neutral-200/40 dark:hover:bg-neutral-800 dark:hover:text-neutral-100 transition-colors"
        :class="isActive ? 'bg-neutral-200/40' : 'text-gray-600'"
    >
        <slot name="icon" /> <span class="ml-3">{{ label }}</span>
    </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link
    },
    props: {
        href: {
            type: String,
            required: true,
        },
        label: {
            type: String,
            required: true,
        },
        isActive: {
            type: Boolean,
            required: true,
        },
    },
};
</script>
