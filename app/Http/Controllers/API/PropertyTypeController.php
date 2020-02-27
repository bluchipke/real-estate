<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\PropertyType;
use Auth;
use DB;

class PropertyTypeController extends Controller
{
    public function __construct()
    {
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
        // $types = PropertyType::all();

        // return $types;
        // return PropertyType::orderBy('property_type_name', 'asc')->paginate(20);
        return DB::table('properties as p')
                ->rightJoin('property_types as pt', 'pt.property_type_id', '=', 'p.property_type_id')
                ->select('pt.property_type_id', 'pt.property_type_name', DB::raw('count(p.property_type_id) as all_units'))
                ->groupBy('pt.property_type_id', 'pt.property_type_name')
                ->orderBy('pt.property_type_name', 'asc')
                ->paginate(20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $type = $request
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
        $input = $request->all();
        $input['property_type_slug'] = Str::slug($request->property_type_name, '-');
        $type = PropertyType::create($input);

        return 1;
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
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $type = PropertyType::findOrFail($id);
        $input = $request->all();
        $input['property_type_slug'] = Str::slug($request->property_type_name, '-');

        $type->update($input);

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
        $type = PropertyType::findOrFail($id);
        $type->delete();
    }
}
