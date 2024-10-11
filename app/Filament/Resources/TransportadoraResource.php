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
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('cnpj')
                    ->required()
                    ->maxLength(19),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('administrador_id')
                    ->required()
                    ->numeric(),
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
                    ->getStateUsing(function($record){
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
