<template>
  <header>
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="md:flex md:items-center md:gap-12">
          <a class="block" href="/">
            <span class="sr-only">Home</span>
            <img src="../../../public/build/assets/icons/go2-logo.png" class="w-12" alt="go2-logo">
          </a>
        </div>
  
        <div class="hidden md:block">
          <nav aria-label="Global">
            <ul class="flex items-center gap-6 text-sm">
  
              <li>
                <a
                  class="text-black transition hover:text-gray-500/75"
                  href="/upload"
                >
                  Upload
                </a>
              </li>
  
              <li>
                <a
                  class="text-black transition hover:text-gray-500/75"
                  href="/word"
                >
                  Words
                </a>
              </li>
  
              <li>
                <a
                  class="text-black transition hover:text-gray-500/75"
                  href="/store"
                >
                  Store
                </a>
              </li>
              
            </ul>
          </nav>
        </div>
  
        <div class="flex items-center gap-4">
          <div class="sm:flex sm:gap-4">
            <a href="/user/profile">
            <img src="../../../public/build/assets/icons/user.png" class="cursor-pointer w-7" alt="logout">
            </a>
          </div>
          <div class="sm:flex sm:gap-4">
            <Link href="/logout" method="post" as="button" type="button">
            <img src="../../../public/build/assets/icons/logout.png" class="cursor-pointer w-7" alt="logout">
            </Link>
          </div>
  
          
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'


</script>

<style>

</style>