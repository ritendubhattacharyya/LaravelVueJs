<template>
    <ul>
        <li><router-link to='/' exact>Home</router-link></li>
        <li><router-link to='/add' exact>Add Blog</router-link></li>
    </ul>
</template>

<script>

    export default {

    }
</script>

<style scoped>
    ul {
        display: flex;
        justify-content: center;
        background-color: #444;
        padding: 20px 0px;
    }

    li {
        list-style: none;
    }

    a {
        text-decoration: none;
        color: white;
        margin: 0px 15px;
        font-size: 14px;
        padding: 10px;
        border-radius: 10px;
    }

    .router-link-active {
        background-color: #f3f3f3;
        color: #444;
    }
</style>
