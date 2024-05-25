import axios from 'axios';
import 'pikaday/css/pikaday.css';
import pikaday from 'pikaday';
import moment from "moment";

window.Pikaday = pikaday;
window.moment = moment;

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
