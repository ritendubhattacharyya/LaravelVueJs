<template>
    <div v-theme:column="'wide'" class="show-blog">
        <h2>All Blog Articles</h2>
        <input type="text" v-model="search" placeholder="Search...">
        <div class="single-blog" v-for="blog in searchBlog" :key="blog.id">
            <router-link v-bind:to="'/' + blog.id"><h4>{{ blog.title }}</h4></router-link>
            <p>{{ blog.body | snippet }}</p>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                blogs: [],
                search: ''
            }
        },
        created() {
            this.$http.get('/blogs').then(function(data) {
                this.blogs=data.body;
                console.log(data);
            });
        },
        computed: {
            searchBlog() {
                return this.blogs.filter((blog) => {
                    return blog.title.toLowerCase().match(this.search.toLowerCase());
                })
            }
        },
        filters: {
            snippet(value) {
                return value.slice(0, 90) + '...';
            }
        },
        directives: {
            theme: {
                bind(el, binding) {
                    if(binding.value === 'wide') {
                        el.style.width = '1600px';
                    } else if(binding.value === 'narrow') {
                        el.style.width = '600px';
                    }

                    if(binding.arg === 'column') {
                        el.style.backgroundColor = '#e2e2e2';
                        el.style.padding = '10px 15px';
                    }
                }
            }
        }
    }
</script>

<style scoped>
    h2 {
        font-size: 28px;
        padding: 20px 0px;
        text-align: center;
    }

    .show-blog {
        max-width: 700px;
        margin: 15px auto;
        padding: 0px 20px;
    }

    .single-blog {
        background-color: rgb(240, 240, 240);
        margin: 20px 0px;
        padding: 40px 20px;
        border-radius: 5px;
    }

    h4 {
        font-size: 18px;
    }

    .show-blog input {
        display: block;
        width: 100%;
        padding: 15px 15px;
        outline: none;
        border: none;
        border-radius: 5px;
    }

    .show-blog input:focus {
        border: 1px solid rgb(96, 183, 253);
    }
</style>
