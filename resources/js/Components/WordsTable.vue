<template>
<div class="overflow-x-auto mt-16">
  <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
    <thead class="ltr:text-left rtl:text-right">
      <tr>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          no
        </th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          단어
        </th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          발음
        </th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          뜻
        </th>
        <th class="px-4 py-2 font-medium text-gray-900">
          기타
        </th>
      </tr>
    </thead>

    <tbody v-for="(word, index) in words" :key="index" class="divide-y divide-gray-200 text-center">
      <tr>
        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          {{index+1}}
        </td>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{word.word}}</td>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{word.pronunciation}}</td>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{word.mean}}</td>
        <td class="whitespace-nowrap px-4 py-2">
          <a
            href="#"
            class="inline-block rounded bg-pink-400 px-4 py-2 text-xs font-medium text-white hover:bg-pink-700"
            @click="deleteWord(word.id)"
          >
            삭제
          </a>
        </td>
      </tr>

     

    </tbody>
  </table>
</div>
</template>

<script setup>
import axios from 'axios';
import { ref, watch } from 'vue';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';


// 단어 리스트를 배열에 담음
const words = ref([]);

const route = useRoute();
const id = ref('');

// 단어 리스트를 가져오는 API 통신하고 가져온 값을 words에 담음
const getWords = () => {
  axios.get(`/worddetail/${id.value}`)
    .then(response => {
      words.value = response.data;
      console.log(words.value);
    })
    .catch(error => {
      console.log(error);
    });
}

// 단어 id값 받아서 단어 삭제하는 API 통신
const deleteWord = (id) => {
  axios.delete(`/delete-word/${id}`)
    .then(response => {
      console.log(response);
      getWords();
    })
    .catch(error => {
      console.log(error);
    });
}

// watch는 마운트 기능도 있기 때문에 mount를 굳이 사용할 필요가 없다!
watch(() => route.params.id, (newId) => {
  if (newId) {
    id.value = newId;
    getWords();
  }
}, { immediate: true });

</script>

<style>

</style>