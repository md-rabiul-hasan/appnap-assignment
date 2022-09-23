import axios from 'axios'

axios.defaults.baseURL = "http://localhost/Learning/appnap-assignment/backend/api/v1";
axios.defaults.headers.common["Authorization"] = 'Bearer ' + localStorage.getItem('token');