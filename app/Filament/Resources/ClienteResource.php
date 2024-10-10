<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClienteResource\Pages;
use App\Filament\Resources\ClienteResource\RelationManagers;
use App\Models\Cliente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Unique;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('Customers');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('User');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->placeholder('Gabriel')
                    ->maxLength(50)
                    ->string()
                    ->required(),
                Forms\Components\TextInput::make('sobrenome')
                    ->placeholder('Lucas Silva')
                    ->required()
                    ->maxLength(50)
                    ->string(),
                Forms\Components\TextInput::make('cpf')
                    ->label('CPF')
                    ->placeholder('322.021.543-76')
                    ->required()
                    ->string()
                    ->maxLength(15)
                    ->regex('/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$/')
                    ->unique('cliente', 'cpf', modifyRuleUsing: function (Unique $rule, $context, $record) {
                        if ($context == "edit") {
                            return $rule->ignore($record->getKey());
                        }
                        return $rule;
                    }),
                Forms\Components\DatePicker::make('data_nascimento')
                    ->date()
                    ->maxDate(now()->subYear(17))
                    ->required(),
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
                    ->placeholder('gabriel@gmail.com'),
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
                    ->placeholder('55 19 99941-4321')
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
                Tables\Columns\TextColumn::make('id')
                    ->label('ID Customer')
                    ->numeric()
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('nome')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('sobrenome')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->label('CPF')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('data_nascimento')
                    ->date('d, M, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('usuario.email')
                    ->label('E-Mail Address')
                    ->sortable()
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('usuario.telefone')
                    ->label('Phone Number')
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
        ];
    }
}
