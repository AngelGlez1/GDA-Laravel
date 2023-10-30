@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Customer') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('customers.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="dni" class="col-md-4 col-form-label text-md-end">{{ __('DNI') }}</label>

                            <div class="col-md-6">
                                <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ old('dni') }}" required autocomplete="dni" autofocus>

                                @error('dni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="id_reg" class="col-md-4 col-form-label text-md-end">{{ __('ID Region') }}</label>

                            <div class="col-md-6">
                            <select id="id_reg" name="id_reg" onchange="getReg(this)" class="form-select" aria-label="Default select example">
                                <!-- onchange="getReg(this)" -->
                                <option selected>Select Option</option>
                                    <!-- {{$valreg = 0}} -->
                                    @foreach($region as $items)
                                    <option value= "{{$items->id_reg}}">{{$items->description}}</option>
                                    @endforeach
                                </select>
                                <!-- <input id="id_reg" type="number" onkeypress="return event.charCode>=48 && event.charCode<=57" class="form-control @error('id_reg') is-invalid @enderror" name="id_reg" value="{{ old('id_reg') }}" required autocomplete="id_reg"> -->

                                @error('id_reg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="id_com" class="col-md-4 col-form-label text-md-end">{{ __('ID Commune') }}</label>

                            <div class="col-md-6">
                            <select id="id_com" name="id_com" class="form-select" aria-label="Default select example">
                            <option selected>Select Option</option>
                                @php
                                    //
                                @endphp
                                @foreach($commune as $items)
                                    <!-- //@if($valreg == $items->id_reg) -->
                                    <!-- //@endif -->
                                    <option value= "{{$items->id_com}}">{{$items->description}}</option>
                                @endforeach
                            </select>
                                <!-- <input id="id_com" type="number" onkeypress="return event.charCode>=48 && event.charCode<=57" class="form-control @error('id_com') is-invalid @enderror" name="id_com" value="{{ old('id_com') }}" required autocomplete="id_com"> -->

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <a href="{{ route('customers.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script> 
//   function getReg(selectObject) {
//   //var valreg = selectObject.value;  
//   console.log(selectObject.value);
// }

function getReg(selectObject) {
        console.log('You selected: ', selectObject.value);
        var id = selectObject.value;
        var url = "{{route('getcommuner', ':id_reg')}}";
        url = url.replace(':id', id);
        console.log(url);
        // "ajax": {
            
        //     type: "GET",
        //     url: url,
        // },
        // language: {
        //     url: 'js/es-mx.json'
        // }
}

// $(#id_reg).change(function(){
//     var reg_id = $(#id_reg).val();
//     console.log($reg_id);
//     $('#id_com').append({
//         dom: 'Bfrtip',
//         "ajax":{
//             type: "GET",
//             url: "customers/getcommunner",
//         },
//         language: {
//             url: 'js/es-mx.json'
//         }
//     });
// });

// $(#id_reg).on('change', function(e){
// // function getReg(selectObject) {    
//     var reg_id = e.target.value;
//     console.log($reg_id);
//     $.post("customers/getcommuner", { 
//         'id_reg' : $id_reg },
//         function(data) {
//             var sel = $("#id_com");
//             sel.empty();
//             for (var i=0; i<data.length; i++) {
//                 sel.append('<option value="' + data[i].id + '">' + data[i].description + '</option>');
//             }
//     }, "json");
// // }
// });
</script>