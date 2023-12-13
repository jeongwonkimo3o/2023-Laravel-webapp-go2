<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';
import { Inertia } from '@inertiajs/inertia';

// 이동하려는 경로 및 데이터
const pageUrl = '/word'; // 이동하려는 페이지의 URL

// 1.5초 후에 페이지 이동
setTimeout(() => {
  Inertia.visit(pageUrl);
}, 1500);

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center   selection:bg-red-500 selection:text-white">
      

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <img src="../../../public/icons/go2-logo-big.png" class="w-24" alt="go2-logo">

            </div>

            <div class="flex justify-center mt-5 px-6 sm:items-center sm:justify-between">
                <div class="text-center text-xl text-gray-800 dark:text-gray-400 sm:text-start">
                </div>

                
            </div>
        </div>
    </div>
</template>

<style>


</style>
