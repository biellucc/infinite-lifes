<?php

namespace App\Filament\Resources\ClienteResource\Pages;

use App\Filament\Resources\ClienteResource;
use App\Models\Cliente;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EditCliente extends EditRecord
{
    protected static string $resource = ClienteResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Buscar o cliente e o usuário relacionado
        $cliente = Cliente::find($this->record->id); // Utilize o ID do registro atual
        $usuario = User::find($cliente->user_id);
        $data['email'] = $usuario->email;
        $data['telefone'] = $usuario->telefone;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $cliente = Cliente::find($this->record->id);
        $usuario = User::find($cliente->user_id);
        try {
            // Verificar se o e-mail é está disponível (se já existe ou não)
            $emailExists = User::where('email', $data['email'])->where('id', '!=', $usuario->id)->exists();
            if ($emailExists) {
                throw new \Exception("O campo e-mail já está sendo utilizado.");
            } else {
                // Atualizar o usuário na tabela users
                $usuario->update([
                    'telefone' => $data['telefone'],
                    'email' => $data['email'],
                ]);
            }
        } catch (ModelNotFoundException $e) {
            throw new \Exception("Erro ao atualizar o usuário: " . $e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        // Remover campos que não pertencem ao cliente
        unset($data['email'], $data['telefone']);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
