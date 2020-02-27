<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tenant;
use App\Unit;
use App\TenantUnit;
use Auth;
use DB;
// use 
class TenantController extends Controller
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
        $tenant = Tenant::select(DB::raw('CONCAT(first_name, " ",last_name) AS tenant_name'), 'tenants.tenant_id', 'tenants.phone_number', 'tp.tenant_type_name', 'un.unit_number', 'pt.property_name', 'tenants.allocated')
                        ->leftJoin('units as un', 'tenants.unit_id', '=', 'un.unit_id')
                        ->leftJoin('properties as pt', 'tenants.property_id', '=', 'pt.property_id')
                        ->leftJoin('tenant_types as tp', 'tenants.tenant_type', '=', 'tp.tenant_type_id')
                        ->orderBy('first_name', 'asc')->paginate(20);

        return $tenant;
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'tenant_email' => 'required|email|unique:tenants,tenant_email',
            'tenant_type' => 'required'
        ]);
        $input = $request->all();

        $tenant = Tenant::create($input);

        return $tenant;
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
        $tenant = Tenant::join('tenant_types as tp', 'tenants.tenant_type', '=', 'tp.tenant_type_id')->where('tenants.tenant_id', '=', $id)->first();

        return $tenant;
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'tenant_email' => 'required|email|unique:tenants,tenant_email,'.$id.',tenant_id',
            'tenant_type' => 'required'
        ]);
        
        $tenant = Tenant::findOrFail($id);
        $input = $request->all();

        $update = $tenant->update($input);

        return $update;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function allocateUnit(Request $request)
    {
        $this->validate($request, [
            'tenant_id' => 'required|numeric',
            'property_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'occupation_date' => 'required',
            'deposit_amount' => 'required|numeric|min:0'
        ]);

        $lot = $request->all();
        $save = TenantUnit::create($lot);

        if($save)
        {
            $unit = Unit::findOrFail($request->unit_id);
            $unit->update([
                'vacant' => 0
            ]);

            $tenant = Tenant::findOrFail($request->tenant_id);
            $lot['allocated'] = 1;

            $tenant->update($lot);

            // return $unit;
        }
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function TenantUnit()
    {
        //
        $tenants = Tenant::select(DB::raw('CONCAT(tenants.first_name, " ",tenants.last_name, " - ", un.unit_number, ", ", pt.property_name ) AS tenant_name'), 'tenants.tenant_id', 'tenants.phone_number', 'tp.tenant_type_name', 'un.unit_id', 'un.unit_number', 'pt.property_name', 'tenants.allocated')
                        ->leftJoin('units as un', 'tenants.unit_id', '=', 'un.unit_id')
                        ->leftJoin('properties as pt', 'tenants.property_id', '=', 'pt.property_id')
                        ->leftJoin('tenant_types as tp', 'tenants.tenant_type', '=', 'tp.tenant_type_id')
                        ->orderBy('first_name', 'asc')->paginate(20);

        return $tenants;
    }
}
