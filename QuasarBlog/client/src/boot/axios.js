import Vue from 'vue'
import axios from 'axios'

axios.defaults.baseURL="http://localhost:8000/api/"

axios.interceptors.request.use((config) => {
    console.log(config);
    if(localStorage.getItem('token')) {
        let token = localStorage.getItem('token');
        if(token !== null) {
            config.headers.Authorization = 'Bearer ' + token;
        }
    }
    return config;
})

axios.interceptors.response.use((response) => {
    return response;
}, (error) => {
    // alert('error block');
    if(error.response.status === 401) {
        localStorage.removeItem('token');
        window.location.href = "http://localhost:8080/#/login";
    }
    return Promise.reject(error);
})

Vue.prototype.$axios = axios


