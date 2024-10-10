<?php

namespace App\Services;

use App\Models\Administrador;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AtualizacaoUsuarioService
{
    public function atualizacaoUsuario($request, $usuario)
    {
        $usuario->update([
            'telefone' => $request->telefone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $usuario;
    }

    public function atualizacaoCliente($request, $usuario) {
        $cliente = $usuario->cliente()->create([
            'nome' => $request->nome,
            'sobrenome' => $request->sobrenome,
            'cpf' => $request->cpf,
            'data_nascimento' => $request->data_nascimento,
        ]);

        return $cliente;
    }

    public function atualizacaoVendedor($request, $usuario) {
        $vendedor = $usuario->vendedor()->create([
            'cnpj' => $request->cnpj,
            'empresa' => $request->empresa,
        ]);

        return $vendedor;

    }

    public function atualizacaoTransportadora($request, $usuario) {
        $transportadora = $usuario->transportadora()->create([
            'empresa' => $request->empresa,
            'cnpj' => $request->cnpj,
            'administrador_id' => $request->cpf
        ]);

        return $transportadora;

    }

    public function atualizacaoAdministrador($request, $usuario) {
        $administrador = Administrador::create([
            'nome' => $request->nome,
            'tipo' => $request->tipo,
            'user_id' => $usuario->id
        ]);

        return $administrador;
    }
}
