<script setup lang="ts">
import { ref, reactive, computed, onMounted } from "vue";
import GameCard from "@/components/GameCard.vue";
import GameCardSkeleton from "@/components/GameCardSkeleton.vue";
import { getGames } from "@/services/games.js";
import { useAsyncState } from "@vueuse/core";

const props = defineProps({
  slug: {
    type: String,
  },
  title: {
    type: String,
  },
});

const input = reactive({
  search: "",
});

let currentPage = ref(1);
const pagination = reactive({
  first: 0,
  last: 5,
  total: 5,
});

const { state, isReady, isLoading, execute } = useAsyncState((args) => {
  let current_page = args?.page || 1;
  let slug = args?.slug || props.slug;
  let search = args?.search || "";

  if (current_page < 1) {
    current_page = 1;
  }

  if (current_page <= 3) {
    pagination.first = 0;
    pagination.last = 5;
    pagination.total = 5;
  } else {
    pagination.first = current_page - 3;
    pagination.last = current_page + 2;
    pagination.total = pagination.last - pagination.first;
  }

  return getGames(slug, current_page, search);
}, {});

const games = computed(() => state.value["data"]);
const paginationData = computed({
  get() {
    if (pagination.last > state.value["pagination"]["total_pages"]) {
      pagination.last = state.value["pagination"]["total_pages"];
      pagination.total = pagination.last - pagination.first;
    }

    return state.value["pagination"];
  },
  set() {},
});

currentPage = computed(() => paginationData.value["current_page"]);

const searchGames = () => {
  execute(0, { slug: props.slug, search: input.search });
};

const updateProviderSlug = (slug) => {
  execute(0, { slug: slug });
};

defineExpose({
  updateProviderSlug,
});
</script>

<template>
  <div class="w-full text-white bg-black rounded-md">
    <div
      class="flex flex-wrap items-center justify-start w-full px-2 py-2 md:px-6 md:py-6 space-y-4 border-b border-gray-50 border-opacity-30 md:space-x-2"
    >
      <div class="flex-1 w-full md:w-auto">
        <span class="text-xl font-bold">List Master RTP Gacor {{ title }}</span>
        <br />
        Terupdate & Paling Gacor. Gunakan Kolom Di Samping Untuk Mencari Game
        Anda.
      </div>

      <div class="relative w-full text-black md:w-auto">
        <input
          type="text"
          class="w-full py-2 pl-10 pr-2 rounded-md md:w-72"
          placeholder="Cari Game Anda"
          v-model="input.search"
          @input="searchGames()"
        />

        <div
          class="absolute top-0 left-0 flex items-center justify-center w-10 h-full text-xl text-gray-500"
        >
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
      </div>
    </div>

    <div
      class="grid w-full grid-cols-2 gap-2 px-2 py-2 md:px-6 md:py-6 md:gap-6 md:grid-cols-4 lg:grid-cols-6"
      v-if="isReady"
    >
      <GameCard
        v-for="game in games"
        :key="game['id']"
        :game="game"
        :provider="title"
      />
    </div>

    <div
      class="grid w-full grid-cols-2 gap-6 px-6 py-6 md:grid-cols-4 lg:grid-cols-6"
      v-if="isLoading"
    >
      <GameCardSkeleton v-for="i in 30" :key="i" />
    </div>

    <div
      class="items-center justify-start hidden w-full px-6 py-6 border-t md:flex border-gray-50 border-opacity-30"
      v-if="isReady"
    >
      <div class="flex-1">
        Showing {{ paginationData["from"] }} to {{ paginationData["to"] }} of
        {{ paginationData["total"] }} results
      </div>

      <div class="ml-2">
        <div
          class="flex items-stretch justify-start overflow-hidden text-sm rounded-md bg-slate-900 ring-1 ring-slate-700/50"
        >
          <button
            class="px-3 py-2 text-white border border-gray-500 rounded-l-md hover:bg-blue-700 disabled:bg-gray-700"
            :disabled="currentPage <= 1"
            @click="
              execute(0, {
                slug: slug,
                page: currentPage - 1,
              })
            "
          >
            <i class="fa-solid fa-chevron-left"></i>
          </button>

          <button
            v-for="i in pagination.total"
            :key="i"
            :class="currentPage == i + pagination.first ? '!bg-blue-500' : ''"
            class="w-10 px-1 py-2 border border-gray-500 hover:bg-blue-700"
            @click="
              execute(0, {
                slug: slug,
                page: i + pagination.first,
              })
            "
          >
            {{ i + pagination["first"] }}
          </button>

          <button
            class="px-3 py-2 text-white border border-gray-500 rounded-r-md hover:bg-blue-700 disabled:bg-gray-700"
            :disabled="currentPage >= paginationData['total_pages']"
            @click="
              execute(0, {
                slug: slug,
                page: currentPage + 1,
              })
            "
          >
            <i class="fa-solid fa-chevron-right"></i>
          </button>
        </div>
      </div>
    </div>

    <div
      class="flex items-center justify-between w-full px-2 py-2 md:px-6 md:py-6 text-sm font-semibold text-white border-t md:hidden border-gray-50 border-opacity-30"
      v-if="isReady"
    >
      <button
        class="px-4 py-2 rounded-md bg-slate-900 hover:bg-blue-500 disabled:bg-gray-500"
        :disabled="currentPage <= 1"
        @click="
          execute(0, {
            slug: slug,
            page: currentPage - 1,
          })
        "
      >
        Previous
      </button>

      <button
        class="px-4 py-2 rounded-md bg-slate-900 hover:bg-blue-500 disabled:bg-gray-500"
        :disabled="currentPage >= paginationData['total_pages']"
        @click="
          execute(0, {
            slug: slug,
            page: currentPage + 1,
          })
        "
      >
        Next
      </button>
    </div>
  </div>
</template>
