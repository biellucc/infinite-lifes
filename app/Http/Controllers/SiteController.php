<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function site(){
        $livros = Livro::join('vendedor', 'livro.vendedor_id', '=', 'vendedor.id')
                ->join('users', 'vendedor.user_id', '=', 'users.id')
                ->where('users.status', 1)
                ->select('livro.*')
                ->orderBy('livro.updated_at', 'desc')
                ->paginate(12);
        return view('site.welcome', compact('livros'));
    }

    public function livro($titulo = null ,$id): View {
        $livro = Livro::find($id);
        if(Auth::check() && Auth::user()->cliente){
            $cliente = Auth::user()->cliente;
            $cliente->visitados()->create([
                'livro_id' => $livro->id
            ]);
        }

        $comentarios = $livro->comentarios()->get();

        return view('site.livro', compact(['livro', 'comentarios']));
    }

    public function pesquisar(Request $request) {
        $request->validate([
            'pesquisar' => 'required|string|min:1'
        ]);

        $livros = Livro::where('titulo', 'LIKE', "%{$request->pesquisar}%")
            ->orderBy('titulo', 'DESC')
            ->paginate(12);
        return view('site.pesquisa', compact('livros'));
    }
}
