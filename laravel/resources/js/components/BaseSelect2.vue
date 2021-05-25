<template>
  <select ref="root">
    <slot></slot>
  </select>
</template>

<script>
import "select2";
import $ from "jquery";
import { ref, onMounted, onUnmounted, watch } from "vue";

export default {
  name: "BaseSelect2",
  props: {
    options: {
      type: Array,
      default: () => {
        [];
      },
    },
    modelValue: {
      type: String,
      default: null,
    },
  },
  emits: ["update:modelValue"],
  setup(props, { emit }) {
    const root = ref(null);

    watch(
      () => props.modelValue,
      (modelValue) => {
        // update modelValue
        $(root.value).val(modelValue).trigger("change");
      }
    );
    watch(
      () => props.options,
      (options) => {
        // update options
        $(root.value).empty().select2({ data: options });
      }
    );

    onMounted(() => {
      $(root.value)
        // init select2
        .select2({ data: props.options })
        .val(props.modelValue)
        .trigger("change")
        // emit event on change.
        .on("change", (event) => {
          emit("update:modelValue", event.target.value);
        });
    });

    onUnmounted(() => {
      $(root.value).off().select2("destroy");
    });

    return { root };
  },
};
</script>
