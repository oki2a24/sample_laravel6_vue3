<template>
  <div :class="classValue">
    <select ref="root">
      <slot />
    </select>
  </div>
</template>

<script>
import _ from "lodash";
import "select2";
import { ref, onMounted, onUnmounted, watch } from "vue";
import $ from "jquery";

export default {
  name: "BaseSelect2",
  props: {
    classValue: {
      type: String,
      require: false,
      default: null,
    },
    config: {
      type: Object,
      require: false,
      default: () => {},
    },
    options: {
      type: Array,
      require: true,
      default: () => {
        [];
      },
    },
    modelValue: {
      type: String,
      require: false,
      default: null,
    },
  },
  emits: ["update:modelValue"],
  setup(props, { emit }) {
    const root = ref(null);

    const config = {
      data: props.options,
      theme: "bootstrap",
      ...props.config,
    };

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
        $(root.value)
          .empty()
          .select2({ ...config, data: options });
      }
    );
    watch(
      () => _.cloneDeep(props),
      (props, prevProps) => {
        console.log("watch props", props, prevProps);
        //$(root.value)
        //  .empty()
        //  .select2({ ...config, data: props.options, ...props.config })
        //  .val(props.modelValue)
        //  .trigger("change");
      },
      { deep: true }
    );

    onMounted(() => {
      $(root.value)
        // init select2
        .select2(config)
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
