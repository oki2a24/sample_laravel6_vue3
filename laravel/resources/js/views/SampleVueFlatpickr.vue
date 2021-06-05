<template>
  <div class="container">
  <h1>SampleVueFlatpickr</h1>
  <flat-pickr v-model="date"></flat-pickr>
  </div>
</template>

<script>
import { ref } from "vue";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";

export default {
  name: "SampleVueFlatpickr",
  components: { flatPickr },
  setup() {
    const date = ref("");
    return { date };
  },
};
</script>
