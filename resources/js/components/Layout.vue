<script setup>
import Footer from "@/components/Footer.vue";
</script>

<template>
  <div class="w-full bg-[#132142] min-h-screen">
    <div class="container px-4 mx-auto md:px-0">
      <slot></slot>
      <Footer />
    </div>
  </div>
</template>
