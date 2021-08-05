<template>
  <div class="container">
    <h1>Dropzone.js sample</h1>
    <h2>アップロード済ファイル</h2>
    <ul class="list-group">
      <li
        v-for="(file, i) in files"
        :key="i"
        class="
          list-group-item
          d-flex
          justify-content-between
          align-items-center
        "
      >
        <img class="thumbnail" :src="file.url" />
        <div>
          <p>{{ file.name }}</p>
          <small>{{ file.size }} byte</small>
        </div>
        <button type="button" class="btn btn-danger" @click="deleteFile(file)">
          削除
        </button>
      </li>
    </ul>
    <h2>アップロード操作エリア</h2>
    <base-dropzone
      :url="'api/files'"
      @on-addedfile="onAddedfile"
      @on-success="onSuccess"
    />
  </div>
</template>

<script>
import { onMounted, ref } from "vue";
import BaseDropzone from "../components/BaseDropzone.vue";

const url = "api/files";

export default {
  name: "SampleDropzone",
  components: { BaseDropzone },
  setup() {
    const files = ref([]);

    const getFiles = () => {
      return fetch(url).then((response) => response.json());
    };

    onMounted(async () => {
      const data = await getFiles();
      files.value = data;
    });

    const onSuccess = (file, response) => {
      //console.log("SampleDropzone.vue onSuccesss.", file, response);
      files.value.push(response);
    };

    const deleteFile = async (file) => {
      //console.log(file, file.id);
      // 削除
      await fetch(`${url}/${file.id}`, { method: "DELETE" });

      // 再読み込み
      const reloaded = await getFiles();
      //console.log(reloaded);
      files.value = reloaded;
    };

    const onAddedfile = (file, myDropzone) => {
      const confirmed = window.confirm("アップロードしますよ?");
      if (confirmed) {
        // myDropzone.processQueue(); では動作しない。
        // `addedfile` 完了後に `myDropzone.processQueue()` を実行するために setTimeout を使用
        setTimeout(() => myDropzone.processQueue(), 0);
      } else {
        myDropzone.removeFile(file);
      }
    };

    return {
      deleteFile,
      files,
      onAddedfile,
      onSuccess,
    };
  },
};
</script>

<style scoped>
.thumbnail {
  height: 120px;
  width: 120px;
}
</style>
