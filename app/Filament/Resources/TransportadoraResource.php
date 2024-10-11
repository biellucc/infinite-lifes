<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransportadoraResource\Pages;
use App\Filament\Resources\TransportadoraResource\RelationManagers;
use App\Models\Transportadora;
use App\Services\criptografiaService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Unique;

class TransportadoraResource extends Resource
{
    protected static ?string $model = Transportadora::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('Carriers');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('User');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('empresa')
                    ->label(__('Company'))
                    ->placeholder('XFast')
                    ->required()
                    ->string()
                    ->maxLength(100),
                Forms\Components\TextInput::make('cnpj')
                    ->placeholder('72.154.901/0001-49')
                    ->required()
                    ->string()
                    ->maxLength(19)
                    ->regex('/^[0-9]{2}.[0-9]{3}.[0-9]{3}\/[0-9]{4}-[0-9]{2}$/')
                    ->hiddenOn('edit'),
                Forms\Components\TextInput::make('email')
                    ->label(__('E-Mail Address'))
                    ->email()
                    ->required()
                    ->unique('users', 'email', modifyRuleUsing: function (Unique $rule, $context, $record) {
                        if ($context == "edit") {
                            return $rule->ignore($record->user_id);
                        }
                        return $rule;
                    })
                    ->maxLength(255)
                    ->placeholder('xfast@gmail.com'),
                Forms\Components\TextInput::make('telefone')
                    ->label(__('Phone Number'))
                    ->unique('users', 'telefone', modifyRuleUsing: function (Unique $rule, $context, $record) {
                        if ($context == "edit") {
                            return $rule->ignore($record->user_id);
                        }
                        return $rule;
                    })
                    ->required()
                    ->maxLength(17)
                    ->placeholder('55 19 98941-3215')
                    ->tel()
                    ->telRegex('/^[0-9]{2} [0-9]{2} [0-9]{5}-[0-9]{4}$/'),
                Forms\Components\TextInput::make('password')
                    ->label(__('Password'))
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->confirmed()
                    ->hiddenOn('edit'),
                Forms\Components\TextInput::make('password')
                    ->label(__('Confirm Password'))
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->hiddenOn('edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->label('ID Carrier')
                    ->numeric()
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('administrador_id')
                    ->label(__('ID Admin'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('empresa')
                    ->label(__('Company'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('cnpj')
                    ->label('CNPJ')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->getStateUsing(function ($record) {
                        $criptografiaService = new criptografiaService();
                        return $criptografiaService->descriptografarCnpj($record['cnpj']);
                    }),
                Tables\Columns\TextColumn::make('usuario.email')
                    ->label(__('E-Mail Address'))
                    ->sortable()
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('usuario.telefone')
                    ->label(__('Phone Number'))
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created_at'))
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Updated_at'))
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransportadoras::route('/'),
            'create' => Pages\CreateTransportadora::route('/create'),
            'edit' => Pages\EditTransportadora::route('/{record}/edit'),
        ];
    }
}
