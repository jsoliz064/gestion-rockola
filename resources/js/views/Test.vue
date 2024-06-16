<template>
    <div>
      <h1>Navegador Incrustado</h1>
      <Browser :url="navegadorUrl" />
    </div>
  </template>
  
  <script>
  import Browser from '../components/Browser.vue'
  
  export default {
    name: 'App',
    components: {
      Browser
    },
    data() {
      return {
        navegadorUrl: 'https://www.youtube.com/watch?v=zypNKLVRKmc' // Cambia esto a la URL que desees
      }
    }
  }
  </script>
  