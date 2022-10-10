<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'person_type_id' => 'required|unique_with:users,document_value',
            'document_value' => 'required',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error al registrar al usuario',
                'errors' => $validator->errors(),
            ]);
        }
    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->person_type_id = $request->person_type_id;
        $user->document_value = $request->document_value;
    
        if($user->save()) {
            $token = $user->createToken('auth_token')->plainTextToken;
    
            $role = $request->person_type_id == 3 ? 'arrendatario' : 'arrendador';
            $user->assignRole($role);
    
            return response()->json([
                'message' => 'Usuario registrado correctamente',
                'user' => $user->load('personType'),
                'token' => $token
            ]);
        }
    
        return response()->json([
            'message' => 'Registro de usuario incorrecto',
        ]);
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 0,
                'message' => 'Inicio de sesión incorrecto'
            ]);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 1,
            'message' => 'Inicio de sesión correcto',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function profile()
    {
        return response()->json([
            'message' => 'Perfil del usuario',
            'user' => auth()->user()->load('personType'),
            'roles' => auth()->user()->getRoleNames()
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Sesión finalizada'
        ]);
    }
}
