import { createRouter, createWebHistory } from "vue-router";
import ExampleComponent from "../components/ExampleComponent.vue";
import SampleDropzone from "../views/SampleDropzone.vue";
import SampleFlatpickr from "../views/SampleFlatpickr.vue";
import SampleModal from "../views/SampleModal.vue";
import SamplePagination from "../views/SamplePagination.vue";
import SampleVueFlatpickr from "../views/SampleVueFlatpickr.vue";
import SampleSelect2 from "../views/SampleSelect2.vue";
import Vue3Dropzone from "../views/Vue3Dropzone.vue";
const Home = { template: "<div>Home</div>" };
const About = { template: "<div>About</div>" };

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/about",
    name: "About",
    component: About,
  },
  {
    path: "/sample_dropzone",
    name: "SampleDropzone",
    component: SampleDropzone,
  },
  {
    path: "/sample_vue_flatpickr",
    name: "SampleVueFlatpickr",
    component: SampleVueFlatpickr,
  },
  {
    path: "/sample_flatpickr",
    name: "SampleFlatpickr",
    component: SampleFlatpickr,
  },
  {
    path: "/sample_modal",
    name: "SampleModal",
    component: SampleModal,
  },
  {
    path: "/sample_pagination",
    name: "SamplePagination",
    component: SamplePagination,
  },
  {
    path: "/sample_select2",
    name: "SampleSelect2",
    component: SampleSelect2,
  },
  {
    path: "/example_component",
    name: "ExampleComponent",
    component: ExampleComponent,
  },
  {
    path: "/vue3_dropzone",
    name: "Vue3Dropzone",
    component: Vue3Dropzone,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
