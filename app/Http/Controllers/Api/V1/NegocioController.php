<?php

namespace App\Http\Controllers\Api\V1;

use App\Exports\NegociosExport;
use App\Http\Controllers\Controller;
use App\Models\ActividadEconomica;
use App\Models\Negocio;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NegocioController extends Controller
{

    public function indexActividad(){
        $datos = ActividadEconomica::all();
        return response()->json($datos);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Negocio::with('subcategoria','administrado','actividad_economica')->get();
        return response()->json($datos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $carpeta = "negocio";
        $ruta = public_path($carpeta);
        if(!\File::isDirectory($ruta)){
            $publicPath = 'storage/' . $carpeta;
            \File::makeDirectory($publicPath,0777,true,true);
        }
        $files = $request->file('imagen');

        $negocio = new Negocio;

        if($request->hasFile('imagen')){
            $nombre = uniqid() . '.' . $files->getClientOriginalName();
            $path = $carpeta . '/' . $nombre;
            \Storage::disk('public')->put($path, \File::get($files));
            $negocio->imagen = $nombre;

        }

        $negocio->nombrenegocio = $request->nombrenegocio;
        $negocio->ruc = $request->ruc;
        $negocio->direccion = $request->direccion;
        $negocio->metroscuadrados = $request->metroscuadrados;
        $negocio->monto=$request->monto;
        $negocio->nLicencia = $request->nLicencia;
        $negocio->nExpediente = $request->nExpediente;
        $negocio->lugar = $request->lugar;
        $negocio->manzana = $request->manzana;
        $negocio->lote = $request->lote;
        $negocio->fecha = $request->fecha;
        $negocio->razonsocial = $request->razonsocial;
        $negocio->redsocial = $request->redsocial;
        $negocio->publico = $request->publico ? 1 : 0 ;
        $negocio->subcategoria_id = $request->subcategoria_id;
        $negocio->administrado_id = $request->administrado_id;
        $negocio->actividad_economica_id = $request->actividad_economica_id;
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
        $carpeta = "negocio";
        $id = $request->id;
        $negocio = Negocio::find($id);

        $negocio = Negocio::find($id);
        if(!$negocio){
            return response()->json(['message'=>'Negocio no encontrado'],404);
        }

        if ($request->hasFile('imagen')){
            $nombreArchivo = $negocio -> imagen;
            $files = $request->file('imagen');

            \Storage::disk('public')->delete($carpeta . '/' . $nombreArchivo);
            $nombreNuevo = uniqid() . '.' . $files->getClientOriginalName();
            $pathNuevo = $carpeta . '/' . $nombreNuevo;
            \Storage::disk('public')->put($pathNuevo, \File::get($files));
            $negocio->imagen =  $nombreNuevo;
        }



        $negocio->nombrenegocio = $request->nombrenegocio;
        $negocio->ruc = $request->ruc;
        $negocio->direccion = $request->direccion;
        $negocio->metroscuadrados = $request->metroscuadrados;
        $negocio->nLicencia = $request->nLicencia;
        $negocio->nExpediente = $request->nExpediente;
        $negocio->fecha = $request->fecha;
        $negocio->lugar = $request->lugar;
        $negocio->manzana = $request->manzana;
        $negocio->lote = $request->lote;
        $negocio->razonsocial = $request->razonsocial;
        $negocio->redsocial = $request->redsocial;
        $negocio->publico = $request->publico ? 1 : 0;
        $negocio->subcategoria_id = $request->subcategoria_id;
        $negocio->administrado_id = $request->administrado_id;
        $negocio->actividad_economica_id = $request->actividad_economica_id;
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

    public function exportar($id)
    {
        $negocio = Negocio::with('subcategoria', 'administrado', 'actividad_economica')->find($id);

        if (!$negocio) {
        return response()->json(['message' => 'Negocio no encontrado'], 404);
        }

    return Excel::download(new NegociosExport($negocio), 'certificado.xlsx');
    }

    public function buscar()
    {   
        
        $query= Negocio::with('subcategoria','administrado','actividad_economica');



        if(request()->filled('nombrenegocio')){
            $nombrenegocio = request()->input('nombrenegocio');
            $query->where(function ($q) use ($nombrenegocio){
                $q->where('nombrenegocio','like','%' . $nombrenegocio . '%');
            });
        }

        if(request()->filled('subcategoria_id')){
            $query->where('subcategoria_id', request()->input('subcategoria_id'));
        }

        $datos = $query ->paginate(10);

        return $datos;

    }

}
