<template>
 <HeaderVue />
  <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 ">
    <header class="flex justify-between items-end">
      <h2 class="text-xl font-medium text-gray-900 sm:text-2xl">
        다른 유저가 공유한 단어장을 받아올 수 있습니다.
      </h2>
      <div class="relative" >
        <WordDropdownVue />
     </div>
    </header>
  <WordsTableVue />
  </div>
  <FooterVue />
</template>

<script>
import HeaderVue from '@/Components/Header.vue'
import FooterVue from '@/Components/Footer.vue'
import WordsTableVue from '@/Components/WordsTable.vue'
import WordDropdownVue from '@/Components/WordDropdown.vue'


export default {
  components: {
    HeaderVue,
    FooterVue,
    WordsTableVue,
    WordDropdownVue
  }
}
</script>

<style>

</style>