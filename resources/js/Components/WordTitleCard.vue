<template>
<div v-for="(wordTitle, index) in wordTitles" :key="index" class="mb-4">
  <article class="rounded-xl mt-10 border-2 border-gray-100 bg-white">
  <div class="flex items-start gap-4 p-4 sm:p-6 lg:p-6">
    <div>
      <h3 class="font-medium sm:text-lg">
      <a :href="`/worddetail/${wordTitle.id}`" class="hover:underline">
            {{ wordTitle.title }}
          </a>
      </h3>
    </div>
  </div>

  <div>
    <div class="mt-2 pl-5 sm:flex sm:items-center sm:gap-2 flex justify-self-start">
        <div class="flex items-center gap-1 text-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
            <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
            </svg>
          <p class="text-xs cursor-pointer" @click="deleteWordTitle(wordTitle.id)">삭제하기</p>
        </div>
      </div>

  <div class="flex justify-end">
    
    <strong
      class="-mb-[2px] -me-[2px] inline-flex items-center gap-1 rounded-ee-xl rounded-ss-xl bg-pink-400 px-3 py-1.5 text-white"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-4 w-4"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
        />
      </svg>

      <span class="text-[10px] font-medium sm:text-xs">1회독</span>
    </strong>
  </div>
</div>
</article>
</div>
</template>

<script setup>

import axios from 'axios';
import { ref } from 'vue';
import { onMounted } from 'vue';

// 가져온 리스트를 배열에 담음
const wordTitles = ref([]);

// 유저가 가지고 있는 단어장 리스트를 가져오는 API 통신하고 가져온 값을 wordTitles에 담음
const getWordTitles = () => {
  axios.get('/titles')
    .then(response => {
      wordTitles.value = response.data;
      console.log(wordTitles.value);
    })
    .catch(error => {
      console.log(error);
    });
}

// 삭제 버튼을 누르면 단어장을 삭제하는 API 통신을 한다
const deleteWordTitle = (id) => {
  axios.delete(`/delete-title/${id}`)
    .then(response => {
      console.log(response);
      getWordTitles();
    })
    .catch(error => {
      console.log(error);
    });
}

onMounted(() => {
  getWordTitles();
});

</script>

<style>

</style>