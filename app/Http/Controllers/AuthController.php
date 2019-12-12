<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
   public function login()
   {
       $credentials = request(['email','password']);
       if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['ok' => false, 'msg'=>'Credenciais Inválidas.']);
       }
       return response()->json([
           'token' => $token,
           'user' => Auth::user(),
           'ok'=>true
       ], 200);
   }

   public function register(Request $request)
   {
    $resp = ['ok' => false, 'msg' => 'Erro ao cadastrar usuário.'];
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    if ($user->save()) {
        $resp = ['ok' => true, 'msg' => "Usuário cadastrado com sucesso."];
    }
    return response()->json($resp, $resp['ok'] ? 200 : 500);
   }
   

}
