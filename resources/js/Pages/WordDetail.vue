<template>
 <HeaderVue />
  <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 ">
    <header class="flex justify-between items-end">
      <h2 class="text-xl font-medium text-gray-900 sm:text-2xl">
        단어장에 담긴 단어들을 확인할 수 있습니다.
      </h2>
      <div class="relative" >
        <WordDropdownVue />
     </div>
    </header>
  <WordsTableVue />
  </div>
  <FooterVue class="relative" />
</template>

<script setup>
import HeaderVue from '@/Components/Header.vue'
import FooterVue from '@/Components/Footer.vue'
import WordsTableVue from '@/Components/WordsTable.vue'
import WordDropdownVue from '@/Components/WordDropdown.vue'
</script>

<style>

</style>