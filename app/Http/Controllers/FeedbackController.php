<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class FeedbackController extends Controller
{
    public function index(): View
    {

        if (Auth::user()->cliente) {
            $cliente = Auth::user()->cliente;
            $feedbacks = $cliente->usuario->feedbacks()->orderBy('updated_at','desc')->orderBy('created_at', 'desc')->get();
        }

        return view('feedback.index', compact('feedbacks'));
    }

    public function store(Request $request) : RedirectResponse{
        $request->validate([
            'titulo' => ['required', 'string'],
            'corpo' => ['required', 'string']
        ]);

        $usuario = Auth::user();
        $usuario->feedbacks()->create([
            'titulo' => $request->titulo,
            'corpo' => $request->corpo
        ]);
        return redirect(route('feedback.index'));
    }
}
