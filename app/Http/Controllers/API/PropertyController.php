<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Property;
use App\Unit;
use Illuminate\Support\Str;
use Auth;
// use App

class PropertyController extends Controller
{

    public function __construct(){

        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Property::join('landlords', 'properties.landlord_id', '=', 'landlords.landlord_id')
                        ->join('property_types as pt', 'properties.property_type_id', '=', 'pt.property_type_id')
                        ->join('locations as lc', 'properties.location_id', '=', 'lc.location_id')
                        ->join('estates as es', 'properties.estate_id', '=', 'es.estate_id')
                        ->orderBy('properties.property_name', 'asc')
                        ->paginate(20);

        // return $props;
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'property_name' => 'required',
            'location_id' => 'required',
            'estate_id' => 'required',
            'property_type_id' => 'required'
        ]);
        $input = $request->all();
        $input['property_slug'] = Str::slug($request->property_name);

        $save = Property::create($input);

        return $save;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $property = Property::join('landlords', 'properties.landlord_id', '=', 'landlords.landlord_id')
                            ->join('property_types as pt', 'properties.property_type_id', '=', 'pt.property_type_id')
                            ->join('locations as lc', 'properties.location_id', '=', 'lc.location_id')
                            ->join('estates as es', 'properties.estate_id', '=', 'es.estate_id')
                            ->where('properties.property_id', '=', $id)
                            ->first();        

        return $property;
    }

   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'property_name' => 'required',
            'location_id' => 'required',
            'estate_id' => 'required',
            'property_type_id' => 'required'
        ]);

        $update = $request->all();
        $update['property_slug'] = Str::slug($request->property_name);
        $property = Property::findOrFail($id);

        $property->update($update);

        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function vacantUnits($id)
    {
        // 
        return Unit::where('property_id', '=', $id)->where('vacant', '=', 1)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function propertyUnits($id)
    {
        return Unit::leftJoin('tenants as ts', 'units.unit_id', '=', 'ts.unit_id')
                ->select('units.*', 'ts.first_name as first_name, ts.last_name as last_name')
                ->where('units.property_id', '=', $id)
                ->orderBy('unit_number', 'asc')->paginate(50);
    }
}
