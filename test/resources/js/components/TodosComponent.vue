<template>
    <draggable
        class="list-group"
        :list="todosNew"
        :options="{animation: 600}"
        :element="'ul'"
        @change="updateAll">
        <li class="list-group-item px-3 d-flex justify-content-between" v-for="todo in todosNew" :key="todo.id">
            <div class="d-flex align-items-center">
                <input type="checkbox" v-on:change="isDone(todo)" :checked="todo.done">
                <p class="ml-3" v-bind:class="{ strike : todo.done }">{{ todo.name }}</p>
            </div>
            <div>
                <button class="btn btn-warning" v-on:click="EditModal(todo)"><i class="glyphicon glyphicon-edit"></i></button>
                <button class="btn btn-danger rounded-circle" v-on:click="DeleteTodo(todo.id)"><i class="glyphicon glyphicon-remove"></i></button>
            </div>
        </li>

        <div id="edit" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Todo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editForm">
                        <div class="modal-body">
                            <input type="text" class="form-control" id="todo-name" name="name">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="saveTodo">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </draggable>
</template>

<script>
    import $ from 'jquery';
    import draggable from 'vuedraggable';

    export default {
        components: {
            draggable
        },
        props: {
            todos: {
                type: Array,
            }
        },
        data() {
            return {
                todosNew: this.todos,
            }
        },
        methods: {
            updateAll() {
                this.todosNew.map((todo, index) => {
                    todo.order = index + 1;
                });
                console.log(this.todosNew);
                this.$http.put('/', {
                    todoUpdated: this.todosNew,
                }).then(() => {
                    console.log('success');
                }).catch(err => {
                    console.log(err);
                })
            },
            DeleteTodo(todoId) {
                this.$http.delete('/' + todoId)
                    .then(()=> {
                    alert('delete successful');
                    location.reload();
                }).catch(err => alert(err));
            },
            EditModal(todo) {
                $('#edit').modal('show');

                $('#todo-name').val(todo.name);
                $('#saveTodo').on('click', function(e) {
                    e.preventDefault();

                    $.ajax({
                        type: 'PUT',
                        url: '/' + todo.id,
                        data: $('#editForm').serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            alert('update successful');
                            $('#edit').modal('hide');
                            location.reload();
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    })
                })
            },
            isDone(todo) {
                this.$http.put('/isDone/'+todo.id, {
                    done: !todo.done
                }).then(()=> {
                    location.reload();
                }).catch(err => alert(err));
            }
        }
    }
</script>

<style scoped>
    p {
        margin-bottom: 0;
    }

    .strike {
        text-decoration: line-through;
    }
</style>


