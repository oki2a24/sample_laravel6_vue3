<template>
  <div class="container">
    <h1>Select2 ラッパー SFC の利用</h1>
    <p>Selected: {{ selected }}</p>
    <base-select-2 v-model="selected" :match="matchCustom" :options="options">
      <option disabled value="0">Select one</option>
    </base-select-2>
  </div>
</template>

<script>
import { ref } from "vue";
import BaseSelect2 from "../components/BaseSelect2.vue";

//function matchCustom(params, data) {
const matchCustom = (params, data) => {
  // If there are no search terms, return all of the data
  //if ($.trim(params.term) === "") {
  if (!params.term || params.term.trim() === "") {
    return data;
  }

  // Do not display the item if there is no 'text' property
  if (typeof data.text === "undefined") {
    return null;
  }

  // `params.term` should be the term that is used for searching
  // `data.text` is the text that is displayed for the data object
  if (data.text.indexOf(params.term) > -1) {
    //var modifiedData = $.extend({}, data, true);
    let modifiedData = { ...data };
    modifiedData.text += " (matched)";

    // You can return modified objects from here
    // This includes matching the `children` how you want in nested data sets
    return modifiedData;
  }

  // 今回追加部分
  const hitted = [data.hiragana, data.alphabet]
    .filter((element) => element)
    .some((element) => {
      return element.indexOf(params.term) > -1;
    });
  if (hitted) {
    return data;
  }

  // Return `null` if the term should not be displayed
  return null;
};

export default {
  name: "SampleSelect2",
  components: { BaseSelect2 },
  setup() {
    const selected = ref("2");
    const options = [
      {
        id: "1",
        text: "北海道",
        hiragana: "ほっかいどう",
        alphabet: "hokkaido",
      },
      {
        id: "2",
        text: "青森県",
        hiragana: "あおもりけん",
        alphabet: "aomoriken",
      },
      { id: "3", text: "岩手県", hiragana: "いわてけん", alphabet: "iwateken" },
      {
        id: "4",
        text: "宮城県",
        hiragana: "みやぎけん",
        alphabet: "miyagiken",
      },
      { id: "5", text: "秋田県", hiragana: "あきたけん", alphabet: "akitaken" },
    ];

    return {
      matchCustom,
      options,
      selected,
    };
  },
};
</script>
