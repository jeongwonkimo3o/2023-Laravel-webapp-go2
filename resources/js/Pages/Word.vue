<template>
  <HeaderVue />
  <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 ">
    <header class="flex justify-between items-end">
      <h2 class="text-xl font-medium text-gray-900 sm:text-2xl">
        보유 중인 단어장입니다.
      </h2>
    </header>
    <WordTitleCardVue class="mt-10" />
  </div>
  <FooterVue class="relative"/>
</template>

<script setup>
import HeaderVue from '@/Components/Header.vue'
import WordTitleCardVue from '@/Components/WordTitleCard.vue'
import FooterVue from '@/Components/Footer.vue'


</script>

<style>

</style>