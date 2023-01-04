@extends('layouts.app')

@section('js')

    <script>
        $(document).ready(function() {
            table = $('#bookings').DataTable({
                "ajax": {
                    "url": "{{ route('bookings.list', ['hotel' => $hotel->id, 'room' => $room->id]) }}",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "check_in"
                    },
                    {
                        "data": "check_out"
                    }
                    // if the user is an admin show delete button
                    @if (Auth::user()->role == 1)
                        , {
                            "data": "id",
                            "render": function(data, type, row) {
                                return '<a href="{{ route('bookings.store', ['hotel' => $hotel->id, 'room' => $room->id]) }}/' +
                                    data + '/del" class="btn btn-danger">Delete</a>';
                            }
                        }
                    @elseif (Auth::user()->role == 0), {
                            "data": "id",
                            "render": function(data, type, row) {
                                if (row.uid == {{ Auth::user()->id }}) {
                                    return '<a href="{{ route('bookings.store', ['hotel' => $hotel->id, 'room' => $room->id]) }}/' +
                                        data + '/del" class="btn btn-danger">Delete</a>';
                                } else {
                                    return '';
                                }
                            }
                        }
                    @endif
                ]
            });

            // refresh the table every 5 seconds
            setInterval(function() {
                table.ajax.reload();
            }, 5000);

        });



        // on click on the submit button call this function

        function book() {
            // get the form
            var form = $('#booking-form');
            // get the url
            var url = form.attr('action');
            // ajax call
            $.ajax({
                type: "GET",
                url: url,
                data: form.serialize(),
                success: function(data) {
                    data = JSON.parse(data);
                    console.log("success");
                    console.log(data["success"]);
                    console.log("error");
                    console.log(data["error"]);



                    if (data["success"] != null) {

                        // create a div with the success message
                        var div = document.createElement('div');
                        div.className = 'alert alert-success';
                        // print the success message 
                        div.innerHTML = data["success"];
                        // append the div to the body
                        document.getElementById('comms').appendChild(div);
                        // remove the div after 3 seconds
                        setTimeout(function() {
                            document.getElementById('comms').removeChild(div);
                        }, 3000);
                    } else {
                        // create a div with the error message
                        var div = document.createElement('div');
                        div.className = 'alert alert-danger';
                        // print the error message
                        div.innerHTML = data["error"];
                        // append the div to the div with id comms
                        document.getElementById('comms').appendChild(div);
                        setTimeout(function() {
                            document.getElementById('comms').removeChild(div);
                        }, 3000); // remove the div with the class alert after 3 seconds
                    }
                },
                error: function(data) {}
            });


        }

        function DataTable() {

            // get all the bookings for the room
            var url = 2;
            // ajax call
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {}

            });
        }







        // on click edit button call this function

        function edit() {

            // enable all input fields
            $('input').removeAttr('disabled');

            // show the save and cancel button
            $('button.btn-danger').removeClass('d-none');
            $('button.btn-success').removeClass('d-none');
            // hide the edit button
            $('button.btn-primary').addClass('d-none');
            $('button.btn-dark').addClass('d-none');
        }

        // on click cancel button call this function
        function cancel() {
            // Disable all input fields
            $('input').attr('disabled', 'disabled');

            // hide the save and cancel button
            $('button.btn-danger').addClass('d-none');
            $('button.btn-success').addClass('d-none');
            // show the edit button
            $('button.btn-primary').removeClass('d-none');
            $('button.btn-dark').removeClass('d-none');
        }
    </script>

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id="comms">

                </div>
                @if (session('success'))
                    <div id="succes" class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div id="error" class="alert alert-danger ">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header"> Room Details
                    </div>
                    <div class="card-body">
                        <form action="{{ route('rooms.update', ['hotel' => $hotel->id, 'room' => $room->id]) }}"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Room Name</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control" value="{{ $room->name }}"
                                                name="name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Floor</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control" value="{{ $room->floor }}"
                                                name="floor">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Max Occupancy</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control"
                                                value="{{ $room->max_occupancy }}" name="max_occupancy">
                                        </div>
                                    </div>
                                </div>

                                @if (Auth::user()->hasRole(1))
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-primary" onclick="edit()">Edit</button>
                                        <button type="button" class="btn btn-dark"
                                            onclick=" window.location.href = '{{ route('hotels.show', $room->hotel_id) }}'
                                    ">Go
                                            Back</button>

                                        <button type="reset" class=" btn btn-danger d-none"
                                            onclick="cancel()">Cancel</button>
                                        <button type="submit" class=" btn btn-success d-none">Save</button>

                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <div class="col-md-12 py-4 pb-0">
                <div class="card">
                    <div class="card-header"> Book a room
                    </div>
                    <div class="card-body">
                        <form id="booking-form"
                            action="{{ route('bookings.store', ['hotel' => $hotel->id, 'room' => $room->id]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Number of guests</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" value="{{ old('guests') }}"
                                                name="guests">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date check-in</label>
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" value="{{ old('check_in') }}"
                                                name="check_in">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Date check-out</label>
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" value="{{ old('check_out') }}"
                                                name="check_out">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <button type="reset" class=" btn btn-danger">Reset</button>
                                    <button type="button" class=" btn btn-success" onclick=" book()">Book</button>'
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <div class="col-md-12
                                        py-4">
                <div class="card">
                    <div class="card-header"> History of books

                    </div>

                    <div class="card-body">
                        <table id="bookings" class="display">
                            <thead>
                                <tr>

                                </tr>
                            </thead>
                            <tbody>

                            <tfoot>
                                <tr>

                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
