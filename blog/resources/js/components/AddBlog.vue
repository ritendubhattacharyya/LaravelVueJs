<template>
    <div id="add-blog">
        <h1>Add Blog</h1>
        <div class="form" v-if="!posted">
            <label for="title">Title</label>
            <input type="text" v-model.lazy="blog.title" id="title">
            <label for="body">Body</label>
            <textarea v-model.lazy="blog.body" id="body"></textarea>

            <label>Select categories</label>
            <div class="categories">
                <label>WindStyle</label>
                <input type="checkbox" value="Wind Style" v-model="blog.categories">
                <label>FireStyle</label>
                <input type="checkbox" value="Fire Style" v-model="blog.categories">
                <label>EarthStyle</label>
                <input type="checkbox" value="Earth Style" v-model="blog.categories">
                <label>WaterStyle</label>
                <input type="checkbox" value="Water Style" v-model="blog.categories">
                <label>LightningStyle</label>
                <input type="checkbox" value="Lightning Style" v-model="blog.categories">
            </div>
            <label>Select the author</label>
            <select v-model="blog.author">
                <option v-for="author in authors" :key="author">{{ author }}</option>
            </select>
            <div class="form-control">
                <button v-on:click.prevent="post">Add post</button>
            </div>

        </div>

        <div class="success" v-if="posted">Successfully added the post</div>

        <div class="preview">
            <h3>Preview Blog</h3>
            <p>Blog title: {{ blog.title }}</p>
            <p>Blog body: </p>
            <p>{{ blog.body }}</p>
            <p>Blog category: </p>
            <!-- <ul v-for="category in categories" :key="category">
              <li></li>
            </ul> -->
            <template v-for="category in blog.categories">
                <p class="category_preview" v-bind:key="category">{{ category }}</p>
            </template>
            <p>Author: {{ blog.author }}</p>

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                blog: {
                    title: '',
                    body: '',
                    categories: [],
                    author: ''
                },
                authors: ['Hashirama', 'Tobirama', 'Sarutobi', 'Minato', 'Sunade', 'Kakashi', 'Naruto'],
                posted: false,
            }
        },
        props: {

        },
        methods: {
            post() {
                this.$http.post('/blogs', this.blog).then(function(data) {
                    console.log(data.body);
                    this.posted = true;
                })
            }
        }
    }
</script>

<style scoped>
    #add-blog {
        max-width: 800px;
        margin: 25px auto;
    }

    h1 {
        color: purple;
        padding: 0px 25px;
    }

    .form {
        margin-top: 45px;
        padding: 30px 25px;
        background-color: #707070;
        border-radius: 5px;
    }

    .form label {
        display: block;
        width: 100%;
        font-size: 18px;
        margin: 15px 0px;
    }

    .form input, .form textarea {
        display: block;
        width: 100%;
        padding: 15px 15px;
        outline: none;
        border: none;
    }

    .form textarea {
        resize: vertical;
    }

    .form input:focus, .form textarea:focus {
        border: 1px solid rgb(96, 183, 253);
    }

    .preview {
        margin-top: 45px;
        padding: 30px 25px;
        background-color: #f9f9f9;
        border: 1px solid rgb(221, 221, 221);
        border-radius: 5px;
    }

    .preview p {
        font-size: 16px;
        margin: 30px 0px;
        word-wrap: break-word;
    }

    .preview h3 {
        font-size: 20px;
        font-weight: 540;
    }

    .categories {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }

    .categories label {
        font-size: 16px;
    }

    .category_preview{
        font-size: 14px !important;
        margin-left: 15px !important;
        margin-top: 0px !important;
        margin-bottom: 8px !important;
    }

    .form select {
        display: block;
        padding: 4px 30px;
        border: none;
    }

    label {
        color: rgb(253, 253, 253);
    }

    .form-control button {
        margin: 20px 0px;
        padding: 10px 40px;
        background: transparent;
        border: 1px solid white;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-control button:hover {
        background-color: white;
        color: black;
    }

    .success {
        margin: 8px 0px;
        width: 100%;
        padding: 20px;
        background-color: rgb(205, 255, 205);
        color: green;
        border: 1px solid rgb(0, 255, 0);
        border-radius: 5px;
    }
</style>
