@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                                            <a href="" class="btn btn-primary m-1">Edit</a>
                                            <form action="" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="" class="btn btn-primary m-1">Rooms</a>
                                                <button type="submit" class=" m-1 btn btn-danger">Delete</button>
                                            </form>
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
