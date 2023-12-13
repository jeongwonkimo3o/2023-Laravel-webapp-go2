<template>
  <article 
      v-for="(word, index) in wordTitles" 
      :key="index" 
      class="rounded-xl border-2 mt-10 border-gray-100 bg-white"
    >
      <div class="flex items-start gap-4 p-4 sm:p-6 lg:p-8">
        <div>
          <h3 class="font-medium sm:text-lg">
            <span class="hover:underline">
              {{ word.title }}
            </span>
          </h3>
          <div class="mt-2 sm:flex sm:items-center sm:gap-2">
            <div class="flex items-center gap-1 text-gray-500">
              <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                <path d="M480-320 280-520l56-58 104 104v-326h80v326l104-104 56 58-200 200ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/>
              </svg>
              <p class="text-xs cursor-pointer" @click="downloadWordTitle(word.id)">가져오기</p>
            </div>
            <span class="hidden sm:block" aria-hidden="true">&middot;</span>
            <p class="hidden sm:block sm:text-xs sm:text-gray-500">
              shared by
              <span class="font-medium underline hover:text-gray-700">
                {{ word.users[0].name }}
          </span>
        </p>
      </div>
    </div>
  </div>

  <div class="flex justify-end">
    <strong
      class="-mb-[2px] -me-[2px] inline-flex items-center gap-1 rounded-ee-xl rounded-ss-xl bg-pink-600 px-3 py-1.5 text-white"
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

      <span class="text-[10px] font-medium sm:text-xs">이미 있어요</span>
    </strong>
  </div>
</article>
</template>

<script setup>

import axios from 'axios';
import { ref, computed } from 'vue';
import { onMounted } from 'vue';
import { useStore } from 'vuex';

// 가져온 리스트를 배열에 담음
const store = useStore();
const wordTitles = computed(() => store.state.wordTitles);


// 유저가 가지고 있는 단어장 리스트를 가져오는 API 통신하고 가져온 값을 wordTitles에 담음
const getWordTitles = () => {
  axios.get('/stored-word-titles')
    .then(response => {
      store.commit('setWordTitles', response.data); // Vuex 스토어 업데이트
    })
    .catch(error => {
      console.log(error);
    });
};



// 단어장 다운로드를 누르면 단어장을 다운로드하는 API 통신을 한다
const downloadWordTitle = (id) => {
  axios.post(`/download-word-title/${id}`)
    .then(response => {
      alert('성공적으로 다운 받았습니다!')
    })
    .catch(error => {
      console.log(error);
    });
}

// 마운트 될 때마다 getWordTitles 함수를 실행
onMounted(() => {
  getWordTitles();
});

</script>

<style>

</style>