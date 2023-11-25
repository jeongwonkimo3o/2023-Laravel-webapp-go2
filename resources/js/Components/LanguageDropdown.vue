<template>
  <div class="">
  <div
    class="relative inline-flex items-center overflow-hidden "
  >
    <p
      class="px-4 py-2 text-sm/none text-gray-600 underline "
    >
      언어 선택
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
      >
        영어
      </a>

      <a
        href="#"
        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
        role="menuitem"
      >
        일본어
      </a>

      <a
        href="#"
        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
        role="menuitem"
      >
        쭝꿕어
      </a>

      <a
        href="#"
        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
        role="menuitem"
      >
        기타 언어
      </a>
    </div>

    
  </div>
</div>
</template>

<script>
export default {
  name: "LanguageDropdown",

  data() {
    return {
      dropdownClick: false
    } 
  },

  methods: {
    onOffDropdown() {
      this.dropdownClick = !this.dropdownClick
    }
  }
}
</script>

<style>

</style>