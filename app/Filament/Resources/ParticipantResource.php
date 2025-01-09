<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParticipantResource\Pages;
use App\Filament\Resources\ParticipantResource\RelationManagers;
use App\Models\Participant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ParticipantResource extends Resource
{
    protected static ?string $navigationGroup = 'Main Menu';
    protected static ?string $model = Participant::class;
    protected static ?int $navigationSort = 4; // Adjust the number as needed
    protected static ?string $navigationIcon = 'heroicon-o-star';

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
            Forms\Components\Select::make('id_club')
                ->label('Club')
                ->relationship('club', 'name_club')
                ->required(),
            Forms\Components\Select::make('id_competition')
                ->label('Competition')
                ->relationship('competition', 'name_competition')
                ->required(),
            Forms\Components\TextInput::make('ranking')
                ->label('Ranking')
                ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('club.name_club')->label('Club')
                    ->searchable(),
                Tables\Columns\TextColumn::make('competition.name_competition')->label('Competition')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ranking')->label('Ranking'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
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
            'index' => Pages\ListParticipants::route('/'),
            'create' => Pages\CreateParticipant::route('/create'),
            'edit' => Pages\EditParticipant::route('/{record}/edit'),
        ];
    }
}
