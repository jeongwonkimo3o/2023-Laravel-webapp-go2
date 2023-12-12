<template>
  <div class="fixed inset-0 flex items-center justify-center z-50">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative mx-auto max-w-3xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 bg-white rounded-2xl border border-gray-200 p-6 shadow-sm sm:px-8 lg:p-12">
      <div class="absolute top-0 right-0 m-4">
        <span class="text-gray-500 hover:text-gray-700 cursor-pointer" @click="store.commit('toggleWordAddModal')">×</span>
      </div>
      <div class="text-center">
        <h2 class="text-lg font-medium text-gray-900">
          단어 추가
          <span class="sr-only">Plan</span>
        </h2>
      </div>

      <form action="" class="space-y-4 mt-5">
        <div v-for="(value, key) in wordElements" :key="key"> 
          <input
            class="w-full rounded-lg border-gray-200 p-3 text-sm"
            :placeholder="value"
            type="text"
            v-model="inputValues[key]"
          />
        </div>
        
      </form>
      <a
        href="#"
        class="mt-8 block rounded-full border border-pink-600 bg-white px-12 py-3 text-center text-sm font-medium text-pink-600 hover:ring-1 hover:ring-pink-600 focus:outline-none focus:ring active:text-pink-500"
        @click="saveWord"
      >
        저장하기
      </a>
    </div>
  </div>

</template>

<script setup>

import { ref, watch, nextTick, reactive } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';
import axios from 'axios';

const store = useStore();
const route = useRoute();
const id = ref(route.params.id);

// 단어 추가 모달창에서 입력받은 값들을 담을 배열
let inputValues = reactive({}); 

const wordElements = ref({
      word: '단어',          // 단어
      mean: '의미',          // 의미
      pronunciation: '발음', // 발음
      pos: '품사',           // 품사
      synonym: '동의어',       // 동의어
      antonym: '반의어',       // 반의어
      explain: '설명'        // 설명
});


// inputValue를 API 통신을 통해 DB에 저장
function saveWord() {
  axios.post('/add-word', {
    title_id: id.value,
    word: inputValues.word,
    mean: inputValues.mean,
    pos: inputValues.pos,
    pronunciation: inputValues.pronunciation,
    synonym: inputValues.synonym,
    antonym: inputValues.antonym,
    explain: inputValues.explain
  })
  .then(function (response) {
    console.log(response);
    // 현재 페이지 새로고침
    alert('단어가 추가되었습니다.');
    location.reload();
  })
  .catch(function (error) {
    console.log(error);
  });
}



</script>
