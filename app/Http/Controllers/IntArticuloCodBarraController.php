<?php

namespace App\Http\Controllers;

use App\Models\IntArticuloCodBarra;
// use App\Http\Requests\StoreIntArticuloCodBarraRequest;
// use App\Http\Requests\UpdateIntArticuloCodBarraRequest;
use Illuminate\Http\Request;

class IntArticuloCodBarraController extends Controller
{
    public function getArticuloCodBarra(Request $request){
        $data = $request->all();
        $codigos = IntArticuloCodBarra::select('tadId','artId','codBarra')->where('codBarra', $data['codBarra'])->first();
        return response()->json($codigos);
    }

    public function getArticulosCodsBarras(Request $request){
        $data = $request->all();
        $codigos = IntArticuloCodBarra::select('tadId','artId','codBarra')->where('artId', $data['artId'])->get();
        return response()->json($codigos);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $existencia = IntArticuloCodBarra::create([
            "artId" => $data['artId'],
            "codBarra" => $data['codBarra'],
            "cbHabilitado" => "S",
            "cbFechaCreacion" => date("Y-m-d\TH:i:s.000"),
            "acbUsuarioCreacion" => "novusers"
        ]);
        return response()->json($existencia);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IntArticuloCodBarra  $intArticuloCodBarra
     * @return \Illuminate\Http\Response
     */

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
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IntArticuloCodBarra  $intArticuloCodBarra
     * @return \Illuminate\Http\Response
     */
    public function edit(IntArticuloCodBarra $intArticuloCodBarra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIntArticuloCodBarraRequest  $request
     * @param  \App\Models\IntArticuloCodBarra  $intArticuloCodBarra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $existencia = IntArticuloCodBarra::where('tadId',$data['tadId'])->update([
            "codBarra" => $data['codBarra'],
            "cbFechaCreacion" => date("Y-m-d\TH:i:s.000")
        ]);
        return response()->json($existencia);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IntArticuloCodBarra  $intArticuloCodBarra
     * @return \Illuminate\Http\Response
     */
    public function destroy(IntArticuloCodBarra $intArticuloCodBarra)
    {
        //
    }
}