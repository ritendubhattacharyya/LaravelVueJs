@extends('layout.app')

@section('content')
    <div class="container my-5">
        <h3 class="my-4">Add Student</h3>
        <form id="add">
            @csrf
            <input
                type="text"
                class="form-group form-control"
                placeholder="Name"
                name="name">
            <input
                type="text"
                class="form-group form-control"
                placeholder="Address"
                name="address">
            <input
                type="text"
                class="form-group form-control"
                placeholder="Section"
                name="section">

            <button type="submit" class="btn btn-block btn-info text-white">Submit</button>
        </form>
    </div>
@endsection
@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#add').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '/add',
                    data: $('#add').serialize(),
                    success: function() {
                        alert('data saved');
                    },
                    error: function(error) {
                        alert('error');
                    }
                });
            });

        });
    </script>
@endsection
