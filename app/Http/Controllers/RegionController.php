<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\Rule;

class RegionController extends Controller
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
        $regions = Region::paginate(5);
        return view('region.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('region.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $commune = new Region;
        $commune->id_reg = $request->id_reg;
        $commune->description = $request->description;
        $commune->save();
        return redirect()->route('regions.index')
            ->with('success', 'The region has been saved succes!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {  
        return view('region.show')->with(compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        return view('region.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Region $region)
    {
        $region->id_reg = $request->id_reg;
        $region->description = $request->description;
        $region->save();
        return redirect()->route('regions.index')
            ->with('success', 'The region has been saved succes!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('regions.index')
            ->with('info', 'The commune has been deleted succes!');
    }
}
