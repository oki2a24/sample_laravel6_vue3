<template>
  <input ref="root" type="text" @input="updateModelValue" />
</template>

<script>
import { ref, onMounted, onUnmounted } from "vue";
import flatpickr from "flatpickr";
import { Japanese } from "flatpickr/dist/l10n/ja.js";

export default {
  name: "BaseFlatpickr",
  props: {
    config: {
      default: () => {},
      required: false,
      type: Object,
    },
    modelValue: {
      default: null,
      required: true,
      type: String,
    },
  },
  emits: ["update:modelValue"],
  setup(props, { emit }) {
    const root = ref(null);

    const updateModelValue = (event) => {
      emit("update:modelValue", event.target.value);
    };

    onMounted(() => {
      Japanese.firstDayOfWeek = 1;
      const config = {
        locale: Japanese,
        ...props.config,
      };
      flatpickr(root.value, config);
    });

    onUnmounted(() => {
      flatpickr.destroy();
    });

    return { root, updateModelValue };
  },
};
</script>
