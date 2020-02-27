<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Landlord;
Use Auth;
use DB;

class LandlordController extends Controller
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
        $landlord = Landlord::leftJoin('properties as pt', 'landlords.landlord_id', '=', 'pt.landlord_id')
                            ->select('landlords.landlord_id', DB::raw('CONCAT(landlords.first_name, " ",landlords.last_name) AS landlord_name'), 'landlords.phone_number', 'landlords.email_address', 'landlords.postal_code', 'landlords.postal_address', DB::raw('count(pt.landlord_id) as ls'))
                            ->groupBy('landlords.landlord_id', 'landlords.first_name', 'landlords.last_name', 'landlords.phone_number', 'landlords.email_address', 'landlords.postal_code', 'landlords.postal_address')
                            ->orderBy('first_name', 'asc')
                            ->paginate(20);

        return $landlord;
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
            'email_address' => 'required|email|unique:landlords,email_address',
            'phone_number' => 'required'
        ]);

        $input = $request->all();
        $landlord = Landlord::create($input);

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
        $landlord = Landlord::findOrFail($id);

        return $landlord;
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
            'email_address' => 'required|email|unique:landlords,email_address,'.$id.',landlord_id',
            'phone_number' => 'required'
        ]);

        $ld = Landlord::findOrFail($id);

        $update = $request->all();
        $save = $ld->update($update);

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
}
