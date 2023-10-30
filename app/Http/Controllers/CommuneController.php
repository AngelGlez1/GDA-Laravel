<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Illuminate\Http\Request;
use Auth;
use App\Models\Region;
use Illuminate\Validation\Rule;

class CommuneController extends Controller
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
    public function index()
    {
        // $region = Region::find($commune->id_reg);
        $communes = Commune::paginate(5);
        return view('commune.index', compact('communes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $region = Region::all();
        return view('commune.create', compact('region'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Storing
        $commune = new Commune;
        $commune->id_com = $request->id_com;
        $commune->id_reg = $request->id_reg;
        $commune->description = $request->description;
        $commune->save();
        return redirect()->route('communes.index')
            ->with('success', 'The commune has been saved succes!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Commune $commune)
    {
        $region = Region::find($commune->id_reg);
        return view('commune.show')->with(compact('region', 'commune'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commune $commune)
    {
        $regiona = Region::all();
        $region = Region::find($commune->id_reg);
        return view('commune.edit', compact('commune', 'regiona', 'region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commune $commune)
    {
        $region = Region::find($request->id_reg);
        $commune->id_com = $request->id_com;
        $commune->id_reg = $request->id_reg;
        $commune->description = $request->description;
        $commune->save();
        return redirect()->route('communes.index')
            ->with('success', 'The commune has been saved succes!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commune $commune)
    {
        $commune->delete();
        return redirect()->route('communes.index')
            ->with('info', 'The commune has been deleted succes!');
    }
}
