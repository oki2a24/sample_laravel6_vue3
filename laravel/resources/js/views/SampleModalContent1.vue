<template>
  <base-modal :id="id" @show="onShow" @hide="onHide">
    <!-- modal header -->
    <template #header>
      <h5 :id="`${id}Label`" class="modal-title">Modal title</h5>
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
    <template #body>モーダルボディ </template>

    <!-- modal footer -->
    <template #footer>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">
        Close
      </button>
      <button type="button" class="btn btn-primary">Save changes</button>
    </template>
  </base-modal>
</template>

<script>
import { onBeforeMount, onMounted, onBeforeUnmount, onUnmounted } from "vue";
import BaseModal from "../components/BaseModal.vue";

export default {
  name: "SampleModalContent1",
  components: { BaseModal },
  props: {
    id: {
      default: "",
      require: true,
      type: String,
    },
  },
  setup() {
    // モーダル表示時や非表示に実行されない。モーダルを埋め込んだページへ移動した時や去る時に実行される点に注意
    onBeforeMount(() => console.log("SampleModalContent1 onBeforeMount"));
    onMounted(() => console.log("SampleModalContent1 onMounted"));
    onBeforeUnmount(() => console.log("SampleModalContent1 onBeforeUnmount"));
    onUnmounted(() => console.log("SampleModalContent1 onUnmounted"));
    // したがって、もしモーダル表示時等に処理をしたい場合は、モーダルのイベントでその処理を行う必要がある。
    const onShow = () => console.log("SampleModalContent1 モーダル表示");
    const onHide = () => console.log("SampleModalContent1 モーダル非表示");

    return { onHide, onShow };
  },
};
</script>
