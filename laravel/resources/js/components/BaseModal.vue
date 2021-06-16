<template>
  <div
    :id="id"
    ref="root"
    class="modal fade"
    tabindex="-1"
    role="dialog"
    :aria-labelledby="`${id}Label`"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header"><slot name="header" /></div>

        <div class="modal-body"><slot name="body" /></div>

        <div class="modal-footer"><slot name="footer" /></div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, onUnmounted } from "vue";
import $ from "jquery";

export default {
  name: "BaseModal",
  props: {
    id: {
      default: "",
      require: true,
      type: String,
    },
  },
  emits: ["show", "shown", "hide", "hidden"],
  setup(props, { emit }) {
    const root = ref(null);

    onMounted(() => {
      $(root.value)
        .on("show.bs.modal", (e) => {
          //console.log("BaseModal emit show.bs.modal", e);
          emit("show", e);
        })
        .on("shown.bs.modal", (e) => {
          //console.log("BaseModal emit shown.bs.modal", e);
          emit("shown", e);
        })
        .on("hide.bs.modal", (e) => {
          //console.log("BaseModal emit hide.bs.modal", e);
          emit("hide", e);
        })
        .on("hiddenbsmodal", (e) => {
          //console.log("BaseModal emit hidden.bs.modal", e);
          emit("hidden", e);
        });
    });

    onUnmounted(() => {
      //console.log("BaseModal onUnmounted dispose");
      $(root.value).modal("dispose");
    });

    return { root };
  },
};
</script>
