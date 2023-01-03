@extends('layouts.app')

@section('js')

    <script>
        $(document).ready(function() {
            $('#rooms').DataTable();
        });

        // on click edit button call this function

        function edit() {

            // enable all input fields
            $('input.hotel').removeAttr('disabled');

            // show the selection1 buttons
            $('button.selection1').removeClass('d-none');

            // hide the edit button
            $('button.selection2').addClass('d-none');
        }

        // on click cancel button call this function
        function cancel() {
            // Disable all input fields
            $('input.hotel').attr('disabled', 'disabled');

            // hide the save and cancel button
            $('button.selection1').addClass('d-none');

            // show the edit button
            $('button.selection2').removeClass('d-none');
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
                    <div class="card-header"> Hotel Details
                    </div>
                    <div class="card-body">
                        <form action="{{ route('hotels.update', $hotel->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hotel Name</label>
                                        <div class="input-group mb-3 hotel">
                                            <input disabled type="text" class="form-control hotel"
                                                value="{{ $hotel->name }}" name="name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control hotel"
                                                value="{{ $hotel->contact_Phone }}" name="contact_Phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control hotel"
                                                value="{{ $hotel->contact_Email }}" name="contact_Email">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control hotel"
                                                value="{{ $hotel->address_Country }}" name="address_Country">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>City</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control hotel"
                                                value="{{ $hotel->address_City }}" name="address_City">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control hotel"
                                                value="{{ $hotel->address_PostalCode }}" name="address_PostalCode">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Street</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control hotel"
                                                value="{{ $hotel->address_Street }}" name="address_Street">
                                        </div>

                                    </div>

                                </div>
                                @if (Auth::user()->hasRole(1))
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-primary selection2"
                                            onclick="edit()">Edit</button>
                                        <button type="button" class="btn btn-dark selection2"
                                            onclick=" window.location.href = '{{ route('hotels.index') }}';
                                    ">Go
                                            Back</button>

                                        <button type="reset" class=" btn btn-danger d-none selection1"
                                            onclick="cancel()">Cancel</button>
                                        <button type="submit" class=" btn btn-success d-none selection1">Save</button>

                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if (Auth::user()->hasRole(1))
                <div class="col-md-12 py-4 pb-0">
                    <div class="card">
                        <div class="card-header"> Add a new Room
                        </div>
                        <div class="card-body">
                            <form action="{{ route('rooms.store', $hotel->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Room Name</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" value="{{ old('name') }}"
                                                    name="name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Floor</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" value="{{ old('floor') }}"
                                                    name="floor">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Max Occupancy</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control"
                                                    value="{{ old('max_occupancy') }}" name="max_occupancy">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <button type="reset" class=" btn btn-danger">Reset</button>
                                        <button type="submit" class=" btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif


            <div class="col-md-12 pt-4">
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

                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>{{ $room->id }}</td>
                                        <td>{{ $room->name }}</td>
                                        <td>{{ $room->floor }}</td>
                                        <td>{{ $room->max_occupancy }}</td>
                                        <td>
                                            <a href="{{ route('rooms.show', ['hotel' => $hotel->id, 'room' => $room->id]) }}"
                                                class="btn btn-primary btn-sm">View</a>

                                            <form
                                                action=" {{ route('rooms.destroy', ['hotel' => $hotel->id, 'room' => $room->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger m-1"
                                                    onclick="confirm('Are you sure you want to delete this room?') ? this.parentElement.submit() : ''">
                                                    Delete
                                            </form>

                                    </tr>
                                @endforeach

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
