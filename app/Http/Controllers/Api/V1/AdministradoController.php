<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Administrado;
use Illuminate\Http\Request;

class AdministradoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Administrado::all();
        return response()->json($datos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /**$validarData = $request -> validar([
            'nombreadministrado'=>'required|string|max:255',
            'apellidoadministrado'=> 'required|string|max:255',
            'numero'=>'required|string|max:9',
            'dni'=> 'required|string|max:8',
            'ruc'=>'required|string|max:11',
            'gmail'=>'required|email|max:255',
        ]);**/

        $administrado = new Administrado;
        $administrado->nombreadministrado = $request->nombreadministrado;
        $administrado->apellidoadministrado = $request->apellidoadministrado;
        $administrado->numero = $request-> numero;
        $administrado->dni = $request->dni;
        $administrado->ruc = $request->ruc;
        $administrado->gmail = $request->gmail;
        $administrado -> save();

        return response()->json(['message'=>'El Administrado fue creado correctamente','data'=>$administrado],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $datos = Administrado::find($id);
        if(!$datos){

            return response()->json(['message'=>'no se encontro el Administrado']);
        }

        return response()->json($datos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $administrado = Administrado::find($id);
        if(!$administrado){
            return response()->json(['message'=>'Administrador no encontrado'],404);
        }

        $administrado->nombreadministrado = $request->nombreadministrado;
        $administrado->apellidoadministrado = $request->apellidoadministrado;
        $administrado->numero = $request->numero;
        $administrado->dni = $request->dni;
        $administrado->ruc = $request->ruc;
        $administrado->gmail = $request->gmail;
        $administrado->save();

        return response()->json($administrado);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $datos = Administrado::find($id);
        if(!$datos){
            return response()->json(['message','Administrado no encontrado'],404);
        }
        $datos ->delete();
        return response()->json(['messge'=>'Administrado Eliminado']);
    }
}
