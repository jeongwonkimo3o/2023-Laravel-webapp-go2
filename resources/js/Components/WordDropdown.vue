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
      >
        스토어에 공유
      </a>

      <a
        href="#"
        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
        role="menuitem"
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
function onOffDropdown() {
  dropdownClick.value = !dropdownClick.value;
}

// 단어 추가를 누르면 모달창이 나타나고 사라지는 함수
function onOffWordAddModal() {
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

watch(() => route.params.id, (newId) => {
  if (newId) {
    id.value = newId;
    console.log(id.value)
  }
}, { immediate: true });

</script>

<style>

</style>