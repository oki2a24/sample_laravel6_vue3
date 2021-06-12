<template>
  <div class="container">
    <h1>SampleFlatpickr</h1>
    <base-flatpickr v-model="date1" />
    <base-flatpickr v-model="date2" />
  </div>
</template>

<script>
import BaseFlatpickr from "../components/BaseFlatpickr.vue";
import { ref } from "vue";

export default {
  name: "SampleFlatpickr",
  components: { BaseFlatpickr },
  setup() {
    return {
      date1: ref(""),
      date2: ref(""),
    };
  },
};
</script>
