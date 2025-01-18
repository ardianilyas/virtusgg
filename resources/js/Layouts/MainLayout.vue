<template>
    <Navbar />
    <div class="container w-full my-12">
        <slot />
    </div>
</template>

<script setup>
import Navbar from "../components/Navbar.vue";
</script>
