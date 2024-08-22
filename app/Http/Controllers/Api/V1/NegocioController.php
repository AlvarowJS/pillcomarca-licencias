<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Negocio;
use Illuminate\Http\Request;

class NegocioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Negocio::with('subcategoria','administrado')->get();
        return response()->json($datos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $negocio = new Negocio;
        $negocio->nombrenegocio = $request->nombrenegocio;
        $negocio->ruc = $request->ruc;
        $negocio->direccion = $request->direccion;
        $negocio->metroscuadrados = $request->metroscuadrados;
        $negocio->monto=$request->monto;
        $negocio->nLicencia = $request->nLicencia;
        $negocio->nExpediente = $request->nExpediente;
        $negocio->fecha = $request->fecha;
        $negocio->subcategoria_id = $request->subcategoria_id;
        $negocio->administrado_id = $request->administrado_id;
        $negocio->save();

        return response()->json(['message'=>'El negocio fue correctamente gusrdado','data'=>$negocio],201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $datos=Negocio::find($id);
        if(!$datos){
            return response()->json(['message'=>'no se encontro el negocio buscado']);
        }
        return response()->json($datos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $negocio = Negocio::find($id);
        if(!$negocio){
            return response()->json(['message'=>'Negocio no encontrado'],404);
        }
        $negocio->nombrenegocio = $request->nombrenegocio;
        $negocio->ruc = $request->ruc;
        $negocio->direccion = $request->direccion;
        $negocio->metroscuadrados = $request->metroscuadrados;
        $negocio->nLicencia = $request->nLicencia;
        $negocio->nExpediente = $request->nExpediente;
        $negocio->fecha = $request->fecha;
        $negocio->subcategoria_id = $request->subcategoria_id;
        $negocio->administrado_id = $request->administrado_id;
        $negocio->save();

        return response()->json($negocio);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $datos = Negocio::find($id);
        if(!$datos){
            return response()->json(['message'=>'Negocio no encontrado'],404);
        }
        $datos->delete();
        return response()->json(['message'=>'Negocio Eliminado']);
    }
}
