<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $us = Payment::join('tenants', 'payments.tenant_id', '=', 'tenants.tenant_id')
                        ->join('units', 'payments.unit_id', '=', 'units.unit_id')
                        ->join('properties', 'units.property_id', '=', 'properties.property_id')
                        ->orderBy('payments.payment_date', 'desc')
                        ->paginate(20);

                        return $us;
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
            'tenant_id' => 'required',
            'amount_paid' => 'required|min:0',
            'slip_no' => 'required',
            // 'payment_date' => 'required'
        ]);

        $input = $request->all();
        $input['tenant_id'] = $request->tenant_id['tenant_id'];
        $input['unit_id'] = $request->tenant_id['unit_id'];
        $pm = Payment::create($input);

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
