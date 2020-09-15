export function authorized(state) {
    return state.user;
}
export function getUserInfo(state) {
    return state.user;
}
export function isAdmin(state) {
    return state.user.role === 'admin';
}
export function isAuthor(state) {
    return state.user.role === 'author';
}
export function isUser(state) {
    return state.user.role === 'user';
}


