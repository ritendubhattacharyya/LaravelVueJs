<template>
    <div id="background" class="vh-100 vw-100 d-flex flex-column justify-content-center align-items-center">
        <div class="w-50 mb-5">
            <h3 class="text-center mb-4 display-4 font-weight-bold text-white">Lara-Vue Todo</h3>
            <add-component></add-component>
            <todos-component v-bind:todos="todos"></todos-component>
        </div>
    </div>
</template>

<script>
    import TodosComponent from './TodosComponent.vue'
    import AddComponent from './AddComponent.vue'

    export default {
        props: {
            todos: {
                type: Array,
            }
        },
        components: {
            'todos-component': TodosComponent,
            'add-component': AddComponent
        },
        mounted() {
            console.log('mounted');
        }
    }
</script>

<style scoped>
    #background {
        background: linear-gradient(#0099ff, #00ffff, #0099ff);
    }
</style>
