<script setup lang="ts">
import dayjs from "dayjs";
</script>

<template>
  <div class="w-full py-20">
    <div class="flex justify-center w-full mb-6">
      <img
        src="/images/kapital4d_logo.png"
        alt="Kapital4D"
        class="h-8 md:h-14"
      />
    </div>

    <div class="w-full text-sm text-center text-white">
      &copy; {{ dayjs().format("YYYY") }} Kapital4D. All rights reserved.
    </div>
  </div>
</template>
class=""
