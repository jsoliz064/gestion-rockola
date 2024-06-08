<template>
  <div class="video-list">
      <ul class="list-group" >
        <li
          v-for="video in videos"
          :key="video.id"
          class="list-group-item d-flex align-items-center overflow-auto shadow"
          @click="selectVideo(video)"
          style="cursor: pointer"
        >
          <img
            :src="getThumbnail(video.url)"
            alt="Video Thumbnail"
            class="img-thumbnail mr-3"
            style="width: 100px; height: 56px"
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
    selectVideo(url) {
      this.$emit("videoSelected", url);
    },
    getThumbnail(url) {
      const videoId = url.split("embed/")[1];
      return `https://img.youtube.com/vi/${videoId}/default.jpg`;
    },
  },
};
</script>

<style scoped>
.video-list {
  width: 100%;
  height: 100%;
  overflow-y: auto;
}
.img-thumbnail {
  margin-right: 10px;
}
</style>
