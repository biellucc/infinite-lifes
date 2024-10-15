<?php

namespace App\Http\Controllers;

use App\Models\Dimensao;
use App\Models\Genero;
use App\Models\Livro;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $vendedor = Auth::user()->vendedor;
        $livros = $vendedor->livros()->paginate(16);
        return view('vendedor.estoque.index', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function formulario()
    {
        $dimensoes = Dimensao::all();
        $generos = Genero::all();
        return view('vendedor.estoque.formulario.store', compact('dimensoes', 'generos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataAtual = Carbon::now();
        $request->validate([
            'titulo' => ['required', 'string', 'max:100'],
            'resumo' => ['required', 'string', 'max:200'],
            'quantidade_paginas' => ['required', 'integer', 'min:1'],
            'autor' => ['required', 'string', 'max:100'],
            'estoque' => ['required', 'integer', 'min:1'],
            'valor' => ['required', 'numeric', 'min:1'],
            'imagem' => ['required', 'image', 'mimes:jpeg,jpg,png'],
            'isbn13' => ['required', 'string', 'regex:/^(97)[8-9]-[0-9]{2}-[0-9]{6}-[0-9]-[0-9]$/'],
            'idioma' => ['required', 'string', 'max:100'],
            'edicao' => ['required', 'integer', 'min:1'],
            'editora' => ['required', 'string', 'max:80'],
            'idade' => ['required', 'integer', 'min:5', 'max:18'],
            "data_publicacao" => ['required', 'date', 'before_or_equal: ' . $dataAtual]
        ]);

        // Obtenha a instância da imagem
        $imagem = $request->file('imagem');

        // Gere um nome único para a imagem
        $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension();

        // Mova a imagem para a pasta public/assets/imagem
        $imagem->move(public_path('assets/livro/imagem'), $nomeImagem);

        $vendedor = Auth::user()->vendedor;
        $livro = $vendedor->livros()->create([
            'titulo' => $request->titulo,
            'resumo' => $request->resumo,
            'quantidade_paginas' => $request->quantidade_paginas,
            'autor' => $request->autor,
            'estoque' => $request->estoque,
            'valor' => $request->valor,
            'isbn13' => $request->isbn13,
            'idioma' => $request->idioma,
            'edicao' => $request->edicao,
            'editora' => $request->editora,
            'idade' => $request->idade,
            "data_publicacao" => $request->data_publicacao,
            "imagem" => $nomeImagem,
            'dimensao_id' => $request->dimensao,
            "genero_id" => $request->genero
        ]);

        return redirect(route('livro.livro', [$livro->titulo, $livro->id]));
    }

    /**
     * Display the specified resource.
     */
    public function livro(string $titulo = null, string $id): View
    {
        $livro = Livro::find($id);
        return view('vendedor.estoque.livro', compact('livro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function formulario_atualizar(string $id)
    {
        $livro = Livro::find($id);
        $dimensoes = Dimensao::all();
        $generos = Genero::all();
        return view('vendedor.estoque.formulario.atualizar', compact('dimensoes', 'generos', 'livro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function atualizar(Request $request, string $id)
    {
        $dataAtual = Carbon::now();
        $request->validate([
            'titulo' => ['required', 'string', 'max:100'],
            'resumo' => ['required', 'string', 'max:200'],
            'quantidade_paginas' => ['required', 'integer', 'min:1'],
            'autor' => ['required', 'string', 'max:100'],
            'estoque' => ['required', 'integer', 'min:1'],
            'valor' => ['required', 'numeric', 'min:1'],
            'imagem' => ['required', 'image', 'mimes:jpeg,jpg,png'],
            'isbn13' => ['required', 'string', 'regex:/^(97)[8-9]-[0-9]{2}-[0-9]{6}-[0-9]-[0-9]$/'],
            'idioma' => ['required', 'string', 'max:100'],
            'edicao' => ['required', 'integer', 'min:1'],
            'editora' => ['required', 'string', 'max:80'],
            'idade' => ['required', 'integer', 'min:5', 'max:18'],
            "data_publicacao" => ['required', 'date', 'before_or_equal: ' . $dataAtual]
        ]);

        $livro = Livro::find($id);
        Storage::delete($livro->imagem);
        $imagem = $request->file('imagem');
        $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension();
        $imagem->move(public_path('assets/livro/imagem'), $nomeImagem);
        $inputs = $request->except(['_token', '_method']);
        foreach ($inputs as $input => $valor) {
            $livro->input = $valor;
        }
        $livro->imagem = $nomeImagem;
        $livro->save();

        return redirect(route('livro.livro', [$livro->titulo, $livro->id]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletar(string $id)
    {
        $livro = Livro::Find($id);
        $livro->status = 0;
        $livro->save();

        return redirect(route('estoque.index'));
    }
}
