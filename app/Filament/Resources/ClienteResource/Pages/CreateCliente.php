<?php

namespace App\Filament\Resources\ClienteResource\Pages;

use App\Filament\Resources\ClienteResource;
use App\Services\registroUsuarioService;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Http\Request;

class CreateCliente extends CreateRecord
{
    protected static string $resource = ClienteResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $request = Request::create('/route', 'POST', $data);
        $registroUsuarioService = new registroUsuarioService();
        $usuario = $registroUsuarioService->storeUsuario($request);

        // Remover os campos que não pertencem à tabela cliente
        unset($data['email'], $data['password'], $data['telefone']);

        // Associar o user_id ao cliente
        $data['user_id'] = $usuario->id;

        return $data;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Customer registered';
    }
}
