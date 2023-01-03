@extends('layouts.app')

@section('js')

    <script>
        $(document).ready(function() {
            $('#rooms').DataTable();
        });

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
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger ">
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
            <div class="col-md-12 py-4">
                <div class="card">
                    <div class="card-header"> List of Rooms

                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table id="rooms" class="display">
                            <thead>
                                <tr>
                                    <th>Room ID</th>
                                    <th>Room Name</th>
                                    <th>Floor</th>
                                    <th>Max Occupancy</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            <tfoot>
                                <tr>
                                    <th>Room ID</th>
                                    <th>Room Name</th>
                                    <th>Floor</th>
                                    <th>Max Occupancy</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
