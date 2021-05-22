<template>
  <div class="container">
    <h1>Select2 ラッパー SFC の利用</h1>
    <p>Selected: {{ selected }}</p>
    <base-select-2 v-model="selected" :options="options">
      <option disabled value="0">Select one</option>
    </base-select-2>
  </div>
</template>

<script>
import { ref } from "vue";
import BaseSelect2 from "../components/BaseSelect2.vue";

export default {
  name: "SampleSelect2",
  components: { BaseSelect2 },
  setup() {
    const selected = ref(2);
    const options = [
      { id: 1, text: "Hello" },
      { id: 2, text: "World" },
    ];

    return {
      options,
      selected,
    };
  },
};
</script>
