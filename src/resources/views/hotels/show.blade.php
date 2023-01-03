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
                <div class="card">
                    <div class="card-header"> Hotel Details
                    </div>
                    <div class="card-body">
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
                        <form action="{{ route('hotels.update', $hotel->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hotel Name</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control" value="{{ $hotel->name }}"
                                                name="name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control"
                                                value="{{ $hotel->contact_Phone }}" name="contact_Phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control"
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
                                            <input disabled type="text" class="form-control"
                                                value="{{ $hotel->address_Country }}" name="address_Country">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>City</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control"
                                                value="{{ $hotel->address_City }}" name="address_City">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control"
                                                value="{{ $hotel->address_PostalCode }}" name="address_PostalCode">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Street</label>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" class="form-control"
                                                value="{{ $hotel->address_Street }}" name="address_Street">
                                        </div>

                                    </div>

                                </div>
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-primary" onclick="edit()">Edit</button>
                                    <button type="button" class="btn btn-dark"
                                        onclick=" window.location.href = '{{ route('hotels.index') }}';
                                    ">Go
                                        Back</button>

                                    <button type="reset" class=" btn btn-danger d-none" onclick="cancel()">Cancel</button>
                                    <button type="submit" class=" btn btn-success d-none">Save</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 py-4">
                <div class="card">
                    <div class="card-header"> List of Hotels
                        @if (Auth::user()->hasRole(0))
                        @elseif (Auth::user()->hasRole(1))
                        @endif
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
                                    <th>Max Occupancy</th>
                                    <th>Floor</th>
                                </tr>
                            </thead>
                            <tbody>

                            <tfoot>
                                <tr>
                                    <th>Room ID</th>
                                    <th>Room Name</th>
                                    <th>Max Occupancy</th>
                                    <th>Floor</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
