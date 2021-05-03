<template>
  <h1>vue3-dropzone sample</h1>
  <p>
    <a href="https://github.com/Yaxian/vue3-dropzone" target="_blank"
      >Yaxian/vue3-dropzone: HTML5 drag-drop zone with vue3</a
    >
    は Vue.js 3 では動く。
  </p>

  <div>
    <div v-bind="getRootProps()">
      <input v-bind="getInputProps()" />
      <p v-if="isDragActive">Drop the files here ...</p>
      <p v-else>Drag 'n' drop some files here, or click to select files</p>
    </div>
    <button @click="open">open</button>
  </div>
</template>

<script>
import { useDropzone } from "vue3-dropzone";
export default {
  name: "Vue3Dropzone",
  setup() {
    function onDrop(acceptFiles, rejectReasons) {
      console.log(acceptFiles);
      console.log(rejectReasons);
    }

    const { getRootProps, getInputProps, ...rest } = useDropzone({ onDrop });

    console.log(rest);

    return {
      getRootProps,
      getInputProps,
      ...rest,
    };
  },
};
</script>
