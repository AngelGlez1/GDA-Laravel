@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('regions.create') }}" class="btn btn-primary"> New </a> <br><br>
        </div>
        <div class="col-md-5">
            <div class="table-responsive justify-content-center">
            <!-- <div class="card">
                <div class="card-header"></div> -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Region</th>
                            <th>Region</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($regions as $region)
                            <tr>
                                <td><a href="{{ route('regions.show', $region) }}"> {{ __($region->id_reg) }} </a></td>
                                <td>{{ $region->description }}</td>
                                <td>
                                    <p>
                                        <a href="{{ route('regions.show', $region->id_reg) }}" class="btn btn-primary">Show</a>   
                                        <a href="{{ route('regions.edit', $region->id_reg) }}" class="btn btn-success">Edit</a>   
                                        <form method="post" action="{{ route('regions.destroy', $region) }}">
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
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">{{ $regions->onEachSide(5)->links() }}</div>
            </div>
        </div>
    </div>
</div>
<form method="post" action="{{ route('regions.destroy', $region) }}" name="delete_form">
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
