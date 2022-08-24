<?php

namespace App\Http\Controllers;

use App\Models\IntArticulo;
use App\Http\Requests\StoreIntArticuloRequest;
use App\Http\Requests\UpdateIntArticuloRequest;
use Inertia\Inertia;
use Illuminate\Http\Request;

class IntArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Articulo');
    }

    public function getAllArticulo(Request $request){
        $data = $request->all();
        $articulos = IntArticulo::where('artId', $data['query'])
                    ->orWhere('artNombre', 'LIKE', '%'.$data['query'].'%')->get();
        return response()->json(['articulos' => $articulos]);
    }

    public function getQueryArticulo(Request $request){
        $data = $request->all();
        $articulos = IntArticulo::select('artId','artNombre','artDescripcion','artPrecioVenta','artPrecioVentaDos','artPrecioVentaTres','artFraccionado')
                    ->where('artId', $data['query'])
                    ->orWhere('artNombre', 'LIKE', '%'.$data['query'].'%')->get();
        return response()->json($articulos);
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
     * @param  \App\Http\Requests\StoreIntArticuloRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $articulo = IntArticulo::create([
            "artNombre" => $data['artNombre'] == null ? "" : $data['artNombre'],
            "artDescripcion" => $data['artDescripcion'] == null ? "" : $data['artDescripcion'],
            "artPrecioVenta" => $data['artPrecioVenta'] == null ? "" : $data['artPrecioVenta'],
            "artPrecioVentaDos" => $data['artPrecioVentaDos'] == null ? "" : $data['artPrecioVentaDos'],
            "artPrecioVentaTres" => $data['artPrecioVentaTres'] == null ? "" : $data['artPrecioVentaTres'],
            "artFraccionado" => "N",
            "monId" => "BOL",
            "uniId" => "UNI",
            "resId" => "RESGEN",
            "artTipo" => "I",
            "artPropiedad" => "P",
            "artCalculoCosto" => "U",
            "artConvertirEnAF" => "N",
            "artDepreciable" => "S"
        ]);
        return response()->json($articulo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IntArticulo  $intArticulo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = $request->all();
        $articulo = IntArticulo::where('artId', $data['artId'])->first();
        return response()->json($articulo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IntArticulo  $intArticulo
     * @return \Illuminate\Http\Response
     */
    public function edit(IntArticulo $intArticulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIntArticuloRequest  $request
     * @param  \App\Models\IntArticulo  $intArticulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $articulo = IntArticulo::where('artId', $data['artId'])->update([
            "artNombre" => $data['artNombre'] == null ? "" : $data['artNombre'],
            "artDescripcion" => $data['artDescripcion'] == null ? "" : $data['artDescripcion'],
            "artPrecioVenta" => $data['artPrecioVenta'] == null ? "" : $data['artPrecioVenta'],
            "artPrecioVentaDos" => $data['artPrecioVentaDos'] == null ? "" : $data['artPrecioVentaDos'],
            "artPrecioVentaTres" => $data['artPrecioVentaTres'] == null ? "" : $data['artPrecioVentaTres'],
            "artFraccionado" => "N",
            "monId" => "BOL",
            "uniId" => "UNI",
            "resId" => "RESGEN"
        ]);
        return response()->json($articulo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IntArticulo  $intArticulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(IntArticulo $intArticulo)
    {
        //
    }
}
