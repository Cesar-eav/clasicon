<template>
    <div v-if="links.length > 3">
      <div class="flex flex-wrap -mb-1">
        <template v-for="(link, key) in links">
          <div v-if="link.url === null" :key="key" class="mb-1 mr-1 px-4 py-3 text-black dark:text-white text-sm leading-4" v-html="textLabel(link.label)" />
          <Link v-else :key="`link-${key}`" class="mb-1 px-2 py-3 focus:text-indigo-500 text-sm text-black leading-4 hover:bg-white dark:text-white" :class="{ 'bg-transparent text-black dark:text-white': link.active }" :href="link.url" v-html="textLabel(link.label)" />
        </template>
      </div>
    </div>
  </template>
  
  <script>
import { Link } from '@inertiajs/vue3'
  
  export default {
    components: {
      Link,
    },
    props: {
      links: Array,
    },
    methods:{
      textLabel(label){
        let textFormatted;
        switch (label) {
          case 'pagination.next':
            textFormatted = 'Next';
            break;
          case 'pagination.previous':
            textFormatted = 'Previous';
            break;
          default:
            textFormatted = label;
            break;
        }
        return textFormatted;
      }
    }
  }
  </script>