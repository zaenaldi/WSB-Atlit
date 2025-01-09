<?php
namespace App\Filament\Resources;

use Filament\Models\Contracts\FilamentUser;
use App\Filament\Resources\ClubResource\Pages;
use App\Models\Club;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ClubResource extends Resource
{
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
    protected static ?string $navigationGroup = 'Main Menu';
    protected static ?string $model = Club::class;
    protected static ?int $navigationSort = 2; // Adjust the number as needed
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_club')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('name_club')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_club')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_club')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('email'),
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
            'index' => Pages\ListClubs::route('/'),
            'create' => Pages\CreateClub::route('/create'),
            'edit' => Pages\EditClub::route('/{record}/edit'),
        ];
    }
}
