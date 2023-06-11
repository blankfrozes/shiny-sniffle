<script setup lang="ts">
import { loginLink, registerLink } from "@/services/config.js";
</script>

<template>
  <div class="flex items-center justify-center w-full mb-10 space-x-4">
    <a
      :href="loginLink"
      class="flex items-center justify-center w-28 px-4 py-[10px] text-white bg-blue-500 rounded-md hover:bg-blue-700"
      ><i class="mr-2 fa-solid fa-right-to-bracket"></i> Login
    </a>

    <a
      :href="registerLink"
      class="flex items-center justify-center w-28 px-4 py-[10px] text-white rounded-md bg-rose-500 hover:bg-rose-700"
      ><i class="mr-2 fa-solid fa-user-plus"></i> Signup</a
    >
  </div>
</template>
