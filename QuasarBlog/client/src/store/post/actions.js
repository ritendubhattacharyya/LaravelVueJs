import axios from 'axios'

export function fetchPosts({ commit }) {
    axios.post('posts')
    .then(res => {
        commit('SET_POSTS', res.data);
    })
}