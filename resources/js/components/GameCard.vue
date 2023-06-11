<script setup lang="ts">
import { ref } from "vue";
import GameDialog from "@/components/GameDialog.vue";
import { isInRange } from "@/helper/isInRange";

const gameDialogRef = ref();

const props = defineProps({
  game: {
    type: Object,
  },
  provider: {
    type: String,
  },
});

const classBarColor = isInRange(props.game["rtp"], 0, 30)
  ? "bg-red-700"
  : isInRange(props.game["rtp"], 31, 60)
  ? "bg-yellow-700"
  : isInRange(props.game["rtp"], 61, 100)
  ? "bg-green-700"
  : "";

const openDialog = () => {
  gameDialogRef.value.openGameDialog();
};
</script>

<template>
  <div
    class="relative p-2 overflow-hidden border border-gray-500 rounded-md group"
  >
    <div class="mb-2 overflow-hidden rounded-md">
      <img
        :src="game['image']"
        :alt="game['name']"
        :title="game['name']"
        loading="lazy"
        class="w-full"
      />
    </div>

    <div class="w-full rounded-full bg-[#132142] relative mb-2">
      <div
        class="h-6 rounded-full"
        :class="classBarColor"
        :style="{ width: game['rtp'] + '%' }"
      ></div>

      <div class="absolute top-0 left-0 w-full font-semibold text-center">
        {{ game["rtp"] }}%
      </div>
    </div>

    <h3 class="w-full py-2 text-sm text-center md:text-base">
      {{ game["name"] }}
    </h3>

    <div
      class="absolute top-0 left-0 z-10 items-center justify-center w-full h-full md:hidden md:group-hover:flex"
    >
      <button
        class="flex items-center justify-center w-full h-full px-4 py-1 text-sm font-semibold rounded-full md:w-auto md:h-auto md:px-6 md:py-2 md:text-base lg:text-xl md:bg-gradient-to-b md:from-blue-500 md:to-blue-700 md:hover:bg-gradient-to-t"
        @click="openDialog()"
      >
        <span class="invisible md:visible">Cek Pola</span>
      </button>
    </div>

    <GameDialog :game="game" :provider="provider" ref="gameDialogRef" />
  </div>
</template>
