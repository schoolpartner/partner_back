<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
class MateriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
   public function listMaterias()
   {
     $materias = Materia::all();

     return response()->json($materias,200);
   }
}
