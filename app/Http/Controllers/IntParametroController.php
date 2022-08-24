<?php

namespace App\Http\Controllers;

use App\Models\IntParametro;
use App\Http\Requests\StoreIntParametroRequest;
use App\Http\Requests\UpdateIntParametroRequest;
use Illuminate\Http\Request;

class IntParametroController extends Controller
{

    public function getParametro(){
        $parametro = IntParametro::select('inpContadorArticulo')->all()->first();
        return response()->json($parametro);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIntParametroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IntParametro  $intParametro
     * @return \Illuminate\Http\Response
     */
    public function show(IntParametro $intParametro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IntParametro  $intParametro
     * @return \Illuminate\Http\Response
     */
    public function edit(IntParametro $intParametro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIntParametroRequest  $request
     * @param  \App\Models\IntParametro  $intParametro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $parametros = IntParametro::where('inpId', $data['inpId'])
                    ->update([
                        'inpContadorArticulo' => $data['inpContadorArticulo']
                    ]);
        return response()->json($parametros);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IntParametro  $intParametro
     * @return \Illuminate\Http\Response
     */
    public function destroy(IntParametro $intParametro)
    {
        //
    }
}
