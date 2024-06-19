<template>
  <div class="container" style="padding-top: 20px; position: relative">
    <div class="row height d-flex justify-content-center align-items-center">
      <div class="col-md-8">
        <div class="search">
          <i class="fa fa-search"></i>
          <input
            type="text"
            class="form-control"
            placeholder="Ingrese el nombre de alguna canción"
            v-model="query"
            @input="filterOptions"
          />
          <button class="btn btn-primary">Buscar</button>
          <ul v-if="query" class="options-list">
            <li
              v-for="option in filteredOptions"
              :key="option.title"
              @click="showAlert(option)"
            >
              <img
                :src="option.thumbnails_default"
                alt="Video Thumbnail"
                class="img-thumbnail mr-3"
                style="width: 100px; height: 56px"
              />
              {{ option.title }}
            </li>
            <li v-if="!filteredOptions.length" class="no-results">
              Buscar más
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from 'sweetalert2';
export default {
  props:{
     options: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      query: "",
      filteredOptions: [],
    };
  },
  methods: {
    filterOptions() {
      if (this.query) {
        this.filteredOptions = this.options.filter((option) =>
          option.title.toLowerCase().includes(this.query.toLowerCase())
        );
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
        title: '¿Estás seguro de agregar esta canción?',
        html: `
          <img src="${option.thumbnails_medium}" alt="Thumbnail" style="width: 90%; height: 85%;">
          <p>${option.title}</p>
        `,
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Sí',
      }).then((result) => {
        if (result.isConfirmed) {
          this.confirmAction(option);
        } else {
          this.cancelAction();
        }
      });
    },
    confirmAction(option) {
      // Acción a tomar cuando se confirma
      console.log('Id:', option.videoId);
    },
    cancelAction() {
      // Acción a tomar cuando se cancela
      console.log('Acción cancelada');
    }
  },
};
</script>

<style scoped>
body {
  background-color: #eee;
  font-family: "Poppins", sans-serif;
  font-weight: 300;
}

.search {
  position: relative;
  box-shadow: 0 0 40px rgba(51, 51, 51, 0.1);
}

.search input {
  height: 60px;
  text-indent: 25px;
  border: 2px solid #d6d4d4;
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
  position: absolute;
  top: 5px;
  right: 5px;
  height: 50px;
  width: 110px;
  background: blue;
}

.options-list {
  position: absolute;
  z-index: 1000;
  list-style-type: none;
  padding: 0;
  margin: 10px 0 0;
  background: white;
  box-shadow: 0 0 40px rgba(51, 51, 51, 0.1);
  border: 2px solid #d6d4d4;
  overflow-y: auto;
  width: 100%;
    border-radius: 10px;
}

.options-list li {
  padding: 10px;
  cursor: pointer;
  border-bottom: 1px solid #d6d4d4;
}

.options-list li.no-border {
  border-bottom: none;
}

.options-list li:hover {
  background: #f0f0f0;
}

.img-thumbnail {
  margin-right: 10px;
}
</style>
