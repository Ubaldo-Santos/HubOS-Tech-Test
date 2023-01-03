@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}
                        @if (Auth::user()->hasRole(0))
                            <b>Role:</b> User
                        @elseif (Auth::user()->hasRole(1))
                            <b>Role:</b> Admin
                        @endif
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (Auth::user()->hasRole(0))
                            <a href="" class="btn btn-primary">Book a room</a>
                        @elseif (Auth::user()->hasRole(1))
                            <a href="" class="btn btn-primary">Hotels</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
