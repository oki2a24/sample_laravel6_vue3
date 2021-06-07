<template>
  <div class="container">
    <h1>SampleVueFlatpickr</h1>
    <basee-vue-flatpickr v-model="date1" />
    <basee-vue-flatpickr v-model="date2" />
  </div>
</template>

<script>
import BaseeVueFlatpickr from "../components/BaseVueFlatpickr.vue";
import { ref } from "vue";

export default {
  name: "SampleVueFlatpickr",
  components: { BaseeVueFlatpickr },
  setup() {
    return {
      date1: ref(""),
      date2: ref(""),
    };
  },
};
</script>
