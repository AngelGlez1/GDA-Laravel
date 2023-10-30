@extends('layouts.app')

@section('content')
@php
    use App\Models\Region;
    use App\Models\Commune;
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12">
                <form action="{{ route('customers.trashed') }}" method="GET">
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
            <a href="{{ route('customers.index') }}" class="btn btn-primary"> Return Index </a> <br><br>
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
                                    <td>{{ $customerf->dni }}</td>
                                    <td>{{ $customerf->name }}</td>
                                    <td>{{ $customerf->last_name }}</td>
                                    <td>{{ $customerf->email }}</td>
                                    <td>{{ $customerf->address }}</td>
                                    <td>{{ $region->description }}</td>
                                    <td>{{ $commune->description }}</td>
                                    <td>
                                        <p>
                                            <form method="post" action="{{ route('customers.restore', $customerf->dni) }}">
                                                @csrf
                                                {{ method_field('POST') }}
                                                <input type="submit" class="btn btn-danger" value="Recover">
                                            </form>
                                            <!-- <a href="#" style="color: white" onclick="send_formf()" class="btn btn-danger">Recover</a> -->
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
    <form method="post" action="{{ route('customers.restore', $customerf->dni) }}" name="restore_formf">
        @csrf
        {{ method_field('POST') }}
    </form>
@endif
@endsection

@section('foot')
    <script>
        function send_formf(){
            document.restore_formf.submit();
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
