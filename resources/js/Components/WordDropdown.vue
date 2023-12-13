<template>
<WordAddModalVue v-if="store.state.wordAddModal"/>
  <div
    class="relative inline-flex items-center overflow-hidden "
  >
    <p
      class="px-4 py-2 text-sm/none text-gray-600 underline "
    >
      메뉴
    </p>

    <button
      class="h-full p-2 text-gray-600 hover:text-gray-900"
      @click="onOffDropdown"
    >
      <span class="sr-only">Menu</span>
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-4 w-4"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          fill-rule="evenodd"
          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
          clip-rule="evenodd"
        />
      </svg>
    </button>
  </div>

  <div
    class="absolute z-10 mt-2 w-56 divide-y divide-gray-100 rounded-md border border-gray-100 bg-white shadow-lg"
    role="menu"
    v-if="dropdownClick == true"
  >
    <div class="p-2">
      <a
        href="#"
        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
        role="menuitem"
        @click="onOffWordAddModal"
      >
        단어 추가
      </a>

      <a
        href="#"
        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
        role="menuitem"
        @click="deleteWordTitle"
      >
        단어장 삭제
      </a>
      
      <a
        href="#"
        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
        role="menuitem"
        @click="shareWordTitle"
      >
        스토어에 공유
      </a>

      <a
        href="#"
        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
        role="menuitem"
        @click="exportCsv"
      >
        csv 내보내기
      </a>

    </div>

    
  </div>
</template>

<script setup>

import { ref, onMounted, watch } from 'vue';
import { useStore } from 'vuex';
import WordAddModalVue from '@/Components/WordAddModal.vue'
import { useRoute } from 'vue-router';

const store = useStore();
const route = useRoute();
const id = ref(route.params.id);


let dropdownClick = ref(false); 

// 버튼을 누르면 드롭다운 메뉴가 나타나고 사라지는 함수
const onOffDropdown = () => {
  dropdownClick.value = !dropdownClick.value;
}

// 단어 추가를 누르면 모달창이 나타나고 사라지는 함수
const onOffWordAddModal = () => {
  store.commit('toggleWordAddModal');
}

const deleteWordTitle = () => {
  axios.delete(`/delete-title/${id.value}`)
    .then(response => {
      console.log(response);
      alert('단어장이 삭제되었습니다.');
      location.href = '/word';
    })
    .catch(error => {
      console.log(error);
    });
}

// 스토어에 공유를 누르면 API 통신을 함
const shareWordTitle = () => {
  axios.post(`/word-titles/${id.value}/store`, {
    title_id: id.value
  })
  .then(function (response) {
    console.log(response);
    alert('스토어에 업로드가 되었습니다.');
  })
  .catch(function (error) {
    console.log(error);
  });
}

// csv 내보내기를 누르면 API 통신을 함
const exportCsv = () => {
  axios({
    url: `/export-wordtitle/${id.value}`,
    method: 'GET',
    responseType: 'blob', // 중요: 서버 응답을 blob으로 받음
  })
  .then((response) => {
    console.log(response)
    // Blob 데이터에서 다운로드 URL 생성
    const url = window.URL.createObjectURL(new Blob([response.data]));
    const link = document.createElement('a');
    link.href = url;

    // 'content-disposition' 헤더에서 파일 이름 추출
    const contentDisposition = response.headers['content-disposition'];
    let fileName = 'download.xlsx'; // 기본 파일 이름
    if (contentDisposition) {
      const fileNameMatch = contentDisposition.match(/filename="?(.*)"?(;|$)/);
      if (fileNameMatch.length > 1)
        fileName = fileNameMatch[1];
    }

    link.setAttribute('download', fileName);
    document.body.appendChild(link);
    link.click(); // 링크 클릭을 통해 다운로드
    document.body.removeChild(link); // 더 이상 필요 없으므로 링크 삭제
    window.URL.revokeObjectURL(url); // 생성된 URL 해제
  })
  .catch((error) => {
    console.error("Download error:", error);
    alert('파일을 다운로드하는 데 실패했습니다.');
  });
};


watch(() => route.params.id, (newId) => {
  if (newId) {
    id.value = newId;
    console.log(id.value)
  }
}, { immediate: true });

</script>

<style>

</style>