<?php
namespace App\Filament\Widgets;

use App\Models\Club;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class ClubWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    protected static ?string $heading = 'Club';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(Club::query()) // Fetch all clubs from the database
            ->filters([
                Tables\Filters\Filter::make('name_club')
                    ->label('Club Name')
                    ->query(fn ($query, $value) => $query->where('name_club', 'like', "%{$value}%")),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('id_club')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_club')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
            ]);
    }

    protected function filterClub(): ?int
    {
        return $this->filters['club'] ?? null; // Get the selected club ID from the filters
    }

    public function getTableRecordKey($record): string
    {
        return (string) $record->id_club; // Ensure it's cast to a string
    }
}
