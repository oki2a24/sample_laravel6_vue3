import { createRouter, createWebHistory } from "vue-router";
import ExampleComponent from "../components/ExampleComponent.vue";
import Vue2Dropzone from "../views/Vue2Dropzone.vue";
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
    path: "/example_component",
    name: "ExampleComponent",
    component: ExampleComponent,
  },
  {
    path: "/vue2_dropzone",
    name: "Vue2Dropzone",
    component: Vue2Dropzone,
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
