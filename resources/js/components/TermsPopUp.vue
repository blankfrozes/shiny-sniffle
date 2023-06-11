<script setup lang="ts">
import { ref } from "vue";
import dayjs from "dayjs";

const show = ref(false);

const props = defineProps({
  configs: {
    type: Object,
  },
});

const openTermsDialog = () => {
  document.documentElement.style.overflow = "hidden";
  show.value = true;
};

const closeTermsDialog = () => {
  show.value = false;
  document.documentElement.style.overflow = "auto";
};

defineExpose({
  openTermsDialog,
});
</script>

<template>
  <transition-fade>
    <div
      class="fixed top-0 z-50 flex flex-col items-center justify-center w-full h-full px-4 bg-black bg-opacity-50"
      v-if="show"
      @click="closeTermsDialog()"
    >
      <div class="w-full max-w-lg bg-white rounded-md">
        <div
          class="flex items-start justify-start w-full px-4 py-4 border-b-2 border-black"
        >
          <div class="flex-1 text-lg font-bold text-left md:text-2xl">
            TERMS & CONDITIONS
          </div>

          <div
            class="ml-2 text-2xl cursor-pointer [&:hover>i]:text-red-500"
            @click="closeTermsDialog()"
          >
            <i class="fa-solid fa-xmark"></i>
          </div>
        </div>

        <div class="max-h-[70vh] overflow-y-auto px-4 py-4 text-left">
          <div class="w-full mb-4 font-semibold">Terms & Conditions :</div>

          <ol class="pl-6 list-decimal">
            <li>
              Promo berlaku untuk turnover semua permainan yang ada di Kapital4D
            </li>
            <li>
              Perhitungan turnover promo dari tanggal
              {{ dayjs(configs["START_DATE"]).format("DD MMMM YYYY") }} s/d
              {{ dayjs(configs["END_DATE"]).format("DD MMMM YYYY") }} dan bonus
              akan dibagikan pada tanggal
              {{ dayjs(configs["LAST_UPDATE"]).format("DD MMMM YYYY") }}
            </li>
            <li>
              Promo akan dibagikan pada tanggal
              {{ dayjs(configs["LAST_UPDATE"]).format("DD MMMM YYYY") }} paling
              lambat pukul 13:00 WIB
              <ul class="list-[upper-alpha] pl-6 my-6">
                <li>
                  Pencapaian Turnover Tertinggi Urutan 1 Mendapatkan Bonus
                  7.000.000
                </li>
                <li>
                  Pencapaian Turnover Tertinggi Urutan 2 Mendapatkan Bonus
                  5.000.000
                </li>
                <li>
                  Pencapaian Turnover Tertinggi Urutan 3 Mendapatkan Bonus
                  3.000.000
                </li>
                <li>
                  Pencapaian Turnover Tertinggi Urutan 4 s/d 10 Mendapatkan
                  Bonus 1.000.000
                </li>
                <li>
                  Pencapaian Turnover Tertinggi Urutan 11 s/d 50 Mendapatkan
                  Bonus 300.000
                </li>
                <li>
                  Pencapaian Turnover Tertinggi Urutan 51 s/d 100 Mendapatkan
                  Bonus 200.000
                </li>
                <li>
                  Pencapaian Turnover Tertinggi Urutan 101 s/d 200 Mendapatkan
                  Bonus 100.000
                </li>
              </ul>
            </li>
            <li>
              Bonus tidak bisa diproses jika kedapatan memiliki kesamaan IP dan
              nomor rekening.
            </li>
            <li>
              Member dilarang keras melakukan taruhan 2 sisi, saftety bet, no
              risk bet & cara taruhan lain yang bertujuan menipu nominal
              turnover.
            </li>
            <li>
              Syarat dan Ketentuan dapat berubah sewaktu-waktu tanpa harus ada
              pemberitahuan terlebih dahulu.
            </li>
            <li>
              Semua keputusan dari KAPITAL4D sudah Mutlak & tidak dapat di
              ganggu gugat lagi.
            </li>
          </ol>
        </div>
      </div>
    </div>
  </transition-fade>
</template>
