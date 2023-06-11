<script setup lang="ts">
import { ref } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation } from "swiper";
import "swiper/css";
import { getProvider } from "@/services/provider.js";
import { useAsyncState } from "@vueuse/core";

let currentIndex = ref(0);

const {
  state: providers,
  isReady,
  execute,
} = useAsyncState(() => {
  return getProvider();
}, {});

const emit = defineEmits(["updateProvider"]);

const changeProvider = (index, slug, title) => {
  currentIndex.value = index;
  emit("updateProvider", { slug, title });
};
</script>

<template>
  <div class="flex justify-start w-full mb-10">
    <button
      type="button"
      class="relative flex items-center px-2 py-2 text-white text-2xl shadow swiper-button-prev group rounded-l-xl bg-[#0369A1] group-hover:opacity-70"
    >
      <i class="fa-solid fa-chevron-left"></i>
    </button>
    <swiper
      class="flex-1 py-2 bg-black"
      :modules="[Navigation]"
      :slides-per-view="3"
      :initialSlide="currentIndex"
      rewind
      :breakpoints="{
        320: {
          slidesPerView: 2,
        },
        640: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 5,
        },
        1024: {
          slidesPerView: 7,
        },
      }"
      :navigation="{
        prevEl: '.swiper-button-prev',
        nextEl: '.swiper-button-next',
      }"
    >
      <swiper-Slide
        class="relative flex items-center justify-center border-gray-300 group !border-r last:border-r-0"
        v-for="(provider, i) in providers"
        :key="provider['id']"
      >
        <div
          @click="changeProvider(i, provider['slug'], provider['title'])"
          class="relative flex items-center justify-center w-full min-h-full p-0 px-4 py-2 m-0 text-center transition-all duration-500 ease-in-out cursor-pointer group-hover:bg-blue-900"
        >
          <img
            :src="provider['image']"
            :alt="provider['title']"
            :title="provider['title']"
            loading="lazy"
            class="h-12 transition-all duration-500 ease-in-out grayscale group-hover:grayscale-0"
          />
          <span
            aria-hidden="true"
            class="absolute inset-x-0 bottom-0 h-1"
            :class="currentIndex == i ? 'bg-amber-500' : 'bg-transparent'"
          />
        </div>
      </swiper-Slide>
    </swiper>
    <button
      type="button"
      class="relative flex items-center px-2 py-2 text-white text-2xl shadow swiper-button-next group rounded-r-xl bg-[#0369A1] group-hover:opacity-70"
    >
      <i class="fa-solid fa-chevron-right"></i>
    </button>
  </div>
</template>
