<template>
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y-2 divide-gray-200 text-sm">
      <thead class="ltr:text-left rtl:text-right">
        <tr>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
            no
          </th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
            단어장 이름
          </th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
            언어 선택
          </th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
            전송여부
          </th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
            기타
          </th>
        </tr>
      </thead>

       <tbody class="divide-y divide-gray-200 text-center">
      <tr v-for="(wordTitle, index) in wordTitles" :key="index">
        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          {{ index + 1 }}
        </td>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ wordTitle.title }}</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">
            <select
              name="language"
              id="language"
              class="mt-1.5 w-20 rounded-lg border-white text-gray-700 sm:text-sm"
              @change="event => selectLanguage(event, wordTitle)"
            >
              <option value="EN">설정</option>
              <option value="EN">EN</option>
              <option value="JP">JP</option>
              <option value="CHN">CHN</option>
              <option value="ETC">ETC</option>
            </select>
          </td>
          <td>
            <span>완료</span>
          </td>
          <td class="whitespace-nowrap px-4 py-2">
            <a
              href="#"
              class="inline-block rounded text-pink-500 px-4 py-2 text-xs font-medium hover:text-pink-700"
              @click="deleteFile(wordTitle.id)"
            >
              취소
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<script setup>
import { computed, watch, ref } from 'vue';
import { useStore } from 'vuex';
import axios from 'axios';

const store = useStore();
const isFileUploaded = computed(() => store.state.isFileUploaded);

const wordTitles = ref([]);
const lang = ref('');

// 파일 업로드 상태가 변경될 때 마다 실행
watch(isFileUploaded, (newValue) => {
  if (newValue) {
    // DB에서 파일 목록 가져오기
    fetchWordTitles();
    store.dispatch('setFileUploaded', false);
  }
});

// DB에서 파일 목록 가져오는 함수
const fetchWordTitles = () => {
  axios.get('/upload-title')
    .then(response => {
      // 데이터가 추가될 때마다 배열에 update
       const newWordTitles = [...wordTitles.value, ...response.data.map(wordTitle => ({...wordTitle, lang: 'EN'}))];
      wordTitles.value = newWordTitles;
      console.log(wordTitles.value);

      // store에 저장
      store.dispatch('setWordTitles', newWordTitles);

    })
    .catch(error => {
      console.error("단어장 로드에 실패 했습니다.", error);
    });
};

// 파일 삭제 함수
const deleteFile = (id) => {
  axios.delete(`/delete-title/${id}`)
    .then(response => {
      // 삭제한 파일을 제외한 나머지 파일만 배열에 update
      wordTitles.value = wordTitles.value.filter(wordTitle => wordTitle.id !== id);
    })
    .catch(error => {
      console.error("단어장 삭제에 실패 했습니다.", error);
    });
};

// language를 선택하면 language 변수에 값이 저장됨
const selectLanguage = (event, wordTitle) => {
  wordTitle.lang = event.target.value;
  saveLanguage(wordTitle.lang, wordTitle.id);
};

// language를 선택하면 DB에 저장되는 함수
const saveLanguage = (lang, id) => {
  axios.post(`/setting-lang/${id}`, {
    lang: lang
  })
    .then(response => {
      console.log(response);
    })
    .catch(error => {
      console.error("언어 업데이트를 실패 했습니다.", error);
    });
};

</script>


<style>

</style>