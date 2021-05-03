import { createRouter, createWebHistory } from "vue-router";
import ExampleComponent from "../components/ExampleComponent.vue"
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
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
