@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

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



            @if (Auth::user()->hasRole(1))
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"> Add a new Hotel
                        </div>
                        <div class="card-body">

                            <form action="{{ route('hotels.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Hotel Name</label>
                                            <div class="input-group mb-3">
                                                <input required type="text" class="form-control"
                                                    value="{{ old('name') }}" name="name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <div class="input-group mb-3">
                                                <input required type="text" class="form-control"
                                                    value="{{ old('contact_Phone') }}" name="contact_Phone">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <div class="input-group mb-3">
                                                <input required type="text" class="form-control"
                                                    value="{{ old('contact_Email') }}" name="contact_Email">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <div class="input-group mb-3">
                                                <input required type="text" class="form-control"
                                                    value="{{ old('address_Country') }}" name="address_Country">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>City</label>
                                            <div class="input-group mb-3">
                                                <input required type="text" class="form-control"
                                                    value="{{ old('address_City') }}" name="address_City">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <div class="input-group mb-3">
                                                <input required type="text" class="form-control"
                                                    value="{{ old('address_PostalCode') }}" name="address_PostalCode">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Street</label>
                                            <div class="input-group mb-3">
                                                <input required type="text" class="form-control"
                                                    value="{{ old('address_Street') }}" name="address_Street">
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



                        <table id="hotels" class="display">
                            <thead>
                                <tr>
                                    <th>Hotel ID</th>
                                    <th>Hotel Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Postal Code</th>

                                    <th>Phone</th>
                                    <th>Email</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($hotels as $hotel)
                                    <tr>
                                        <td>{{ $hotel->id }}</td>
                                        <td>{{ $hotel->name }}</td>

                                        <td>{{ $hotel->address_Street }}</td>
                                        <td>{{ $hotel->address_City }}</td>
                                        <td>{{ $hotel->address_Country }}</td>
                                        <td>{{ $hotel->address_PostalCode }}</td>

                                        <td>{{ $hotel->contact_Phone }}</td>
                                        <td>{{ $hotel->contact_Email }}</td>

                                        <td>
                                            <a href=" {{ route('hotels.show', $hotel->id) }} "
                                                class="btn btn-info m-1">View</a>
                                            @if (Auth::user()->hasRole(1))
                                                <form action=" {{ route('hotels.destroy', $hotel->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger m-1"
                                                        onclick="confirm('Are you sure you want to delete this hotel?') ? this.parentElement.submit() : ''">
                                                        Delete
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach



                            <tfoot>
                                <tr>
                                    <th>Hotel ID</th>
                                    <th>Hotel Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Postal Code</th>

                                    <th>Phone</th>
                                    <th>Email</th>

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

@section('js')
    <script>
        $(document).ready(function() {
            $('#hotels').DataTable();
        });
    </script>
@stop
