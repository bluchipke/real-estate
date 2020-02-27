<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ServiceCharge;

class ServiceChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sc = ServiceCharge::orderBy('created_at')->paginate(20);

        return $sc;
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
            'service_charge' => 'required'
        ]);

        $input = $request->all();
        $save = ServiceCharge::create($input);

        if($save){
           return ['message' => 'Service charge created.'];
        }else{
            return ['message' => 'Service charge failed to create.'];
        }
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
        $sc = ServiceCharge::findOrFail($id);

        return $sc;
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
        $sc = ServiceCharge::findOrFail($id);

        $this->validate($request, [
            'service_charge' => 'required'
        ]);

        $input = $request->all();

        $save = $sc->update($input);

        if($save){
            return ['message' => 'Service charge created.'];
         }else{
             return ['message' => 'Service charge failed to create.'];
         }
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

        $sc = ServiceCharge::findOrFail($id);

        $sc->delete();
    }
}
