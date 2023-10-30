@extends('layouts.app')

@section('content')
@php
    use App\Models\Region;
    use App\Models\Commune;
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <a href="{{ route('customers.create') }}" class="btn btn-primary"> New </a> <br><br>
        </div>
        
        <div class="col-md-10">
            <!-- <div class="card">
                <div class="card-header"></div> -->
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
                        @foreach($customers as $customer)
                            @php
                                $region = Region::find($customer->id_reg);
                                $commune = Commune::find($customer->id_com);
                            @endphp
                            <tr>
                                <td><a href="{{ route('customers.show', $customer) }}"> {{ __($customer->dni) }} </a></td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->last_name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $region->description }}</td>
                                <td>{{ $commune->description }}</td>
                                <td>
                                    <p>
                                        <a href="{{ route('customers.show', $customer->dni) }}" class="btn btn-primary">Show</a>
                                        <a href="{{ route('customers.edit', $customer->dni) }}" class="btn btn-success">Edit</a>
                                        <a href="#" style="color: white" onclick="send_form()" class="btn btn-danger">Delete</a>
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
                <div class="col-md-8 col-md-offset-2">{{ $customers->onEachSide(5)->links() }}</div>
            </div>
        </div><br><br><br><br><br>

        <div class="col-md-10">
            <div class="col-xl-12">
                <form action="{{ route('customers.index') }}" method="GET">
                    <div class="form-row">
                        <div class="col-sm-4 my-1">
                            <input type="text" class="form-control" name="text" value=" {{ $text }} ">
                        </div>
                        <div class="col-auto my-11">
                            <input type="submit" class="btn btn-primary" value="Find">
                        </div>
                    </div>
                </form>
            </div><br>
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
                                        <a href="#" style="color: white" onclick="send_formf()" class="btn btn-danger">Delete</a>
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
                <div class="col-md-8 col-md-offset-2">{{ $customersf->onEachSide(5)->links() }}</div>
            </div>
        </div>
    </div>
</div>
<form method="post" action="{{ route('customers.destroy', $customer) }}" name="delete_form">
    @csrf
    {{ method_field('DELETE') }}
</form>
<form method="post" action="{{ route('customers.destroy', $customerf->dni) }}" name="delete_formf">
    @csrf
    {{ method_field('DELETE') }}
</form>
@endsection

@section('foot')
    <script>
        function send_form(){
            document.delete_form.submit();
        }
        function send_formf(){
            document.delete_formf.submit();
        }
    </script>
@endsection



<!-- <div class="alert alert-info" role="alert">
  A simple info alert—check it out!
</div> -->
