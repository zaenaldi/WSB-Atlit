<?php
namespace App\Filament\Widgets;

use App\Models\Competition;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class CompetitionWidget extends BaseWidget
{
    protected static ?int $sort = 5;

    protected static ?string $heading = 'Competitions';

    protected int | string | array $columnSpan = 'full';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(Competition::query()) // Fetch all clubs from the database
            ->filters([
                
            ])
            ->columns([
                Tables\Columns\TextColumn::make('id_competition')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_competition')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('date'),
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
