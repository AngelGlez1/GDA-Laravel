@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __(Get Communer) }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <strong>DNI</strong>
                    <p>{{ $customer->dni }} </p>
                    <strong>Region</strong>
                    <p>{{ $region->description }} </p>
                    <strong>Communer</strong>
                    <p>{{ $commune->description }} </p>
                    <strong>Email</strong>
                    <p>{{ $customer->email }} </p>
                    <strong>Address</strong>
                    <p>{{ $customer->address }} </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
