<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Filament\Resources\FeedbackResource\RelationManagers;
use App\Models\Feedback;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\text;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('titulo')
                    ->label(__('Title'))
                    ->required()
                    ->string()
                    ->maxLength(50)
                    ->disabled(fn($record, $context) => $context == 'edit' && $record->user_id != Auth::id())
                    ->translateLabel(),
                Forms\Components\Textarea::make('corpo')
                    ->label(__('Body'))
                    ->string()
                    ->required()
                    ->columnSpanFull()
                    ->disabled(fn($record, $context) => $context == 'edit' && $record->user_id != Auth::id()),
                Forms\Components\Select::make('status')
                    ->options([
                        'Aberto' => __('Opened'),
                        'Finalizado' => __('Finished')
                    ])
                    ->required()
                    ->default('Aberto'),
                Select::make('user_id')
                    ->label(__('ID user'))
                    ->required()
                    ->relationship(name: 'usuario', titleAttribute: 'id')->default(Auth::id())
                    ->disabled(fn($record, $context) => $context == 'edit' && $record->user_id != Auth::id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('titulo')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFeedback::route('/'),
        ];
    }
}
