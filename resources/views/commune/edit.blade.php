@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Commune') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('communes.update', $commune->id_com) }}">
                        @csrf
                        {{ method_field('PUT') }}

                        <div class="row mb-3" hidden>
                            <label for="id_com" class="col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                            <div class="col-md-6">
                                <input id="id_com" type="text" value="{{ $commune->id_com }}" class="form-control @error('id_com') is-invalid @enderror" name="id_com"  autocomplete="id_com" autofocus>

                                @error('id_com')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="id_reg" class="col-md-4 col-form-label text-md-end">{{ __('ID Region') }}</label>

                            <div class="col-md-6">
                            <select id="id_reg" name="id_reg" class="form-select form-control @error('id_reg') is-invalid @enderror" aria-label="Default select example">
                                <option selected value=" {{$region->id_reg}} "> {{$region->description}} </option>
                                    @foreach($regiona as $items)
                                        @if( $items->id_reg != $region->id_reg )
                                            <option value="{{$items->id_reg}}">{{$items->description}}</option>
                                        @endif
                                    @endforeach
                            </select>

                                @error('id_reg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $commune->description }}" required autocomplete="description" autofocus>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                                <a href="{{ route('communes.index') }}" class="btn btn-danger">Cancel</a>
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