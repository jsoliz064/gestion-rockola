<template>
    <div class="browser-wrapper">
      <iframe :src="url" class="browser-frame"></iframe>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Browser',
    props: {
      url: {
        type: String,
        required: true
      }
    }
  }
  </script>
  
  <style scoped>
  .browser-wrapper {
    width: 100%;
    height: 100vh;
    overflow: hidden;
  }
  
  .browser-frame {
    width: 100%;
    height: 100%;
    border: none;
  }
  </style>
  