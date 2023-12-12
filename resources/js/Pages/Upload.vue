<template>
  <div class="flex flex-col min-h-screen">
    <HeaderVue />
    <section>
      <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        <header>
          <h2 class="text-xl font-medium text-gray-900 sm:text-2xl">
            CSV 파일을 업로드 할 수 있습니다.
          </h2>
        </header>
        <DropZoneVue class="mt-10" />
        <UploadFileListVue class="mt-10" />
      </div>
    </section>
    <FooterVue class="mt-16"/>
  </div>
</template>


<script setup>
import DropZoneVue from '@/Components/DropZone.vue';
import HeaderVue from '../Components/Header.vue';
import ModalVue from '../Components/Modal.vue';
import UploadFileListVue from '@/Components/UploadFileList.vue';
import FooterVue from '@/Components/Footer.vue'


</script>

<style>

</style>