<?php

namespace App\Filament\Resources\TransportadoraResource\Pages;

use App\Filament\Resources\TransportadoraResource;
use App\Services\criptografiaService;
use App\Services\registroUsuarioService;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateTransportadora extends CreateRecord
{
    protected static string $resource = TransportadoraResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $request = Request::create('/route', 'POST', $data);

        $registroUsuarioService = new registroUsuarioService();
        $usuario = $registroUsuarioService->storeUsuario($request);

        // Remover os campos que não pertencem à tabela transportadora
        unset($data['email'], $data['password'], $data['telefone']);

        // Associar o user_id a transportadora
        $data['user_id'] = $usuario->id;
        // Associar administrador_id a transportadora
        $data['administrador_id'] = Auth::user()->administrador->id;

        // Criptografar o cnpj
        $serviecCriptografia = new criptografiaService();
        $data['cnpj'] = $serviecCriptografia->criptografarCnpj($data['cnpj']);

        return $data;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Carrier registered';
    }
}
