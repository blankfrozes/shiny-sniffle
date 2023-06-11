<script setup lang="ts">
import { ref } from "vue";
import { loginLink, registerLink } from "@/services/config.js";

const show = ref(false);

const props = defineProps({
  game: {
    type: Object,
  },
  provider: {
    type: String,
  },
});

const openGameDialog = () => {
  document.documentElement.style.overflow = "hidden";
  show.value = true;
};

const closeGameDialog = () => {
  show.value = false;
  document.documentElement.style.overflow = "auto";
};

defineExpose({
  openGameDialog,
});
</script>

<template>
  <transition-fade>
    <div
      class="fixed inset-0 top-0 left-0 z-20 w-full h-full overflow-y-auto bg-slate-900/80 backdrop-blur"
      v-if="show"
      @click="closeGameDialog()"
    >
      <div
        class="flex items-center justify-center w-full min-h-full px-4 py-10"
      >
        <div
          class="w-full max-w-4xl rounded-lg overflow-hidden relative bg-[#132142]"
        >
          <div
            class="absolute top-0 right-0 z-20 px-4 py-4 text-2xl cursor-pointer [&:hover>i]:text-red-500"
          >
            <i class="fa-solid fa-xmark" @click="closeGameDialog()"></i>
          </div>

          <div class="grid w-full grid-cols-1 md:grid-cols-2">
            <div class="text-center">
              <h2 class="mt-4 mb-4">
                <span class="text-lg font-semibold text-yellow-500 font"
                  >RTP & Pola Gacor</span
                >
                <div class="w-full text-xl font-bold text-white mt-">
                  {{ game["name"] }}
                </div>
              </h2>

              <div class="flex justify-center w-full mb-4">
                <img
                  :src="game['image']"
                  :alt="game['name']"
                  :title="game['name']"
                  class="w-[50%] rounded-md"
                />
              </div>

              <div
                class="w-full px-4 py-1 text-base text-black bg-yellow-500"
                v-if="game['rtp'] > 30"
              >
                <div class="font-bold">LAKUKAN TIPS DARI AWAL & ULANGI</div>
                <div>NYALAKAN DOUBLE CHANCE JIKA ADA</div>
              </div>
            </div>

            <div>
              <table
                v-if="game['rtp'] > 30"
                class="w-full h-full rounded-sm bg-slate-900 [&_tr:nth-child(even)]:bg-slate-700 [&_td]:px-4 [&_td]:py-4 [&_td]:border [&_td]:border-black"
              >
                <tbody>
                  <tr>
                    <td>Provider</td>
                    <td>{{ provider }}</td>
                  </tr>
                  <tr>
                    <td>Game</td>
                    <td>{{ game["name"] }}</td>
                  </tr>
                  <tr>
                    <td>RTP</td>
                    <td>{{ game["rtp"] }}%</td>
                  </tr>
                  <tr>
                    <td>Jam Gacor</td>
                    <td>{{ game["time"] }}</td>
                  </tr>
                  <tr>
                    <td>Pola Slot Gacor</td>
                    <td>
                      {{ game["first_pattern"] }}<br />
                      {{ game["second_pattern"] }}<br />
                      {{ game["third_pattern"] }}
                    </td>
                  </tr>
                </tbody>
              </table>

              <div class="w-full px-10 py-10" v-else>
                RTP Untuk Permainan {{ game["name"] }} Saat Ini Sangat Rendah,
                Sangat Disarankan Untuk Mencoba Permainan Lain Yang RTPnya Lebih
                Tinggi
              </div>
            </div>
          </div>

          <div
            class="flex items-center justify-between w-full px-4 py-4 space-x-4"
          >
            <a
              :href="loginLink"
              class="flex items-center justify-center flex-1 px-4 py-[10px] text-white bg-blue-500 rounded-md hover:bg-blue-700"
              ><i class="mr-2 fa-solid fa-right-to-bracket"></i> Login
            </a>

            <a
              :href="registerLink"
              class="flex items-center justify-center flex-1 px-4 py-[10px] text-white rounded-md bg-rose-500 hover:bg-rose-700"
              ><i class="mr-2 fa-solid fa-user-plus"></i> Signup</a
            >
          </div>
        </div>
      </div>
    </div>
  </transition-fade>
</template>
