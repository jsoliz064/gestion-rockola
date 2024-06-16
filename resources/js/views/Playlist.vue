<template>
  <div class="container">
    <div class="row" v-if="isLoaded">
      <div class="col-md-8">
        <Video :currentVideo="currentVideo" @nextVideo="setNextVideo" />
      </div>
      <div class="col-md-4" style="height:100%">
        <VideoList :videos="videos" @videoSelected="changeVideo" />
      </div>
    </div>
  </div>
</template>

<script>
import Video from "../components/Video.vue";
import VideoList from "../components/VideoList.vue";
import Service from "../helpers/services";

export default {
  name: "Playlist",
  components: {
    Video,
    VideoList,
  },
  computed: {
    currentVideo() {
      return this.videos[this.currentVideoIndex];
    }
  },
  data() {
    return {
      currentVideoIndex: 0,
      videos: [],
      isLoaded: false
    };
  },
  methods: {
    changeVideo(video) {
      const index = this.videos.findIndex(v => v.id === video.id);
      if (index !== -1) {
        this.currentVideoIndex = index;
      }
    },
    setNextVideo() {
      if (this.currentVideoIndex < this.videos.length - 1) {
        this.currentVideoIndex += 1;
      } else {
        this.currentVideoIndex = 0;
      }
    }
  },

  async mounted() {
    try {
      this.videos = await Service.getAllVideos();
      this.isLoaded = true;
      console.log(this.videos)
    } catch (error) {
    }
  }
};
</script>

<style scoped>
.container {
  padding: 20px;
  height: 100vh;
  width: 100vw;
}

.row {
  height: 100%;
}
</style>
