import axios from 'axios'
import router from '../../router'
export function SET_TOKEN(state, token) {
    state.token = token;
}

export function SET_USER(state, credentials) {
    axios.post('users/online', credentials).then(res => {
        state.user = credentials;
        location.replace('http://localhost:8080/#/admin');
      // router.push({path: '/admin'});
    });
}

export function REMOVE_USER(state) {
    axios.post('users/offline', state.user).then(res => {
        state.user = null;
        localStorage.removeItem('token');
        location.replace('http://localhost:8080/#/login');
    });
  // router.push({path: '/'});
}
