<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SubCategoria;
use Illuminate\Http\Request;

class SubCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Subcategoria::with('categoria')->get();
        return response()->json($datos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subCategoria = new SubCategoria;
        $subCategoria-> rubro = $request->rubro;
        $subCategoria->categoria_id = $request->categoria_id;
        $subCategoria->save();

        return response()->json(['message'=>'la sub categoria fue creada','data'=>$subCategoria],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $datos=SubCategoria::find($id);
        if(!$datos){
            return response()->json(['message'=>'no se encontro la subcategoria']);
        }
        return response()->json($datos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $subCategoria = SubCategoria::find($id);
        if(!$subCategoria){

            return response()->json(['messge'=>'SubCategoria no encontrada'],404);
        }
        $subCategoria->rubro=$request->rubro;
        $subCategoria->save();

        return response()->json($subCategoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $datos = SubCategoria::find($id);
        if(!$datos){
            return response()->json(['message'=>'SubCategoria no encontrada'],404);
        }
        $datos->delete();
        return response()->json(['message'=>'Subcategoria eliminada']);
    }
}
