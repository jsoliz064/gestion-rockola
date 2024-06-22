<template>
  <div class="video-list">
    <ul class="list-group">
      <li
        v-for="(video, index) in videos"
        :key="video.id"
         :class="[
          'list-group-item d-flex align-items-center shadow',
          { 'custom-first-item': video.reproducido === 1 }
        ]"
        @click="selectVideo(video)"
        style="cursor: pointer"
      >
        <span class="video-index">{{ index + 1 }}</span>
        <img
          :src="video.thumbnails_default"
          alt="Video Thumbnail"
          class="img-thumbnail mr-3"
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
  max-height: 70vh;
  overflow-y: auto;
}

.video-index {
  margin-right: 10px;
  font-weight: bold;
}

.img-thumbnail {
  margin-right: 10px;
  max-width: 120px;
  max-height: 56px;
}

.list-group-item {
  border-radius: 10px;
}

.custom-first-item {
  background-color: #d0e7ff;
  border: 2px solid #007bff;
  font-weight: bold;
}
</style>
