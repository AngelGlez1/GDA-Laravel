@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <a href="{{ route('communes.index') }}" class="btn btn-primary"> Return Index</a> <br><br>
            <div class="card">
                <div class="card-header">{{ __($commune->description) }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <strong>ID</strong>
                    <p>{{ $commune->id_com }} </p>
                    <strong>Region</strong>
                    <p>{{ $region->description }} </p>
                    <strong>Communer</strong>
                    <p>{{ $commune->description }} </p>
                </div>
                <div class="card-footer text-muted">
                    <div>
                        <p class="pull-right">
                            <a href="{{ route('communes.edit', $commune->id_com) }}" class="btn btn-success">Edit</a>
                            <a href="#" style="color: white" onclick="send_form()" class="btn btn-danger">Eliminar</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="post" action="{{ route('communes.destroy', $commune) }}" name="delete_form">
    @csrf
    {{ method_field('DELETE') }}
</form>
@endsection

@section('foot')
    <script>
        function send_form(){
            document.delete_form.submit();
        }
    </script>
@endsection
