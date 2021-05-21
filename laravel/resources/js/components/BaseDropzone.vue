<template>
  <div id="myDropzoneId" class="dropzone"></div>
</template>

<script>
import { onMounted } from "vue";
import Dropzone from "dropzone";
export default {
  name: "BaseDropzone",
  props: {
    url: {
      type: String,
      require: true,
      default: "",
    },
  },
  emits: ["onSuccess"],
  setup(props, { emit }) {
    const initDropzone = () => {
      Dropzone.autoDiscover = false;
      //new Dropzone("div#myId", { url: "https://httpbin.org/post" });
      const myDropzone = new Dropzone("div#myDropzoneId", { url: props.url });
      myDropzone.on("success", (file, response) => {
        emit("onSuccess", file, response);
      });
    };

    onMounted(() => {
      initDropzone();
    });
  },
};
</script>

<!--
ここでスタイルを読み込むことも可能
<style src="../../../node_modules/dropzone/dist/dropzone.css"></style>
-->
