<?php

namespace App\Filament\Resources\TransportadoraResource\Pages;

use App\Filament\Resources\TransportadoraResource;
use App\Models\Transportadora;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Crypt;

class EditTransportadora extends EditRecord
{
    protected static string $resource = TransportadoraResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Buscar o transportadora e o usuário relacionado
        $transportadora = Transportadora::find($this->record->id); // Utilize o ID do registro atual
        $usuario = User::find($transportadora->user_id);
        $data['email'] = $usuario->email;
        $data['telefone'] = $usuario->telefone;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $transportadora = transportadora::find($this->record->id);
        $usuario = User::find($transportadora->user_id);
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

        // Remover campos que não pertencem a transportadora
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
