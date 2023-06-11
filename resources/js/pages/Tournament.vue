<script setup lang="ts">
import { ref, reactive, onMounted, computed, markRaw, watchEffect } from "vue";
import { maskedString } from "@/helper/maskedString";
import { formatCurrency } from "@/helper/formatCurrency";
import { getWinnerLists } from "@/services/tournament.js";
import { getConfigs } from "@/services/config.js";
import TermsPopUp from "@/components/TermsPopUp.vue";
import { useAsyncState } from "@vueuse/core";
import dayjs from "dayjs";

const termsDialog = ref();

const { state: configs } = useAsyncState(() => {
  return getConfigs();
}, {});

const {
  state: winnerLists,
  isReady,
  execute,
} = useAsyncState(() => {
  return getWinnerLists();
}, {});

// const winnerLists = computed(() => state.value);
const timer = ref();

onMounted(() => {
  const interval = setInterval(async () => {
    const newResult = await getWinnerLists();
    winnerLists.value = markRaw(newResult);
  }, 10000);
  timer.value = interval;
});

const openTNC = () => {
  termsDialog.value.openTermsDialog();
};
</script>

<template>
  <div class="w-full text-center">
    <section
      class="w-full px-6 py-6 text-xl font-semibold text-black bg-center bg-no-repeat bg-cover md:text-3xl lg:text-5xl md:py-10"
      style="background-image: url('/images/bg_tournament.webp')"
    >
      TOURNAMENT LIVE GAMES
    </section>

    <section class="w-full px-4 py-8 mb-10 md:px-8">
      <h1 class="w-full mb-4 text-4xl font-bold">LEADERBOARDS</h1>

      <div
        class="flex flex-wrap items-center justify-between w-full mb-4 text-base text-white md:space-x-4 md:text-lg lg:text-2xl"
      >
        <div
          class="flex-1 px-4 py-4 rounded-md bg-gradient-to-b from-gray-700 to-black"
        >
          Start :
          <span class="font-semibold text-green-500">{{
            dayjs(configs["START_DATE"]).format("DD MMM YYYY")
          }}</span>
        </div>

        <div
          class="flex-1 px-4 py-4 ml-2 rounded-md bg-gradient-to-b from-gray-700 to-black"
        >
          End :
          <span class="font-semibold text-green-500">{{
            dayjs(configs["END_DATE"]).format("DD MMM YYYY")
          }}</span>
        </div>

        <div
          class="w-full px-4 py-4 mt-2 rounded-md bg-gradient-to-b from-gray-700 to-black md:w-auto md:flex-1 md:mt-0"
        >
          Last Update :
          <span class="font-semibold text-green-500">{{
            dayjs(configs["LAST_UPDATE"]).format("DD MMM YYYY")
          }}</span>
        </div>
      </div>

      <div class="flex justify-end w-full text-base font-semibold md:text-xl">
        <div @click="openTNC()" class="underline cursor-pointer">
          TERMS AND CONDITIONS
        </div>
      </div>

      <div class="w-full mt-4 text-white">
        <div class="flex justify-start w-full">
          <div
            class="py-2 text-sm font-semibold bg-green-500 rounded-t-md px-14 md:text-lg"
          >
            WINNER LISTS
          </div>
        </div>

        <table
          class="w-full text-base md:text-lg [&_th]:py-2 [&_th]:px-2 [&_td]:py-2 [&_td]:px-2 [&_tbody>tr:nth-child(odd)]:bg-gray-100 [&_tbody>tr:hover]:bg-gray-200"
        >
          <thead class="bg-green-500">
            <tr class="border-b-2 border-black">
              <th>
                <i class="text-2xl text-yellow-500 fa-solid fa-crown"></i>
              </th>
              <th>PLAYER ID</th>
              <th>GAMES</th>
              <th>TOTAL</th>
            </tr>
          </thead>

          <tbody class="font-semibold text-black">
            <tr v-for="(winner, i) in winnerLists['data']" :key="winner['id']">
              <td>{{ i + 1 }}</td>
              <td>{{ maskedString(winner["username"], 3) }}</td>
              <td>ALL GAMES</td>
              <td>{{ formatCurrency(winner["amount"]) }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <TermsPopUp ref="termsDialog" :configs="configs" />
  </div>
</template>
