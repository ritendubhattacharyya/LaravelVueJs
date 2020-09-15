@extends('layout.app')

@section('content')
    <div class="container my-5">
        <h3 class="my-4">Select State</h3>
        <form id="add">
            @csrf
            <select name="states" id="states" class="form-control">
                <option value="0">Select State...</option>
                @foreach($states as $state)
                    <option value="{{ $state->id }}">{{ $state->state }}</option>
                @endforeach
            </select>

            <select name="cities" id="cities" class="form-control mt-3">

            </select>
        </form>
    </div>
@endsection
@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#states').on('change', function() {
                let id = $(this).val();
                let cities = $('#cities');
                cities.empty();
                cities.append(`<option value="0" disabled selected>Processing</option>`);

                $.ajax({
                    type: 'GET',
                    url: 'getCity/' + id,
                    success: function(response) {
                        let result = JSON.parse(response);
                        console.log(result);
                        cities.empty();
                        cities.append(`<option value="0" disabled selected>Processing</option>`);
                        result.forEach(element => {
                            cities.append(`<option value="${element.id}">${element.city}</option>`);
                        })
                    },
                    error: function(error) {
                        alert('error');
                    }
                });
            })
        });
    </script>
@endsection
