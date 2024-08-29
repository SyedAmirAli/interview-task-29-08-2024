import "../css/app.css";
import { createApp } from "vue/dist/vue.esm-bundler.js";
import router from "@/routes/index.js";
import App from "./App.vue";
import WithHeader from "./components/header/WithHeader.vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

const app = createApp(App);
app.component("with-header", WithHeader);
app.component("font-awesome-icon", FontAwesomeIcon);
app.use(router);
app.mount("#app");
