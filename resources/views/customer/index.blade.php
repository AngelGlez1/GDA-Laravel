@extends('layouts.app')

@section('content')
@php
    use App\Models\Region;
    use App\Models\Commune;
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12">
                <form action="{{ route('customers.index') }}" method="GET">
                    <div class="form-row">
                        <div class="col-sm-4 my-1">
                            <input id="textfind" type="text" class="form-control" name="text" value=" {{ $text }} ">
                        </div>
                        <div class="col-auto my-11">
                            <input type="submit" class="btn btn-primary" value="Find">
                        </div>
                        <!-- <div class="col-auto my-11">
                            <a href="#" style="color: white" onclick="reset_formf()" class="btn btn-primary">Reset</a>
                        </div> -->
                    </div>
                </form>
        </div><br>

        <div class="col-md-10">
            <a href="{{ route('customers.create') }}" class="btn btn-primary"> New </a> 
            <a href="{{ route('customers.trashed') }}" class="btn btn-primary"> Trashed </a> <br><br>
        </div>

        <div class="col-md-10">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Region</th>
                            <th>Communer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @if(count($customersf)<=0)

                            <tr>
                                <td colspan="8">No hay Resultados</td>
                            </tr>

                        @else

                            @foreach($customersf as $customerf)
                                @php
                                    $region = Region::find($customerf->id_reg);
                                    $commune = Commune::find($customerf->id_com);
                                @endphp
                                <tr>
                                    <td><a href="{{ route('customers.show', $customerf->dni) }}"> {{ __($customerf->dni) }} </a></td>
                                    <td>{{ $customerf->name }}</td>
                                    <td>{{ $customerf->last_name }}</td>
                                    <td>{{ $customerf->email }}</td>
                                    <td>{{ $customerf->address }}</td>
                                    <td>{{ $region->description }}</td>
                                    <td>{{ $commune->description }}</td>
                                    <td>
                                        <p>
                                            <a href="{{ route('customers.show', $customerf->dni) }}" class="btn btn-primary">Show</a>
                                            <a href="{{ route('customers.edit', $customerf->dni) }}" class="btn btn-success">Edit</a>
                                            <form method="post" action="{{ route('customers.destroy', $customerf->dni) }}">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </form>
                                            <!-- <a href="#" style="color: white" onclick="send_formf()" class="btn btn-danger">Delete</a> -->
                                        </p>
                                    </td>
                                </tr>
                            @endforeach

                        @endif
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
                <div class="col-md-8 col-md-offset-2">{{ $customersf->onEachSide(5)->links() }}</div>
            </div>
        </div>
    </div>
</div>

@if(count($customersf)<=0)
<br>
@else
    <form method="post" action="{{ route('customers.destroy', $customerf->dni) }}" name="delete_formf">
        @csrf
        {{ method_field('DELETE') }}
    </form>
@endif
@endsection

@section('foot')
    <script>
        function send_formf(){
            document.delete_formf.submit();
        }
        function reset_formf(){
            var toclean = document.getElementsById("textfind");
            toclean.value = "";
            send_formf();
        }
    </script>
@endsection



<!-- <div class="alert alert-info" role="alert">
  A simple info alert—check it out!
</div> -->
