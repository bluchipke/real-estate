<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\WorkOrder;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $wo = WorkOrder::join('providers', 'work_orders.provider_id', '=', 'providers.provider_id')->orderBy('work_orders.created_at', 'desc')->paginate(20);

        return $wo;
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
            'work_order' => 'required',
            // 'provider_id' => 'required'
        ]);

        $input = $request->all();
        $input['provider_id'] = $request->provider_name['provider_id'];

        $save = WorkOrder::create($input);

        if($save){
            return ['message'=>'Work order saved.'];
        }else{
            return ['message'=>'Work order failed to save'];
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
        $wo = WorkOrder::findOrFail($id);

        return $wo;
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
            'work_order'=>'required',
            'provider_id' => 'required'
        ]);

        $wo = WorkOrder::findOrFail($id);

        $update = $request->all();
        $update['provider_id'] = $request->provider_name['provider_id'];
        $save = $wo->update($update);

        if($save){
            return ['message'=>'Work order updated.'];
        }else{
            return ['message'=>'Work order failed to update'];
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
        $wo = WorkOrder::findOrFail($id);

        $d = $wo->delete();

        if($d){
            return ['message'=>'Work order deleted.'];
        }else{
            return ['message'=>'Work order failed to delete'];
        }
    }
}
