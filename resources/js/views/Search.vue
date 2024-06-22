<template>
    <div class="container">
        <div>
            <div class="row mt-4">
                <div
                    class="col d-flex align-items-center justify-content-center"
                >
                    <h4>Busca la canción que desees</h4>
                </div>
            </div>
            <search-bar
                :options="videoOptions"
                @addVideo="loadPlaylist"
            ></search-bar>
            <hr />
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Lista de reproducción actual:</h5>
                <button class="btn btn-sm btn-success" @click="loadPlaylist">
                    Actualizar lista
                </button>
            </div>
            <div
                class="row height d-flex justify-content-center align-items-center; height:500px"
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
    data() {
        return {
            currentVideoIndex: 0,
            videos: [],
            videoOptions: [],
        };
    },
    methods: {
        async loadAllVideos() {
            try {
                const videos = await Service.getAllVideos();
                //console.log(videos);
                this.videoOptions = videos;
            } catch (error) {
                this.showToast();
            }
        },

        async loadPlaylist() {
            try {
                this.videos = await Service.getSalaPlaylist();
            } catch (error) {
                this.showToast();
            }
        },
        async updatePlaylist() {
            try {
                await this.loadPlaylist();
            } catch (error) {
                this.showToast();
            }
        },
        showToast() {
            this.$toast.error("Error al solicitar el servicio", {
                position: "top-right",
                timeout: 5000,
            });
        },
    },
    async mounted() {
        //console.log(this.token);
        localStorage.setItem("token", this.token);
        try {
            await this.loadAllVideos();
            await this.loadPlaylist();
        } catch (error) {
            this.showToast();
        }
    },
};
</script>

<style scoped></style>
