<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitadoController extends Controller
{
    public function index() : View{
        $cliente = Auth::user()->cliente;
        $visitados = $cliente->visitados()->paginate(8);

        return view('cliente.visitado.index', compact('visitados'));
    }
}
