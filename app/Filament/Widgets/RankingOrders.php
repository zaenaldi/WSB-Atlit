<?php
namespace App\Filament\Widgets;

use App\Models\Participant;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class RankingOrders extends BaseWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = 'Trophy'; // Updated the title to "Trophy"



    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                Participant::query()
                    ->select([
                        'participants.id_club',
                        'clubs.name_club as name_club',
                        DB::raw('COUNT(CASE WHEN participants.ranking = 1 THEN 1 END) as gold_trophies'),
                        DB::raw('COUNT(CASE WHEN participants.ranking = 2 THEN 1 END) as silver_trophies'),
                        DB::raw('COUNT(CASE WHEN participants.ranking = 3 THEN 1 END) as bronze_trophies'),
                    ])
                    ->join('clubs', 'participants.id_club', '=', 'clubs.id')
                    ->when($this->filterClub(), function ($query, $clubId) {
                        return $query->where('participants.id_club', $clubId);
                    })
                    ->groupBy('participants.id_club', 'clubs.name_club')
                    ->orderBy('gold_trophies', 'desc') // Sort by gold trophies by default
            )
            ->filters([
                Tables\Filters\SelectFilter::make('club')
                    ->label('Club')
                    ->options(
                        Participant::query()
                            ->join('clubs', 'participants.id_club', '=', 'clubs.id')
                            ->pluck('clubs.name_club', 'participants.id_club')
                            ->toArray()
                    )
                    ->placeholder('All Clubs'),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('name_club')
                    ->label('Club Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gold_trophies')
                    ->label('Gold Trophies')
                    ->sortable(),
                Tables\Columns\TextColumn::make('silver_trophies')
                    ->label('Silver Trophies')
                    ->sortable(),
                Tables\Columns\TextColumn::make('bronze_trophies')
                    ->label('Bronze Trophies')
                    ->sortable(),
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
