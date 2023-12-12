<template>
<HeaderVue />
<div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 ">
    <header class="flex justify-between items-end">
      <h2 class="text-xl font-medium text-gray-900 sm:text-2xl">
        퀴즈를 풀며 실력을 테스트할 수 있습니다.
      </h2> 
    </header>
    <QuizCardVue />
</div>
<FooterVue />
</template>

<script>
import HeaderVue from '../Components/Header.vue';
import FooterVue from '@/Components/Footer.vue'
import QuizCardVue from '@/Components/QuizCard.vue';


export default {

    components: {
        HeaderVue,
        FooterVue,
        QuizCardVue
    }

}
</script>

<style>

</style>