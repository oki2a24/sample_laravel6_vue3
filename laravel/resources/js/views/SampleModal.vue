<template>
  <div class="container">
    <h1>モーダルのサンプル</h1>
    <button
      type="button"
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#sampleModal1"
    >
      モーダルサンプル1
    </button>
    <sample-modal-content-1 :id="'sampleModal1'"> </sample-modal-content-1>

    <hr />

    <button
      type="button"
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#sampleModal2"
    >
      モーダルサンプル2。ファイルアップロード
    </button>
    <sample-modal-content-2 :id="'sampleModal2'"> </sample-modal-content-2>

    <hr />

    <router-link :to="{ name: 'SampleDropzone' }">SampleDropzone</router-link>
  </div>
</template>

<script>
import SampleModalContent1 from "./SampleModalContent1.vue";
import SampleModalContent2 from "./SampleModalContent2.vue";

export default {
  name: "SampleModal",
  components: { SampleModalContent1, SampleModalContent2 },
  setup() {},
};
</script>
