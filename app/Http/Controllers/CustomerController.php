<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\Region;
use App\Models\Commune;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $text = trim($request->get('text'));
        $customersf = DB::table('customers')
            ->select( 'dni', 'name', 'last_name', 'email', 'address', 'id_reg', 'id_com' )
            ->whereNull('deleted_at')
            ->where(function ($query) use ($text) {
                $query->where('dni', 'LIKE', '%'.$text.'%')
                ->orWhere('email', 'LIKE', '%'.$text.'%');
            })
            ->orderBy('dni', 'asc')
            ->paginate(5);
        $customers = Customer::paginate(5);
        return view('customer.index', compact('customers', 'customersf', 'text'));
    }


    /**
     * Display a listing of the resource.
     */
    public function trashed(Request $request)
    {
        $text = trim($request->get('text'));
        $customersf = DB::table('customers')
            ->select( 'dni', 'name', 'last_name', 'email', 'address', 'id_reg', 'id_com' )
            ->whereNotNull('deleted_at')
            ->where(function ($query) use ($text) {
                $query->where('dni', 'LIKE', '%'.$text.'%')
                ->orWhere('email', 'LIKE', '%'.$text.'%');
            })
            ->orderBy('dni', 'asc')
            ->paginate(5);
        $customers = Customer::paginate(5);
        return view('customer.trashed', compact('customers', 'customersf', 'text'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $region = Region::all();
        $commune = Commune::all();
        // $communes = [];
        // dd($request);
        // $commune = Commune::where('id_reg', $region->id_reg)
        // ->get();
        return view('customer.create', compact('region', 'commune'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        // Validator
        $validated = $request->validate([
            'dni' => 'required|unique:customers|max:15',
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => ['required', 'max:255', Rule::unique('customers', 'email')->where(function ($query){
                        return $query->whereNull('deleted_at');
                    })],
        ]);
        // $validated = $request->validate([
        //     'dni' => ['required', 'max:255', Rule::unique('customers', 'dni')->where(function ($query){
        //         return $query->whereNull('deleted_at');
        //     })],
        //     'name' => 'required|max:255',
        // ]);

        //Storing
        $region = Region::find($request->id_reg);
        $commune = Commune::find($request->id_com);
        $customer = new Customer;
        $customer->dni = $request->dni;
        $customer->id_reg = $request->id_reg;
        $customer->id_com = $request->id_com;
        $customer->name = $request->name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->date_reg = Carbon::today();
        if($region->id_reg == $commune->id_reg){
            $customer->save();
            return redirect()->route('customers.show', $request->dni)
            ->with('success', 'The customer has been updated succes!');
        }else{
            return redirect()->route('customers.create')
            ->with('error', 'Error the communer does not match the region!');
        }

        //$customer->user_id = Auth::customer()->id; pa registar quien modifico

        /**
         * return Customer::create($request->all()); 
         * 
         * 
         *
         * return Customer::create([
         *  dni => $request['dni'],
         *  id_reg => $request['id_reg'],
         *  id_com => $request['id_com'],
         *  name => $request['name'],
         *  lastname => $request['last_name'],
         *  email => $request['email'],
         *  address => $request['address'],
         * ]);
         */ 
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        // dd($customer);
        $region = Region::find($customer->id_reg);
        //dd($region);
        $commune = Commune::find($customer->id_com);
        return view('customer.show')->with(compact('customer', 'region', 'commune'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $regiona = Region::all();
        $communea = Commune::all();
        $region = Region::find($customer->id_reg);
        $commune = Commune::find($customer->id_com);
        return view('customer.edit', compact('customer', 'region', 'commune', 'regiona', 'communea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //Validations
        // Validator
        $validated = $request->validate([
            'dni' => 'required|max:15',
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
        ]);

        //Update
        $region = Region::find($request->id_reg);
        $commune = Commune::find($request->id_com);
        $customer->dni = $request->dni;
        $customer->id_reg = $request->id_reg;
        $customer->id_com = $request->id_com;
        $customer->name = $request->name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        if($region->id_reg == $commune->id_reg){
            $customer->save();
            return redirect()->route('customers.show', $customer->dni)
            ->with('success', 'The customer has been updated succes!');
        }else{
            return redirect()->route('customers.edit', $customer->dni)
            ->with('error', 'Error the communer does not match the region!');
        }
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if ($customer->trashed()) {
            $customer->restore();
            return redirect()->route('customers.index')
            ->with('info', 'The customer has been restored succes!');
        }else{
            $customer->delete();
            return redirect()->route('customers.index')
            ->with('info', 'The customer has been deleted succes!');
        }
        

    }


    public function restore(Customer $customer)
    {
        $customer->restore();
        return redirect()->route('customers.trashed')
            ->with('info', 'The customer has been deleted succes!');
        // if ($customer->trashed()) {
        //     $customer->restore();
        //     return redirect()->route('customers.index')
        //     ->with('info', 'The customer has been restored succes!');
        // }else{
        //     $customer->delete();
        //     return redirect()->route('customers.index')
        //     ->with('info', 'The customer has been deleted succes!');
        // }

    }




    public function getcommuner($id_reg)
    {
        $communes = Commune::where('id_reg', $id_reg);
        dd($communes);
        $i = 0;
        foreach ( $communes as $com)
        {
            // $result['data'][$i][] = $com->id_com;
            // $result['data'][$i][] = $com->description;
            // $i++;
            $result[] = array(
                'id' => $com['id_com'],
                'description' => $com['description'],
              );
        }
        echo json_encode($result);
        exit; 
        // return compact('com');
        return view('customer.getcommuner')->with(compact('com', 'customer'));
    }
}
