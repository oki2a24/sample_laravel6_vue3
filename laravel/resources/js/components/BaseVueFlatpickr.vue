<template>
  <flat-pickr
    :config="config"
    :model-value="modelValue"
    @update:modelValue="updateModelValue"
  ></flat-pickr>
</template>

<script>
import { Japanese } from "flatpickr/dist/l10n/ja.js";
import flatPickr from "vue-flatpickr-component";

export default {
  name: "BaseVueFlatpickr",
  components: { flatPickr },
  props: {
    modelValue: {
      default: null,
      required: true,
      validator(value) {
        return (
          value === null ||
          value instanceof Date ||
          typeof value === "string" ||
          value instanceof String ||
          value instanceof Array ||
          typeof value === "number"
        );
      },
    },
  },
  emits: ["update:modelValue"],
  setup(props, { emit }) {
    Japanese.firstDayOfWeek = 1;
    const config = {
      locale: Japanese,
    };

    const updateModelValue = (modelValue) => {
      emit("update:modelValue", modelValue);
    };

    return { config, updateModelValue };
  },
};
</script>
