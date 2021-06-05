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
      const myDropzone = new Dropzone("div#myDropzoneId", {
        url: props.url,
        addRemoveLinks: true,
        dictDefaultMessage:
          "画像ファイルをここにドロップするか、クリックしてアップロード",
        dictCancelUpload: "アップロードをキャンセル",
        dictRemoveFile: "操作エリアから除去",
      });
      myDropzone.on("success", (file, response) => {
        emit("onSuccess", file, response);
        setTimeout(() => myDropzone.removeFile(file), 10000);
      });
      myDropzone.on("error", function (file, errorMessage) {
        console.log("error", file, errorMessage); // TODO デバッグ用途。後で消すこと。
        // レスポンスの内容を使用するときは、エラーメッセージの後ろに付与すればよさそう。
        file.previewTemplate.getElementsByClassName(
          "dz-error-message"
        )[0].textContent = "アップロードに失敗しました。";
      });
    };

    onMounted(() => {
      initDropzone();
    });
  },
};
</script>

<style>
.dz-success {
  transition: opacity 10s, visibility 0s ease 10s;
  opacity: 0;
  visibility: hidden;
}
</style>
<!--
ここでスタイルを読み込むことも可能
<style src="../../../node_modules/dropzone/dist/dropzone.css"></style>
-->
