<template>
  <h1>vue2-dropzone sample</h1>
  <p>
    <a href="https://github.com/rowanwins/vue-dropzone" target="_blank"
      >rowanwins/vue-dropzone: A Vue.js component for Dropzone.js - a
      drag’n’drop file uploads utility with image previews</a
    >
    は Vue.js 3 では動かない。
  </p>
  <vue-dropzone
    id="dropzone"
    ref="myVueDropzone"
    :options="dropzoneOptions"
  ></vue-dropzone>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import { reactive } from "vue";
export default {
  name: "Vue2Dropzone",
  components: {
    vueDropzone: vue2Dropzone,
  },
  setup() {
    const dropzoneOptions = reactive({
      url: "https://httpbin.org/post",
      thumbnailWidth: 150,
      maxFilesize: 0.5,
      headers: { "My-Awesome-Header": "header value" },
    });

    return {
      dropzoneOptions,
    };
  },
};
</script>
