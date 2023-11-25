<template>
  <HeaderVue />
  <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 ">
    <header class="flex justify-between items-end">
      <h2 class="text-xl font-medium text-gray-900 sm:text-2xl">
        다른 유저가 공유한 단어장을 받아올 수 있습니다.
      </h2>
      <div class="relative" >
        <languageDropdownVue />
     </div>
    </header>
     <StoreCardVue class="mt-12" />
     <StoreCardVue class="mt-5" />
     <StoreCardVue class="mt-5" />
  </div>
  <FooterVue />
</template>

<script>
import languageDropdownVue from '@/Components/languageDropdown.vue';
import HeaderVue from '../Components/Header.vue';
import ModalVue from '../Components/Modal.vue';
import StoreCardVue from '@/Components/StoreCard.vue';
import FooterVue from '@/Components/Footer.vue'

export default {

    components: {
        HeaderVue,
        ModalVue,
        languageDropdownVue,
        StoreCardVue,
        FooterVue
    }

}
</script>

<style>

</style>