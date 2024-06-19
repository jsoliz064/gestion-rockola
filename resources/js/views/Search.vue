<template>
    <div class="container">
        <div>
            <search-bar :options="videoOptions"></search-bar>
            <hr />
            <div
                class="row height d-flex justify-content-center align-items-center"
            >
                <video-list :videos="videos"></video-list>
            </div>
        </div>
    </div>
</template>

<script>
import SearchBar from "../components/SearchBar.vue";
import VideoList from "../components/VideoList.vue";
import Service from "../helpers/services";

export default {
    components: {
        SearchBar,
        VideoList,
    },
    props: {
        token: {
            type: String,
            required: true,
        },
    },
    async mounted() {
        console.log(this.token);
        const videos = await Service.getAllVideos(this.token);
        console.log(videos);
        this.videoOptions = videos;
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
            videoOptions:[
            ]
        };
    },
};
</script>

<style scoped></style>
