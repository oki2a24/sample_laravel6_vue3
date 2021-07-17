<template>
  <div class="container">
    <h1>SamplePagination</h1>
    <p>ページネーションを何件表示するか(showPages): {{ showPages }}</p>
    <p>現在のページ(currentPage): {{ currentPage }}</p>
    <p>総件数(totalCount): {{ totalCount }}</p>
    <p>総ページ数(totalPages): {{ totalPages }}</p>
    <p>1ページあたりの表示件数(perPage): {{ perPage }}</p>
    <hr />
    <p>クリックしたページ数: {{ clickedPageNumber }}</p>
    <base-pagination
      :show-pages="showPages"
      :current-page="currentPage"
      :total-count="totalCount"
      :total-pages="totalPages"
      :per-page="perPage"
      @currentPage="changePage"
    />
  </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import BasePagination from "../components/BasePagination.vue";

export default {
  name: "SamplePagination",
  components: { BasePagination },
  setup() {
    const showPages = ref(10);
    const currentPage = ref(3);
    const totalCount = ref(111);
    const totalPages = ref(12);
    const perPage = ref(10);

    const clickedPageNumber = ref(0);

    const changePage = (pageNumber) => {
      clickedPageNumber.value = pageNumber;
    };

    return {
      changePage,
      clickedPageNumber,
      currentPage,
      perPage,
      showPages,
      totalCount,
      totalPages,
    };
  },
};
</script>
