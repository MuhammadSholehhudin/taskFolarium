import './bootstrap';
import Vue from 'vue';


new Vue({
  el: '#app',
  data() {
    return {
      showModal: false,
      formData: {
        name: '',
        email: '',
      },
    };
  },
  methods: {
    openModal() {
      // Mengatur showModal menjadi true saat tombol "Tambah" ditekan
      this.showModal = true;
    },
    closeModal() {
      // Mengatur showModal menjadi false saat tombol "Batal" ditekan
      this.showModal = false;
    },
    saveData() {
      // Menyimpan data saat tombol "Simpan" ditekan
      // Lakukan logika penyimpanan data atau panggil API di sini
      console.log(this.formData);
      this.closeModal();
    },
  },
});
