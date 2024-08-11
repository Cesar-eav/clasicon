<template>
  <div class="mx-auto bg-white dark:bg-black">
    <div class="flex border-b border-gray-200 mb-4">
      <button
        :class="['w-full py-2 px-4 text-center text-gray-600 dark:text-black hover:bg-gray-100 focus:outline-none focus:bg-gray-100', activeTab === 'f29' ? 'bg-gray-100' : '']"
        @click="activeTab = 'f29'"
      >
        F-29
      </button>
      <button
        :class="['w-full py-2 px-4 text-center text-gray-600 dark:text-black hover:bg-gray-100 focus:outline-none focus:bg-gray-100', activeTab === 'importacion' ? 'bg-gray-100' : '']"
        @click="activeTab = 'importacion'"
      >
        Importación
      </button>
      <button
        :class="['w-full py-2 px-4 text-center text-gray-600 dark:text-black hover:bg-gray-100 focus:outline-none focus:bg-gray-100', activeTab === 'honorario' ? 'bg-gray-100' : '']"
        @click="activeTab = 'honorario'"
      >
        Honorarios
      </button>
      <button
        :class="['w-full py-2 px-4 text-center text-gray-600 dark:text-black hover:bg-gray-100 focus:outline-none focus:bg-gray-100', activeTab === 'remuneracion' ? 'bg-gray-100' : '']"
        @click="activeTab = 'remuneracion'"
      >
        Remuneración
      </button>
    </div>
    <div v-if="activeTab === 'f29'" class="p-1">
      <slot name="f29"></slot>
    </div>
    <div v-if="activeTab === 'importacion'" class="p-0">
      <slot name="importacion"></slot>
    </div>
    <div v-if="activeTab === 'honorario'" class="p-0">
      <slot name="honorario"></slot>
    </div>
    <div v-if="activeTab === 'remuneracion'" class="p-0">
      <slot name="remuneracion"></slot>
    </div>
  </div>
</template>
  
  <script setup>
  import { ref } from 'vue'
  
  const activeTab = ref('f29')
  </script>
  
  