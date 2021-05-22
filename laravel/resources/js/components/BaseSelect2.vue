<template>
  <select>
    <slot></slot>
  </select>
</template>

<script>
import "select2";
import $ from "jquery";

export default {
  name: "BaseSelect2",
  props: ["options", "modelValue"],
  watch: {
    modelValue: function (modelValue) {
      // update modelValue
      console.log("watch modelValue", modelValue);
      $(this.$el).val(modelValue).trigger("change");
    },
    options: function (options) {
      // update options
      $(this.$el).empty().select2({ data: options });
    },
  },
  mounted: function () {
    var vm = this;
    $(this.$el)
      // init select2
      .select2({ data: this.options })
      .val(this.modelValue)
      .trigger("change")
      // emit event on change.
      .on("change", function () {
        console.log("mounted on change", this.value);
        vm.$emit("update:modelValue", this.value);
      });
  },
  unmounted: function () {
    $(this.$el).off().select2("destroy");
  },
};
</script>
