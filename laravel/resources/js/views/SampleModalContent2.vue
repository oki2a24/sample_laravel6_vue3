<template>
  <base-modal :id="id">
    <!-- modal header -->
    <template #header>
      <h5 :id="`${id}Label`" class="modal-title">アップロード操作エリア</h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
      >
        <span aria-hidden="true">&times;</span>
      </button>
    </template>

    <!-- modal body -->
    <template #body>
      <base-dropzone :url="'api/files'" @on-success="onSuccess" />
    </template>

    <!-- modal footer -->
    <template #footer>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">
        閉じる
      </button>
    </template>
  </base-modal>
</template>

<script>
import BaseDropzone from "../components/BaseDropzone.vue";
import BaseModal from "../components/BaseModal.vue";

export default {
  name: "SampleModalContent2",
  components: { BaseDropzone, BaseModal },
  props: {
    id: {
      default: "",
      require: true,
      type: String,
    },
  },
  setup() {
    const onSuccess = (file, response) => {
      console.log("SampleModalContent2.vue onSuccesss.", file, response);
    };

    return {
      onSuccess,
    };
  },
};
</script>
