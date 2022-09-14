<?php

namespace App\Http\Controllers;

use App\Models\IntExistencia;
// use App\Http\Requests\StoreIntExistenciaRequest;
// use App\Http\Requests\UpdateIntExistenciaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class IntExistenciaController extends Controller
{
    public function getExistencia(Request $request){
        $data = $request->all();
        // $existencia = IntExistencia::select('almId','artId','exiExistencia')->where('artId', $data['artId'])->get();
        $existencia = DB::table('intExistencia as e')
                    ->join('intAlmacen as a', 'e.almId', '=', 'a.almId')
                    ->select('a.almId','e.artId','e.exiExistencia', 'a.almNombre')
                    ->where('artId', $data['artId'])->get();
        return response()->json($existencia);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $exi = new IntExistencia;
        $exi->almId = $data['almId'] == null ? "ALMCEN" : $data['almId'];
        $exi->artId = $data['artId'] == null ? "1000" : $data['artId'];
        $exi->exiExistencia = $data['exiExistencia'];
        $exi->save();

        // $existencia = IntExistencia::create([
        //     "almId" => $data['almId'],
        //     "artId" => $data['artId'],
        //     "exiExistencia" => $data['exiExistencia'],
        // ]);
        return response()->json($exi);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIntExistenciaRequest  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IntExistencia  $intExistencia
     * @return \Illuminate\Http\Response
     */
    public function show(IntExistencia $intExistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IntExistencia  $intExistencia
     * @return \Illuminate\Http\Response
     */
    public function edit(IntExistencia $intExistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIntExistenciaRequest  $request
     * @param  \App\Models\IntExistencia  $intExistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $existencia = IntExistencia::where('almId',$data['almId'])->where('artId',$data['artId'])->update([
            "exiExistencia" => $data['exiExistencia'],
        ]);
        return response()->json($existencia);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IntExistencia  $intExistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(IntExistencia $intExistencia)
    {
        //
    }
}