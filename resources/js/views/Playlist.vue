<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <Video :currentVideo="currentVideo" @nextVideo="setNextVideo"/>
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
      videos: [
        {
          id: 1,
          title: "Video 1",
          url: "https://www.youtube.com/embed/dQw4w9WgXcQ",
        },
        {
          id: 2,
          title: "Video 2",
          url: "https://www.youtube.com/embed/tgbNymZ7vqY",
        },
        {
          id: 3,
          title: "Video 3",
          url: "https://www.youtube.com/embed/sBws8MSXN7A",
        },
        {
          id: 4,
          title: "Video 4",
          url: "https://www.youtube.com/embed/e-ORhEE9VVg",
        },
        {
          id: 5,
          title: "Video 5",
          url: "https://www.youtube.com/embed/3JZ_D3ELwOQ",
        },
        {
          id: 6,
          title: "Video 6",
          url: "https://www.youtube.com/embed/2Vv-BfVoq4g",
        },
        {
          id: 7,
          title: "Video 7",
          url: "https://www.youtube.com/embed/60ItHLz5WEA",
        },
        {
          id: 8,
          title: "Video 8",
          url: "https://www.youtube.com/embed/9bZkp7q19f0",
        },
        {
          id: 9,
          title: "Video 9",
          url: "https://www.youtube.com/embed/6Dh-RL__uN4",
        },
        {
          id: 10,
          title: "Video 10",
          url: "https://www.youtube.com/embed/8jPQjjsBbIc",
        },
        {
          id: 11,
          title: "Video 11",
          url: "https://www.youtube.com/embed/LsoLEjrDogU",
        },
        {
          id: 12,
          title: "Video 12",
          url: "https://www.youtube.com/embed/OPf0YbXqDm0",
        },
        {
          id: 13,
          title: "Video 13",
          url: "https://www.youtube.com/embed/SlPhMPnQ58k",
        },
        {
          id: 14,
          title: "Video 14",
          url: "https://www.youtube.com/embed/kJQP7kiw5Fk",
        },
        {
          id: 15,
          title: "Video 15",
          url: "https://www.youtube.com/embed/CevxZvSJLk8",
        },
      ],
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
};
</script>

<style scoped>
.container {
  padding: 20px;
  height:100vh;
  width: 100vw;
}
.row{
  height: 100%;
}
</style>
