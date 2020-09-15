import axios from 'axios'

export function signin({ dispatch }, credentials) {
    return axios.post('auth/login', credentials)
    .then(res => {
        localStorage.setItem('token', res.data);
        dispatch('me', res.data);
        // window.location.href = 'http://localhost:8080/#/';
    })
}

export function me({ commit }) {
    // commit('SET_TOKEN', token);
    // axios.defaults.headers.common['Authorization'] = token;
    // alert('me action');
    try {
        axios.get('auth/me')
        .then(res => {
            commit('SET_USER', res.data);
        })
        .catch(err => console.log(err))
    } catch(e) {
        console.log(e);
    }
}

export function signout({ commit }) {
    axios.post('auth/logout').then(res=> {
        commit('REMOVE_USER');
    })
}