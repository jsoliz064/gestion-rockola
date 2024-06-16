<template>
  <div class="card p-2" style="height: 100%">
    <div v-if="error" class="alert alert-danger">{{ error }}</div>
    <div v-else>
      <video v-if="videoUrl" :src="videoUrl" controls autoplay style="width: 100%; height: 90%;"></video>
      <div class="d-flex justify-content-between align-items-center m-2">
        <h3 class="card-title m-0">{{ currentVideo.title }}</h3>
        <button @click="nextVideo()" class="btn btn-success">Siguiente</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Video",
  props: {
    currentVideo: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      error: null,
      videoUrl: null,
      apiKey: "AIzaSyBVjXikfKUWQKQeXDklOmAaM4IiXLyk7Bo"
    };
  },
  methods: {
    nextVideo() {
      console.log('Emit nextVideo event');
      this.$emit("nextVideo");
    },

    async loadVideoUrl() {
      this.error = null;
      this.videoUrl = null;
      try {
        const response = await fetch(`https://www.googleapis.com/youtube/v3/videos?id=${this.currentVideo.videoId}&key=${this.apiKey}&part=player`);
        const data = await response.json();
        if (data.items && data.items.length > 0) {
          const embedHtml = data.items[0].player.embedHtml;
          const videoUrlMatch = embedHtml.match(/src="([^"]+)"/);
          if (videoUrlMatch && videoUrlMatch[1]) {
            this.videoUrl = videoUrlMatch[1];
            console.log("gaaa");
          } else {
            this.error = "Failed to extract video URL.";
          }
        } else {
          this.error = "Video not found.";
        }
        console.log(this.error);
      } catch (error) {
        this.error = "Error loading video URL.";
        console.error(error);
      }
    },
  },
  watch: {
    currentVideo: {
      handler() {
        this.loadVideoUrl();
      },
      deep: true,
    }
  },
  mounted() {
    this.loadVideoUrl();
  }
};
</script>

<style scoped></style>
