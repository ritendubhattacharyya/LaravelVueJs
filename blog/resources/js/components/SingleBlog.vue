<template>
    <div id="single-blog">
        <h2>{{ blog.title }}</h2>
        <p>{{ blog.body }}</p>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                blog: {},
                id: this.$route.params.id
            }
        },
        created() {
            this.$http.get('/blogs/' + this.id).then(function(data) {
                this.blog=data.body
            });
        }
    }
</script>

<style scoped>
    #single-blog {
        background-color: #f1f1f1;
        max-width: 800px;
        padding: 30px 15px;
        border-radius: 6px;
        margin: 20px auto;
    }

    h2 {
        margin-bottom: 25px;
    }
</style>
