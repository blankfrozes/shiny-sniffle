<script setup lang="ts">
import Layout from "@/components/Layout.vue";
import Logo from "@/components/Logo.vue";
import ButtonRow from "@/components/ButtonRow.vue";
import Heading from "@/components/Heading.vue";
import Carousel from "@/components/Carousel.vue";
import Games from "@/components/Games.vue";
import { ref } from "vue";

let titleProvider = ref("Pragmatic Play");
let slugProvider = ref("pragmatic");
let gamesRef = ref();

const changeProvider = (data) => {
  titleProvider.value = data.title;
  slugProvider.value = data.slug;

  gamesRef.value.updateProviderSlug(data.slug);
};
</script>

<template>
  <Layout>
    <Logo />
    <ButtonRow />
    <Heading :title="titleProvider" />
    <Carousel @updateProvider="changeProvider" />
    <Games :slug="slugProvider" :title="titleProvider" ref="gamesRef" />
  </Layout>
</template>
