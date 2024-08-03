<template>
  <footer class="bg-menu">
    <div class="max-w-7xl mx-auto">
      <div class="min-h-44 px-4 flex flex-col md:gap-x-4 sm:flex-row sm:justify-between items-center md:items-start">
        <div class="flex flex-col items-center py-4 space-y-3 w-full md:w-1/3 lg:w-1/5">
          <div class="flex items-center flex-col">
            <div class="text-xl font-black text-orange-500 tracking-widest">
              TBV-TripleB
            </div>
            <div class="text-xs text-gray-400">We love a game of billiards</div>
          </div>
          <div class="flex flex-col items-center space-y-2">
            <ApplicationLogo />
            <div>
              <IconsSocial />
            </div>
          </div>
        </div>

        <FooterPost />

        <div class="md:w-1/3 lg:w-1/5 md:min-h-44 md:flex pb-8 md:pb-0">
          <ContactUs />
        </div>
      </div>

    </div>

    <div class="flex justify-center items-center text-sm text-gray-300 h-16 border-t border-orange-500/30 ">
      TBV-TripleB (c) 2024 All rights reserved
    </div>
  </footer>
</template>
<script lang="ts" setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import IconsSocial from "@/Components/IconsSocial.vue";
import ContactUs from "@/Components/ContactUs.vue";
import FooterPost from "@/Components/FooterPost.vue";
</script>