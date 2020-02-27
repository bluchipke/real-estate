<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Payable;

class PayableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $c = Payable::join('bills', 'payables.bill_id', '=', 'bills.bill_id')
                    ->join('providers', 'payables.provider_id', '=', 'providers.provider_id')
                    ->orderBy('payables.created_at', 'desc')
                    ->paginate(20);

                    return $c;
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
            'amount_paid' => 'required',
            'reference' => 'required',
            'trans_date' => 'required'
        ]);

        $input = $request->all();
        $input['bill_id'] = $request->bill_desc['bill_id'];
        $input['provider_id'] = $request->provider_name['provider_id'];
        $save = Payable::create($input);

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
