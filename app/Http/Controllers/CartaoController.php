<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Cartao;
use App\Services\criptografiaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PhpParser\Node\Stmt\Return_;

class CartaoController extends Controller
{

    public function index(): View
    {
        $cliente = Auth::user()->cliente;
        $cartoes = Cartao::where('status', 1)->where('cliente_id', $cliente->id)->paginate(8);
        $criptografiaService = new criptografiaService();

        if($cartoes->isNotEmpty()){
            foreach ($cartoes as $cartao){
                $criptografiaService->descriptografarCartao($cartao);
            }
        }
        return view('cliente.cartao.cartoes', compact('cartoes'));
    }

    public function formulario(): View
    {
        return view('cliente.cartao.store');
    }

    public function atualizar(Request $request, $id): RedirectResponse
    {
        $date = Carbon::now();

        $request->validate([
            'numero' => ['required', 'string', 'max:20', 'regex: /^[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}$/'],
            'validade' => ['required', 'date', 'after:' . $date],
            'tipo' => ['required', 'string']
        ]);

        $cartao = Cartao::find($id);
        $criptografiaService = new criptografiaService();
        $entradas = $criptografiaService->criptografarCartao($request);
        $entradas = $entradas->except('_token', '_method');
        foreach ($entradas as $chave => $valor) {
            $cartao->$chave = $valor;
        }

        $cartao->save();

        return redirect(route('cartao.index'));
    }

    public function deletar($id): RedirectResponse
    {
        $cartao = Cartao::find($id);
        $cartao->status = 0;
        $cartao->save();

        return redirect(route('cartao.index'));
    }

    public function store(Request $request): RedirectResponse
    {
        $date = Carbon::now();

        $request->validate([
            'numero' => ['required', 'string', 'max:20', 'regex: /^[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}$/'],
            'validade' => ['required', 'date', 'after:' . $date],
            'tipo' => ['required', 'string']
        ]);

        $cliente = Auth::user()->cliente;
        $criptografiaService = new criptografiaService();
        $request = $criptografiaService->criptografarCartao($request);
        $cartao = $cliente->cartoes()->create([
            'numero' => $request->numero,
            'validade' => $request->validade,
            'tipo' => $request->tipo
        ]);

        return redirect(route('cartao.index'));
    }

}
