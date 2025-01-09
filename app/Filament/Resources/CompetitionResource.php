<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompetitionResource\Pages;
use App\Filament\Resources\CompetitionResource\RelationManagers;
use App\Models\Competition;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class CompetitionResource extends Resource
{
    protected static ?string $navigationGroup = 'Main Menu';
    protected static ?string $model = Competition::class;
    protected static ?int $navigationSort = 3; // Adjust the number as needed
    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    public static function canViewAny(): bool
    {
        // Allow all authenticated users to view the menu
        return Auth::check();
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
            Forms\Components\TextInput::make('id_competition')
                ->required()
                ->maxLength(10),
            Forms\Components\TextInput::make('name_competition')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('address')
                ->required()
                ->maxLength(255),
            Forms\Components\DatePicker::make('date')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_competition')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_competition')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('date'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListCompetitions::route('/'),
            'create' => Pages\CreateCompetition::route('/create'),
            'edit' => Pages\EditCompetition::route('/{record}/edit'),
        ];
    }
}
