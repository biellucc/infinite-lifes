<?php

namespace App\Filament\Resources\VendedorResource\Pages;

use App\Filament\Resources\VendedorResource;
use App\Models\User;
use App\Models\Vendedor;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EditVendedor extends EditRecord
{
    protected static string $resource = VendedorResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Buscar o vendedor e o usuário relacionado
        $vendedor = Vendedor::find($this->record->id); // Utilize o ID do registro atual
        $usuario = User::find($vendedor->user_id);
        $data['email'] = $usuario->email;
        $data['telefone'] = $usuario->telefone;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $vendedor = Vendedor::find($this->record->id);
        $usuario = User::find($vendedor->user_id);
        try {
            // Atualizar o usuário na tabela users
            $usuario->update([
                'telefone' => $data['telefone'],
                'email' => $data['email'],
            ]);
        } catch (ModelNotFoundException $e) {
            throw new \Exception("Erro ao atualizar o usuário: " . $e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        // Remover campos que não pertencem a vendedor
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
