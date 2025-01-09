<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;

use App\Filament\Widgets\ClubWidget;
use App\Filament\Widgets\CompetitionWidget;
use App\Filament\Widgets\RankingOrders;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                'Main Menu',
                'Settings',
                
            ]);
        });
    }
}
