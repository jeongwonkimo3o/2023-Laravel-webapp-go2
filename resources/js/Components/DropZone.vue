<template>
  <form>
    <div class="flex items-center justify-center w-full">
      <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-pink-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
          <div class="flex flex-col items-center justify-center pt-5 pb-6">
              <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
              </svg>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">클릭해서 업로드</span>하세요!</p>
              <p class="text-xs text-gray-500 dark:text-gray-400">csv 파일 외 다른 확장자는 지원되지 않습니다. (xlsx 파일 등)</p>
          </div>
            <input id="dropzone-file" type="file" ref="fileInput" class="hidden" @change="uploadFile" />
      </label>
    </div> 
  </form>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useStore } from 'vuex';


const fileInput = ref(null);
const store = useStore();

const uploadFile = () => {
  if (!fileInput.value.files.length) {
    alert('파일을 선택해 주세요.');
    return;
  }

  const formData = new FormData();
  formData.append('file', fileInput.value.files[0]);

  axios.post('/upload', formData)
    .then(response => {
      console.log(response);
      store.dispatch('setFileUploaded', true);
    })
    .catch(error => {
      console.log(error);
    });
}
</script>
