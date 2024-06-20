<template>
    <div class="container">
        <div>
            <div class="row mt-4">
                <div class="col d-flex align-items-center justify-content-center">
                    <h4>Busca la cancion que desees</h4>
                </div>
            </div>
            <search-bar :options="videoOptions" @addVideo="loadPlaylist"></search-bar>
            <hr />
            <h5>Lista de reproduccion actual:</h5>
            <div class="row height d-flex justify-content-center align-items-center">
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
    methods: {
        async loadAllVideos() {
            const videos = await Service.getAllVideos();
            console.log(videos);
            this.videoOptions = videos;
        },

        async loadPlaylist() {
            this.videos = await Service.getSalaPlaylist();
        },
    },
    async mounted() {
        console.log(this.token);
        localStorage.setItem("token", this.token);
        this.loadAllVideos();
        this.loadPlaylist();
    },
    data() {
        return {
            currentVideoIndex: 0,
            videos: [],
            videoOptions: [],
        };
    },
};
</script>

<style scoped></style>
