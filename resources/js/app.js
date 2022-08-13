import "bootstrap/dist/css/bootstrap.css";
import './bootstrap';
import {createApp} from 'vue';
import app from '../layouts/app.vue';
import router from '../Router/router.js';
import Vuelidate from 'vuelidate';
import swal from 'sweetalert2';
window.Swal = swal;

const apps=createApp(app);
apps.use(Vuelidate);
apps.use(router);
apps.mount("#app");
import "bootstrap/dist/js/bootstrap.js";
