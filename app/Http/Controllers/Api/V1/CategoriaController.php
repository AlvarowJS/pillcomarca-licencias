<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Categoria::all();
        return response()->json($datos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*$validarData = $request -> validar([
            'nombrecategoria' =>'required|string|max:255',

        ]);*/

        $categoria = new Categoria;
        $categoria -> nombrecategoria = $request->nombrecategoria;
        $categoria -> save();

        return response()->json(['message'=>'La categoria fue creado correctamente','data'=>$categoria],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $datos=Categoria::find($id);
        if(!$datos){

            return response()->json(['message'=>'no se encontro la categoria']);
        }
        return response()->json($datos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        if(!$categoria){

            return response()->json(['message'=>'categoria no encontrada'],404);
        }

        $categoria->nombrecategoria = $request->nombrecategoria;
        $categoria->save();

        return response()-> json($categoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $datos = Categoria::find($id);
        if(!$datos){
            return response()->json(['message'=>'Categoria no encontrada'],404);
        }
        $datos->delete();
        return response()->json(['message'=>'categoria eliminada']);
    }
}
