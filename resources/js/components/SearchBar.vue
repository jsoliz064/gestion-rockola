<template>
    <div class="container" style="position: relative">
        <div
            class="row height d-flex justify-content-center align-items-center"
        >
            <div class="col-md-8">
                <div class="search">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Ingrese el nombre de la canción o artista"
                        v-model="query"
                        @input="filterOptions"
                        ref="searchInput"
                    />
                    <ul
                        v-if="query"
                        class="options-list"
                        :style="{
                            width: inputWidth + 'px',
                            top: inputHeight + 'px',
                        }"
                    >
                        <li
                            v-for="option in filteredOptions"
                            :key="option.videoId"
                            @click="showAlert(option)"
                        >
                            <img
                                :src="option.thumbnails_default"
                                alt="Video Thumbnail"
                                class="img-thumbnail mr-3"
                            />
                            {{ option.title }}
                        </li>
                        <div class="search-more">
                            <li
                                style="width: 100%; text-align: center"
                                @click="searchMore"
                            >
                                <label style="color: white">
                                    Buscar más resultados de:
                                    <b style="font-size: 1rem">{{ query }}</b>
                                </label>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
            <Modal title="Agregando cancion" ref="modal">
                <div
                    style="
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                    "
                >
                    <div class="spinner-border" role="status"></div>
                    <span style="font-weight: bold; color: black"
                        >Espere un momento por favor...</span
                    >
                </div>
            </Modal>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";
import Service from "../helpers/services";
import Modal from "../reusable/Modal.vue";
export default {
    components: {
        Modal,
    },
    props: {
        options: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            query: "",
            filteredOptions: [],
            inputWidth: 0,
            inputHeight: 0,
        };
    },
    mounted() {
        this.updateInputDimensions();
        window.addEventListener("resize", this.updateInputDimensions);
    },
    beforeDestroy() {
        window.removeEventListener("resize", this.updateInputDimensions);
    },
    methods: {
        updateInputDimensions() {
            const input = this.$refs.searchInput;
            this.inputWidth = input.offsetWidth;
            this.inputHeight = input.offsetHeight;
        },
        filterOptions() {
            if (this.query) {
                const normalizeString = (str) =>
                    str
                        .toLowerCase()
                        .normalize("NFD")
                        .replace(/[\u0300-\u036f]/g, "")
                        .replace(/[^\w\s]/gi, ""); // Normaliza y elimina diacríticos y caracteres especiales

                const normalizedQuery = normalizeString(this.query);

                const queryWords = normalizedQuery.split(/\s+/); // Divide la consulta en palabras

                this.filteredOptions = this.options.filter((option) => {
                    const normalizedTitle = normalizeString(option.title);
                    // Verifica si todas las palabras de la consulta están contenidas en el conjunto de palabras del título
                    return queryWords.every((word) =>
                        normalizedTitle.includes(word)
                    );
                });
            } else {
                this.filteredOptions = [];
            }
        },
        selectOption(option) {
            this.query = option.title;
            this.filteredOptions = [];
        },
       showAlert(option) {
    Swal.fire({
        title: "¿Estás seguro de agregar esta canción?",
        html: `
            <div>
                <img src="${option.thumbnails_medium}" alt="Thumbnail" class="custom-thumbnail">
                <p class="custom-name">${option.title}</p>
            </div>
        `,
        footer: '<b>Por cada canción agregada se cobrará 1bs y se acumulará a la cuenta de tu mesa</b>',
        showCancelButton: true,
        cancelButtonText: "No",
        confirmButtonText: "Sí",
        confirmButtonColor: "#008000",
        cancelButtonColor: "#d33",
        customClass: {
            title: "custom-title",
        },
    }).then((result) => {
        if (result.isConfirmed) {
            this.confirmAction(option);
        } else {
            this.cancelAction();
        }
    });
}
,
        async confirmAction(option) {
            //console.log("Id:", option.videoId);
            try {
                await Service.addVideo(option.videoId);
                this.query = "";
                this.$emit("addVideo");
            } catch (error) {
                this.showToast();
            }
        },
        async searchMore() {
            this.openModal();
            try {
                const newVideos = await Service.searchVideos(this.query);
                this.options.push(...newVideos);
                this.filteredOptions = newVideos;
            } catch (error) {
                this.showToast();
            } finally {
                this.closeModal();
            }
        },
        openModal() {
            this.$refs.modal.openModal();
        },
        closeModal() {
            this.$refs.modal.closeModal();
        },
        showToast() {
            this.$toast.error("Error al solicitar el servicio", {
                position: "top-right",
                timeout: 5000,
            });
        },
    },
};
</script>

<style scoped>
@import url("/css/custom.css");

body {
    background-color: #eee;
    font-family: "Poppins", sans-serif;
    font-weight: 300;
}

.search {
    display: flex;
    box-shadow: 0 0 40px rgba(51, 51, 51, 0.1);
    position: relative;
}

.search input {
    height: 10vh;
    border: 2px solid #d6d4d4;
    flex: 1;
}

.search input:focus {
    box-shadow: none;
    border: 2px solid blue;
}

.search .fa-search {
    position: absolute;
    top: 20px;
    left: 16px;
}

.search button {
    background: blue;
}

.options-list {
    position: absolute;
    z-index: 1000;
    list-style-type: none;
    padding: 0;
    margin: 0;
    /* Removemos el margen superior */
    background: white;
    box-shadow: 0 0 40px rgba(51, 51, 51, 0.1);
    border: 2px solid #d6d4d4;
    overflow-y: auto;
    border-radius: 10px;
    max-height: 70vh;
}

.options-list li {
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #d6d4d4;
}

.options-list li.no-border {
    border-bottom: none;
}

.img-thumbnail {
    margin-right: 10px;
    max-width: 100px;
    max-height: 56px;
}

.search-more {
    display: flex;
    justify-content: center;
    background-color: #676767;
}
</style>
