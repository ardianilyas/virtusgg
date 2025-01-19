<template>
    <Toaster richColors position="top-right" close-button />
    <Navbar />
    <div class="container w-full my-12">
        <slot />
    </div>
</template>

<script setup>
import Navbar from "../components/Navbar.vue";
import { Toaster } from "@/components/ui/sonner";
</script>
