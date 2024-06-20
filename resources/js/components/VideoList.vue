<template>
  <div class="video-list">
    <ul class="list-group">
      <li
        v-for="(video, index) in videos"
        :key="video.id"
        :class="['list-group-item d-flex align-items-center overflow-auto shadow', { 'custom-first-item': index === 0 }]"
        @click="selectVideo(video)"
        style="cursor: pointer"
      >
        <img
          :src="video.thumbnails_default"
          alt="Video Thumbnail"
          class="img-thumbnail mr-3"
          style="max-width: 120px; max-height: 56px"
        />
        <span>{{ video.title }}</span>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "VideoList",
  props: {
    videos: {
      type: Array,
      required: true,
    },
  },
  methods: {
    selectVideo(video) {
      this.$emit("videoSelected", video);
    },
  },
};
</script>

<style scoped>
.video-list {
  width: 100%;
  height: 82vh;
  overflow-y: auto;
}

.img-thumbnail {
  margin-right: 10px;
}

.list-group-item {
  border-radius: 10px; /* Ajusta el valor para el redondeo deseado */
}

.custom-first-item {
  background-color: #d0e7ff; /* Azul claro */
  border: 2px solid #007bff; /* Borde azul oscuro */
  font-weight: bold; /* Ejemplo de texto en negrita */
   border-radius: 10px; /* Ajusta el valor para el redondeo deseado */
}
</style>
