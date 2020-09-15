@extends('layout.app')

@section('content')
    <div class="container my-5">
        <h3>Students</h3>

        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Section</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <th scope="row">{{ $student->id }}</th>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->section }}</td>
                        <td class="d-flex justify-content-around">
                            <a href="#" class="btn btn-success editButton">Edit</a>
                            <form id="deleteData" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger deleteButton">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

{{--    edit modal--}}
    <div class="modal" tabindex="-1" role="dialog" id="EditModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                            <input
                                type="text"
                                class="form-group form-control"
                                placeholder="Name"
                                name="name"
                                id="name">
                            <input
                                type="text"
                                class="form-group form-control"
                                placeholder="Address"
                                name="address"
                                id="address">
                            <input
                                type="text"
                                class="form-group form-control"
                                placeholder="Section"
                                name="section"
                                id="section">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary EditStudent">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.editButton').on('click', function() {
                $('#EditModal').modal('show');

                let tr = $(this).closest('tr');
                // console.log(tr);
                let data = tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                let id = tr.children('th').map(function() {
                    return $(this).text();
                }).get();
                // console.log(id);

                $('#name').val(data[0]);
                $('#address').val(data[1]);
                $('#section').val(data[2]);

                $('.EditStudent').on('click', function(e) {
                    e.preventDefault();

                    $.ajax({
                        type: 'PUT',
                        url: 'edit/'+id[0],
                        data: $('#edit').serialize(),
                        success: function(response) {
                            console.log(response);
                            alert('data updated');
                            $('#EditModal').modal('hide');
                        },
                        error: function(error) {
                            console.log(error);
                            alert('something went wrong');
                        }
                    });
                });
            });

        });
    </script>
    <script>
        $(document).ready(function () {
            $('.deleteButton').on('click', function(e) {
                e.preventDefault();

                $('.deleteButton').on('click', function(e) {
                    e.preventDefault();

                    let tr = $(this).closest('form').closest('tr');

                    let id = tr.children('th').map(function() {
                        return $(this).text();
                    }).get();

                    $.ajax({
                        type: 'DELETE',
                        url: 'delete/'+id[0],
                        data: $('#deleteData').serialize(),
                        success: function(response) {
                            alert('delete successful');
                            location.reload();
                        },
                        error: function(error) {
                            alert(error);
                        }
                    });
                })
            })
        })
    </script>
@endsection
