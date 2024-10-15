<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Cartao;
use App\Models\Favorito;
use App\Models\Livro;
use App\Models\Pedido;
use App\Models\User;
use App\Services\criptografiaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->cliente) {
            $cliente = Auth::user()->cliente;
            $pedidos = $cliente->pedidos()->paginate(8);
            return view('cliente.pedido.index', compact('pedidos'));
        } else if (Auth::user()->transportadora) {
            $transportadora = Auth::user()->transportadora;
            $pedidos = $transportadora->pedidos()->get();
            return view('transportadora.pedido.index', compact('pedidos'));
        }

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $cliente = Auth::user()->cliente;
        $cartoes = Cartao::where('status', 1)->where('cliente_id', $cliente->id)->get();
        foreach ($cartoes as $cartao) {
            $criptografiaService = new criptografiaService();
            $criptografiaService->descriptografarCartao($cartao);
        }
        if ($request->input('tipo_id') == 'carrinho') {
            $carrinho = Carrinho::find($request->id);
        } else {
            $carrinho = $cliente->carrinhos()->create();
            if ($request->input('tipo_id') == 'livro') {
                $livro = Livro::find($request->livro_id);
                $carrinho->livros()->attach($livro->id);
            } elseif ($request->input('tipo_id') == 'favoritos') {
                $favoritos = $cliente->favoritos()->get();
                foreach ($favoritos as $favorito)
                    $carrinho->livros()->attach($favorito->livro_id);
            }
            //dd($carrinho, $carrinho->livros, $favoritos);
            return view('cliente.pedido.formulario', compact(['carrinho', 'cartoes']));
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'valor' => ['required', 'numeric'],
            'nome' => ['required', 'string', 'max:50'],
            'sobrenome' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'telefone' => ['required', 'string', 'max:17', 'regex:/^[0-9]{2} [0-9]{2} [0-9]{5}-[0-9]{4}$/'],
            'cep' => ['required', 'string', 'max:10', 'regex:/^[0-9]{5}-[0-9]{3}$/'],
            'pais' => ['required', 'string', 'max:90'],
            'estado' => ['required', 'string', 'max:90'],
            'cidade' => ['required', 'string', 'max:90'],
            'bairro' => ['required', 'string', 'max:90'],
            'endereco' => ['required', 'string', 'max:90'],
            'complemento' => ['required', 'string'],
        ]);

        $cliente = Auth::user()->cliente;
        $usuario = $cliente->usuario;
        $endereco = $usuario->endereco;

        $input = $request->only(['nome', 'sobrenome']);
        foreach ($input as $key => $value) {
            $cliente->$key = $value;
        }
        $cliente->save();

        $input = $request->only(['email', 'telefone']);
        foreach ($input as $key => $value) {
            $usuario->$key = $value;
        }
        $usuario->save();

        $input = $request->only(['cep', 'pais', 'estado', 'cidade', 'bairro', 'endereco', 'complemento']);
        foreach ($input as $key => $value) {
            $endereco->$key = $value;
        }
        $endereco->save();

        $pedido = $cliente->pedidos()->create([
            'carrinho_id' => $request->carrinho_id,
            'cartao_id' => $request->cartao,
            'valor' => $request->valor
        ]);

        $carrinho = Carrinho::find($request->carrinho_id);
        $carrinho->status = 0;
        $carrinho->save();

        return redirect(route('pedido.pedido', $pedido->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->cliente) {
            $pedido = Auth::user()->cliente->pedidos()->firstWhere('id', $id);
            return view('cliente.pedido.pedido', compact('pedido'));
        } elseif (Auth::user()->transportadora) {
            $pedido = Auth::user()->transportadora->pedidos()->firstWhere('id', $id);
            return view('transportadora.pedido.pedido', compact('pedido'));
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editar(Request $request, string $id)
    {
        $pedido = Pedido::find($id);
        $pedido->status = $request->status;
        $pedido->save();

        return redirect(route('pedido.pedido', $id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
