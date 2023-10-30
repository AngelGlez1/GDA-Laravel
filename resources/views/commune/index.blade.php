@extends('layouts.app')

@section('content')
@php
    use App\Models\Region;
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('communes.create') }}" class="btn btn-primary"> New </a> <br><br>
        </div>
        <div class="col-md-5">
            <!-- <div class="card">
                <div class="card-header"></div> -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Region</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($communes as $commune)
                            <tr>
                                <td><a href="{{ route('communes.show', $commune) }}"> {{ __($commune->id_com) }} </a></td>
                                @php
                                    $region = Region::find($commune->id_reg);
                                @endphp
                                <td>{{ $region->description }}</td>
                                <td>{{ $commune->description }}</td>
                                <td>
                                    <p>
                                        <a href="{{ route('communes.show', $commune->id_com) }}" class="btn btn-primary">Show</a>   
                                        <a href="{{ route('communes.edit', $commune->id_com) }}" class="btn btn-success">Edit</a> 
                                        <form method="post" action="{{ route('communes.destroy', $commune) }}">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>  
                                        <!-- <a href="#" style="color: white" onclick="send_form()" class="btn btn-danger">Delete</a>     -->
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    

                    <!-- <div class="card-body"></div> -->

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </table>
            <!-- </div> Card -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">{{ $communes->onEachSide(5)->links() }}</div>
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



<!-- <div class="alert alert-info" role="alert">
  A simple info alert—check it out!
</div> -->
