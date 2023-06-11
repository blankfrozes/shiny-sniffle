<script setup lang="ts">
import { ref } from "vue";
import dayjs from "dayjs";

const clockText = ref();

const clock = () => {
  clockText.value = dayjs().format("dddd, DD MMMM YYYY HH:mm:ss");
};

setInterval(clock, 1000);

const props = defineProps({
  title: {
    type: String,
  },
});
</script>

<template>
  <div class="w-full mb-6 text-base text-center text-white md:text-xl">
    <h1 class="w-full mb-4 text-2xl font-bold md:text-4xl">
      RTP Live Slot
      <span class="text-yellow-500 underline">{{ title }}</span>
    </h1>

    <div class="w-full mb-4">
      Klik gambar untuk melihat info pola dan jam gacor terbaru.
    </div>

    <div class="w-full" v-if="clockText">{{ clockText }}</div>
    <div v-else class="w-full">Kapital4D</div>
  </div>
</template>
