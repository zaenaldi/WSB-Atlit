<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FederationResource\Pages;
use App\Filament\Resources\FederationResource\RelationManagers;
use App\Models\Federation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class FederationResource extends Resource
{
    protected static ?string $navigationGroup = 'Main Menu';
    protected static ?string $model = Federation::class;

    protected static ?int $navigationSort = 1; // Adjust the number as needed

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    public static function canViewAny(): bool
    {
        // Allow users with 'Admin' or 'Club' roles to view the menu
        return Auth::check() && (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Club'));
    }

    public static function canCreate(): bool
    {
        // Only admins can create
        return Auth::user()->hasRole('Admin');
    }

    public static function canUpdate($record): bool
    { 
        // Only admins can update
        return Auth::user()->hasRole('Admin');
    }

    public static function canDelete($record): bool
    {
        // Only admins can delete
        return Auth::user()->hasRole('Admin');
    }
    public static function canEdit($record): bool
    {
        // Only admins can update
        return Auth::user()->hasRole('Admin');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Federation Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('address')
                    ->label('Federation Address')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('Federation Email')
                    ->required()
                    ->email()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Federation Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('address')
                    ->label('Federation Address')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Federation Email')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // You can add custom filters here if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFederations::route('/'),
            'create' => Pages\CreateFederation::route('/create'),
            'edit' => Pages\EditFederation::route('/{record}/edit'),
        ];
    }
}
