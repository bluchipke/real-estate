<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Provider;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $provider = Provider::orderBy('created_at', 'desc')->where('active', '=', 1)->paginate(20);

        return $provider;
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
            'provider_name' => 'required',
            'provider_email' => 'required',
            'phone_no' => 'required'

        ]);

        $input = $request->all();

        $provider = Provider::create($input);
        if($provider)
        {
            return ['message' => 'Provider created successfully'];
        }else{
            return ['message' => 'Provider failed to create'];
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
            'provider_name' => 'required',
            'provider_email' => 'required',
            'phone_no' => 'required'

        ]);

        $update = $request->all();
        $provider = Provider::findOrFail($id);

        $s = $provider->update($update);
        if($s){
            return ['message' => 'Update successful'];
        }else{
            return ['message' => 'Update failed'];
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
        $provider = Provider::findOrFail($id);

        $p = $provider->delete();
        if($p){
            return ['message' => 'Item deletion was successful'];
        }else{
            return ['message' => 'Item deletion failed. Try again'];
        }
    }
}
