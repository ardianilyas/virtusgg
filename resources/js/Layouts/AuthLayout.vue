<template>
    <Toaster richColors position="top-right" close-button />
    <div class="w-full min-h-screen flex justify-center items-center">
        <Card class="max-w-xl w-full">
            <h4 class="text-2xl font-medium text-neutral-800">
                <slot name="title" />
            </h4>
            <p class="mt-1 text-sm text-neutral-600 leading-snug">
                <slot name="subtitle" />
            </p>
            <slot />
        </Card>
    </div>
</template>

<script setup>
import Card from "@/components/Card.vue";
import { Toaster } from "@/components/ui/sonner";
</script>
