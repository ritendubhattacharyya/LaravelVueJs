<template>
    <form>
        <div class="input-group mb-3">
            <input
                type="text"
                class="form-control p-4"
                placeholder="Add todo..."
                v-model="name">
            <div class="input-group-append">
                <button class="btn btn-success px-4" v-on:click.prevent="AddTodo">Add</button>
            </div>
        </div>
    </form>
</template>

<script>

    export default {
        data() {
            return {
                name: ''
            }
        },
        methods: {
            AddTodo() {
                this.$http.post('/', {
                    name: this.name,
                    done: false
                }).then(function(data) {
                    console.log(data.body);
                    location.reload();
                }).catch(err => alert('something went wrong'))
            }
        }
    }
</script>

<style scoped>

</style>
