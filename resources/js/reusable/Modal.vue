<template>
  <div v-if="isOpen" class="modal-overlay">
    <div class="modal-container">
      <div style="display:flex; justify-content:center; text-align:center">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isOpen: false
    };
  },
  props: {
    title: {
      type: String,
      required: true
    }
  },
  methods: {
    openModal() {
      this.isOpen = true;
    },
    closeModal() {
      this.isOpen = false;
    }
  }
};
</script>

<style>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1050; /* Asegura que el modal esté sobre otros elementos */
}

.modal-container {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: white;
  border-radius: 8px;
  padding: 20px;
  width: 60%;
  height: 20%;
}
</style>
