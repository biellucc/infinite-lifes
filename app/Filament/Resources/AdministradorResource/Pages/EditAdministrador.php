<?php

namespace App\Filament\Resources\AdministradorResource\Pages;

use App\Filament\Resources\AdministradorResource;
use App\Models\Administrador;
use App\Models\User;
use App\Services\AtualizacaoUsuarioService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class EditAdministrador extends EditRecord
{
    protected static string $resource = AdministradorResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Buscar o administrador e o usuário relacionado
        $administrador = Administrador::find($this->record->id); // Utilize o ID do registro atual
        $usuario = User::find($administrador->user_id);
        $data['email'] = $usuario->email;
        $data['telefone'] = $usuario->telefone;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $administrador = Administrador::find($this->record->id);
        $usuario = User::find($administrador->user_id);
        try {
            // Verificar se o e-mail é está disponível (se já existe ou não)
            $emailExists = User::where('email', $data['email'])->where('id', '!=', $usuario->id)->exists();
            if ($emailExists) {
                throw new \Exception("O campo e-mail já está sendo utilizado..");
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

        // Remover campos que não pertencem ao administrador
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
