<template>
  <div class="card p-2" style="height: 100%">
    <div id="player" style="width: 100%; height: 90%;"></div>
    <div class="d-flex justify-content-between align-items-center m-2">
      <h3 class="card-title m-0">{{ currentVideo.title }}</h3>
      <button @click="nextVideo()" class="btn btn-success">Siguiente</button>
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
  methods: {
    nextVideo() {
      console.log('Emit nextVideo event');
      this.$emit("nextVideo");
    },
    loadYouTubeAPI() {
      return new Promise((resolve) => {
        if (window.YT && window.YT.Player) {
          resolve();
        } else {
          const tag = document.createElement('script');
          tag.src = "https://www.youtube.com/iframe_api";
          const firstScriptTag = document.getElementsByTagName('script')[0];
          firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

          window.onYouTubeIframeAPIReady = () => {
            resolve();
          };
        }
      });
    },
    async createPlayer() {
      await this.loadYouTubeAPI();

      this.player = new YT.Player('player', {
        height: '100%',
        width: '100%',
        videoId: this.getVideoId(this.currentVideo.url),
        playerVars: {
          autoplay: 1,
        },
        events: {
          'onStateChange': this.onPlayerStateChange,
        }
      });
    },
    onPlayerStateChange(event) {
      if (event.data === YT.PlayerState.ENDED) {
        this.nextVideo();
      }
    },
    getVideoId(url) {
      const videoIdMatch = url.match(/(?:https?:\/\/)?(?:www\.)?youtu\.be\/([a-zA-Z0-9_-]+)|(?:https?:\/\/)?(?:www\.)?youtube\.com\/(?:embed\/|v\/|watch\?v=)([a-zA-Z0-9_-]+)/);
      return videoIdMatch ? videoIdMatch[1] || videoIdMatch[2] : null;
    }
  },
  watch: {
    currentVideo: {
      handler() {
        if (this.player) {
          this.player.loadVideoById(this.getVideoId(this.currentVideo.url));
        }
      },
      deep: true,
    }
  },
  mounted() {
    this.createPlayer();
  }
};
</script>

<style scoped></style>
