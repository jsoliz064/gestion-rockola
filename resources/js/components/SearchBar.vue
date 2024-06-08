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
          <ul v-if="query && filteredOptions.length" class="options-list">
            <li
              v-for="option in filteredOptions"
              :key="option"
              @click="selectOption(option)"
            >
              {{ option }}
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      query: "",
      options: [
        "Song 1",
        "Song 2",
        "Song 3",
        "Another Song",
        "Yet Another Song",
      ],
      filteredOptions: [],
    };
  },
  methods: {
    filterOptions() {
      if (this.query) {
        this.filteredOptions = this.options.filter((option) =>
          option.toLowerCase().includes(this.query.toLowerCase())
        );
      } else {
        this.filteredOptions = [];
      }
    },
    selectOption(option) {
      this.query = option;
      this.filteredOptions = [];
    },
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
</style>
