<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Bill;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $b = Bill::join('providers', 'bills.provider_id', '=', 'providers.provider_id')
                    ->leftJoin('properties', 'bills.property_id', '=', 'properties.property_id')
                    ->leftJoin('units', 'bills.unit_id', '=', 'units.unit_id')
                    ->orderBy('bills.created_at', 'desc')->paginate(20);

        return $b;
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
            'bill_desc' => 'required',
            'bill_amount' => 'required',
            'bill_date' => 'required'
        ]);

        $input = $request->all();
        $input['property_id'] = $request->property_name['property_id'];
        $input['unit_id'] = $request->unit_number['unit_id'];
        $input['provider_id'] = $request->provider_name['provider_id'];
        // $input['bill_code'] = str_pad()

        // return $input;
        $create = Bill::create($input);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
