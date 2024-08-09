<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios=User::all();
        if($usuarios->isEmpty()){
            return response()->json(['message'=>'usuarios no encontrados'],Response::HTTP_NOT_FOUND);
        }
        return response()->json($usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validaData = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:8', 
            
        ]);

        $user=User::create([
            'name'=>$validaData['name'],
            'email'=>$validaData['email'],
            'password'=>Hash::make($validaData['password']),
            'role_id'=>$request->role_id,
            'status'=>true
        ]);

        return response()->json([
            'message'=>'Usuario creado exitosamente.',
            'user'=>$user,
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $datos=User::find($id);
        if(!$datos){
            return response()->json(['message'=>'Registro no encontrado'],Response::HTTP_NOT_FOUND);
        }
        return response()->json($datos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $user=User::find($id);
        if(!$user){
            return response()->json(['message'=>'usuario no encontrado'],404);
        }
        $user->name=$request->name;
        $user->email=$request->email;
        $user->role_id=$request->role_id;
        $user->status = $request->status;
        $user->password =Hash::make($request->password);
        $user->save();

        return response()->json($user);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $datos=User::find($id);
        if(!$datos){
            return response()->json(['message'=>'Usuario no encontrado'],404);
        }
        $datos->delete();
        return response()->json(['message'=>'Usuario Eliminado']);
    }

    public function login(Request $request){
        $request ->validate([
            'email'=>'required|email',
            'password'=>'required|string',
        ]);
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            $user=Auth::user();
            $name=$user->name;
            $token = $user->createToken('api_token')->plainTextToken;
            return response()->json([
                'api_token'=>$token,
                'name'=>$name,
                'rol'=>$user->role_id
            ],200);
        }else{
            return response()->json(['message'=>'Invalidid Credentials'],401);
        }
    }

    public function authToken(Request $request)
    {
    $user = Auth::user();
    if (!$user) {
        return response()->json(['message' => 'Usuario no autenticado'], 401);
    }

    $token = $request->header('Authorization');
    $rol = $user->role ? $user->role->role_number : null;
    $user->role = $rol;
    $user->token = $token;

    return response()->json($user);
    }


}
